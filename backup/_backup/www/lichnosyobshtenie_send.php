<?php
Require ("__top.php");

try{
$bez_reklami = true;

if(!isset ($_REQUEST['za'])) greshka('nqma polu4atel','не е посочен получател');
$za=(int)$_REQUEST['za'];

$za_ime = potrebitel::ime_ot_id($za);
if(!$za_ime) {greshka('не е посочено за кой', "Не намирам потребителя, на когото искате да пратите съобщение"); }


potrebitel::zadaljitelno_lognat($username_id);


if((isset ($_POST['text'], $_POST['otnosno'], $_REQUEST['za']) && $_POST['text']) && $_POST['otnosno']){
	$stm = $pdo->prepare("INSERT INTO `pm` (`text`, `ot`, `za`, `otnosno`, `ip`) VALUES (?, ?, ?, ?, ?)");
        $stm->bindValue(1, $_POST['text'], PDO::PARAM_STR);
        $stm->bindValue(2, $username_id, PDO::PARAM_INT);
        $stm->bindValue(3, $za, PDO::PARAM_INT);
        $stm->bindValue(4, $_POST['otnosno'], PDO::PARAM_STR);
        $stm->bindValue(5, ip2long($_SERVER['REMOTE_ADDR']), PDO::PARAM_INT);
        $stm->execute();

        Require(SITE_PATH_TEMPLATE . '__top.php');
        ?><br>Съобщението успешно изпратено<?php
	}
        
        
        else {

Require(SITE_PATH_TEMPLATE . '__top.php'); ?>

Съобщение до: <b><?php echo $za_ime; ?></b>
                
		<form action="" method="post" name="addcomment">
		<br>Относно<br>
                <input type="text" name="otnosno" maxlength="150" size=30 value="<?php if(isset ($_REQUEST['otnosno'])) echo htmlspecialchars($_REQUEST['otnosno']);?>">
		<br>Съобщение<br>
                <div id="bbcode_butoni"></div>
                <textarea name="text" id="bbcode_input" rows=15 cols=90><?php if(isset ($_POST['text'])) echo htmlspecialchars($_POST['text']);?></textarea>

		<br>
		<input type="submit" name="submit" value="Изпрати">
		<br><br><br>
                </form>
                <div id="bbcode_emic"></div>
		<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php");
}



}
catch (Exception $e){
    greshka($e);
}

		?>