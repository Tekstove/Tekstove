<?php
require_once ("__top.php");

try{


$bez_reklami = true;

//проверява дали има сетната бисквитка, за да потвърди дали сте логнати
if($userclass<10) {
?><META HTTP-EQUIV="refresh" content="0;URL=login.php"><?php
	die();
	}










//ако формата е изпълнена
	if (isset($_POST['submit'],$_POST['password_mod'])) {
	// проверява дали полетата са попълнени
		if(!isset ($_POST['password_mod'])) {
		?><META HTTP-EQUIV="refresh" content="0;URL=login_mod.php?error=1"><?php
		die();
		}
	// проверява дали има такъв потребител с такава парола
	$stm = $pdo->prepare("SELECT `password_mod` FROM `users` WHERE `id` = ? LIMIT 1");
        $stm -> bindValue(1, $username_id, PDO::PARAM_INT);
        $stm -> execute();

        
	//дава гершка ако няма
	if ($stm->rowCount() == 0) {
			?><META HTTP-EQUIV="refresh" content="0;URL=login_mod.php?error=2"><?php
			die();
			}
		$v = $stm->fetch();
		//gives error if the password is wrong
		if (md5($_POST['password_mod']) != $v['password_mod']) {
			?><META HTTP-EQUIV="refresh" content="0;URL=login_mod.php?error=3"><?php
			die();
			}
		else	{
			$Spass=md5($_POST['password_mod'].$_SERVER['REMOTE_ADDR']);
			setcookie('key_mod_po_taka_l', $Spass);
			// ако всичко е наред сетваме бисквитка

			$stm = $pdo->prepare("UPDATE `users` SET `password_mod_coockie` = ? WHERE `id` = ? LIMIT 1");
			$stm -> bindValue(1, $Spass, PDO::PARAM_STR);
                        $stm -> bindValue(2, $username_id, PDO::PARAM_INT);
                        $stm ->execute();

                        

                        ?><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
			Вписване, моля изчакайте<br> или 
			<a href="mod.php">кликнете тук</a>
			<META HTTP-EQUIV="refresh" content="0;URL=mod.php"><?php
			die();
			}

	}
else {
	Require (SITE_PATH_TEMPLATE . "__top.php");
	?><br><br><font color="#FF0000" size=3><b><?php
	if(isset ($_GET['error'])){
	 if($_GET['error']==1) echo "Не сте попълнили нужните полета";
	 else if ($_GET['error']==2) echo "Няма такъв потребител.";
	  else if ($_GET['error']==3) echo "Грешна парола, опитайте пак!";
        }
	?></b></font><br><br><?php
	// ако не е вече влязъл потребителя

	?>
	<form action="" method="post">
	<table>
		<tr><td>Парола за достъп:</td><td>
                        <input type="password" name="password_mod" maxlength="50">
		</td></tr>
		<tr><td colspan="2" align="center">
			<input type="submit" name="submit" value="Влез">
		</td></tr>
	</table>
	</form>
	<?php
	}



} catch (Exception $e){
    greshka($e);
}

Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>