<?php

Require ("__top.php");

if (false === currentUser::isLogged() || false == currentUser::getInstance()->getAcl()->isAllowed(Tekstove\Acl::LYRIC_DELETE_DOUBLED)) {
	throw new \Exception('not allowed');
}

if (!isset($_REQUEST['id'])) {
	throw new Exception('missing id');
}

$id = (int)$_REQUEST['id'];

$lyric = new lyric($id);


$infoMessage = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (!isset($_POST['redirectTo'])) {
		throw new \Exception('redirectTo not set');
	}
	$redirectTo = $_POST['redirectTo'];

	$redirectTo = preg_replace('|^.*\?id=([0-9]+).*$|', '$1', $redirectTo);

	if (!preg_match('/^[0-9]+$/', $redirectTo)) {
		$infoMessage = 'Невалиден линк към текст';
	} else {
		try {
			$lyricRedirectTo = new lyric((int) $redirectTo);
			$lyricManager = new Tekstove\Lyric\Manager();
			$lyricManager->deleteDoubled($lyricRedirectTo, $lyric);

			Require (SITE_PATH_TEMPLATE . "__top.php");
			echo 'изтрита';
			die;
           
        } catch (Tekstove\LyricValidationException $e) {
            $infoMessage = $e->getMessage();
		} catch (Tekstove\LyricException $e) {
			/* @var $e \Tekstove\LyricException */
			if ($e->getCode() === 404) {
				$infoMessage = 'Не намирам песента';
			}
		}
	}
}

Require (SITE_PATH_TEMPLATE . "__top.php");

?>

<div style="color: red;"><?php echo $infoMessage; ?></div>

<form method="post">
	<input type="hidden" value="<?php echo $lyric->getId(); ?>" />
	<b><?php echo $lyric->get_Zaglavie_sakrateno(); ?></b>
	се повтара се с:
	<input type="text" name="redirectTo" />
	<span class="tooltip" title="пример: http://tekstove.info/browse.php?id=41348">?</span>
	<br/>
	<input type="submit" value="изтрии"/>
	
</form>