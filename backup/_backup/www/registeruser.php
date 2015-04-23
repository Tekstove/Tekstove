<?php
require ("__top.php");

try
{

	$bez_reklami = true;

	$error = NULL;

	if (isset($_POST['submit'], $_POST['r_godina'], $_POST['r_mesec'], $_POST['r_den'], $_POST['usernamereg'], $_POST['passreg'],
                                
				 $_POST['pass2reg'], $_POST['mailreg']) && $_POST['usernamereg'] && $_POST['passreg'])
	{


//            if (isset ($_POST['recaptcha_challenge_field'], $_POST['recaptcha_response_field'])) {
//		$privatekey = "6Ldnr8MSAAAAAIJx4XWYVD70Bz-dYd9AJP0p8dGF";
//		$resp = recaptcha_check_answer($privatekey,
//					 $_SERVER["REMOTE_ADDR"],
//					 $_POST["recaptcha_challenge_field"],
//					 $_POST["recaptcha_response_field"]);
//
//		if (!$resp->is_valid)
//		{
//			// What happens when the CAPTCHA was entered incorrectly
//			$error[] = "Грешка в кода против ботова (" . $resp->error . ")";
//		}
//            } else {
//                $error[] = "Въведете текста за проверката против ботове";
//            }


		$r_godina = (int) $_POST['r_godina'];
		$r_mesec = (int) $_POST['r_mesec'];
		$r_den = (int) $_POST['r_den'];

		if (($r_godina > 3000) || ($r_godina < 1200))
			$error[] = 'Грешно зададена година';
		if (($r_mesec > 12) || ($r_mesec < 1))
			$error[] = 'Грешно зададен месец';
		if (($r_den > 35) || ($r_den < 1))
			$error[] = 'Грешно зададен ден';

		if ($r_mesec < 10)
			$r_mesec = '0' . $r_mesec;
		if ($r_den < 10)
			$r_den = '0' . $r_den;

		$username_reg_rajdane = $r_godina . $r_mesec . $r_den;


		$username_reg = $_POST['usernamereg'];
		$username_reg = trim($username_reg);

		$username_reg_mail = $_POST['mailreg'];
		$username_reg_mail = trim($username_reg_mail);


		if (strlen($username_reg) > 30)
			$error[] = "Прекълено дълго потребителко име";
		else if (strlen($_POST['passreg']) > 30)
			$error[] = "Прекълено дълга парола";
		else if (strlen($_POST['mailreg']) > 35)
			$error[] = "Прекълено дълъг e-mail";

		if ($error)
			$error[] = "Грешка в попълнените полета";


		$stm_check = $pdo->prepare("SELECT `username` FROM `users` WHERE (`username` REGEXP(?) OR `username` = ? ) LIMIT 1");
		$stm_check->bindValue(1, checkENandBGresExp($username_reg), PDO::PARAM_STR);
                $stm_check->bindValue(2, $username_reg, PDO::PARAM_STR);
		$stm_check->execute();

		$stm_check_mail = $pdo->prepare("SELECT `mail` FROM `users` WHERE LOWER(`mail`) = LOWER(?) ");
		$stm_check_mail->bindValue(1, $username_reg_mail, PDO::PARAM_STR);
		$stm_check_mail->execute();

		//ако името вече го има показва грешка
		if ($stm_check->rowCount() > 0)
		{
			$error[] = 'Съжаляваме, но името ' . htmlspecialchars($_POST['usernamereg']) . ' е заето.';
		}
		if ($stm_check_mail->rowCount() > 0)
		{
			$error[] = 'Съжаляваме, но e-mail ' . htmlspecialchars($_POST['mailreg']) . ' е вече зает.';
		}
		// this makes sure both passwords entered match
		if ($_POST['passreg'] != $_POST['pass2reg'])
		{
			$error[] = 'Потвърдителната парола не съвпада.';
		}


		if ($error === NULL)
		{


			// сега въвеждаме данните в базата данни
			$stm = $pdo->prepare("INSERT INTO `users` (`username`, `password`, `mail`, `rajdane`) VALUES (?, ?, ?, ?)");
			$stm->bindValue(1, $username_reg, PDO::PARAM_STR);
			$stm->bindValue(2, md5($_POST['passreg']), PDO::PARAM_STR);
			$stm->bindValue(3, $username_reg_mail, PDO::PARAM_STR);
			$stm->bindValue(4, $username_reg_rajdane, PDO::PARAM_STR);

			$stm->execute();
?>
			<h1>ГОТОВО</h1>
			<p>Благодаря ви че се регистрирахте, сега може да взелете.</p>
			<a href="index.php">Начало</a>
			<META HTTP-EQUIV="refresh" content="1;URL=login.php">
<?php
			die();
		}
	}
} catch (Exception $e)
{
	greshka($e);
}

Require (SITE_PATH_TEMPLATE . "registeruser.php");
?>