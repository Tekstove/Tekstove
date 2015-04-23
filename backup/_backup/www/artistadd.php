<?php
Require_once ("__top.php");


try{

if ((isset($_POST['name']))&&($_POST['name'])) {

$ime = remove_intervals($_POST['name']);

$stm = $pdo->prepare("SELECT `name` FROM `artists` WHERE LOWER(`name`) LIKE LOWER( ? ) LIMIT 1");
$stm->bindValue(1, $ime, PDO::PARAM_STR);
$stm->execute();


if($stm->rowCount() > 0 ) {
    foreach ($stm->fetchAll() as $v) { ?>Вече имаме такъв изпълнител, записан точно: <b><?php echo htmlspecialcharsX($v['name']); ?></b> <?php die();}
    }

	$stm = $pdo->prepare("INSERT INTO `artists` (`name`, `addedby`)	VALUES( ? , ? )");
        $stm -> bindValue(1, $ime, PDO::PARAM_STR);
        $stm -> bindValue(2, $username_id, PDO::PARAM_INT);
        $stm->execute();

	?><br>Списъкът потвърди записа , <br><br><?php echo htmlspecialcharsX($ime); ?> беше добавен успешно<br>
	<?php
        die();

        } ?>

<?php require SITE_PATH_TEMPLATE . '__top.php'; ?>
	<br>
	<i>Нов Изпълнител а :)</i>
	<form action="" method="post">
име:
<br><input type="text" name="name" maxlength="60" size=40>
<input type="submit" name="submit" value="Добави">
	</form>


        <?php
}
        catch (Exception $e){
            greshka($e);
        }