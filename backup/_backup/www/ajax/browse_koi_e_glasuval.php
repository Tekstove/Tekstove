<?php
include '../__top.php';

if(isset ($_GET['id'])) $id = (int)$_GET['id'];
else greshka('не е посочено ид');

if(isset ($_GET['start'])) $start = (int)$_GET['start'];
else $start = 0;

$stm = $pdo->prepare("SELECT `ot` FROM `glasuvane` WHERE `za` = ? ORDER BY `id` LIMIT ? , 10");
$stm -> bindValue(1, $id, PDO::PARAM_INT);
$stm -> bindValue(2, $start, PDO::PARAM_INT);
$stm -> execute();

foreach ($stm->fetchAll() as $v) {
    
?><a href="profile.php?profile=<?php echo $v['ot']; ?>" target="_blank"><?php echo potrebitel::ime_ot_id($v['ot']); ?></a><br>
 <?php  }


if($stm -> rowCount() ==10){

?><div id="koi_e_glasuval_link_stranicirane">
<br><a href="#" onclick="return koi_e_glasuval(<?php echo $start+10;?>);">покажи още...</a>
</div><?php
    } ?>