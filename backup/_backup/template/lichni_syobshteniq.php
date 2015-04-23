<?php Require(SITE_PATH_TEMPLATE . '__top.php'); ?>

<h1>Лични съобщения</h1><br>
<a href="?all=1">&gt; Всички входящи съобщения</a><br>
<a href="?vij_izhodqshti=1">&gt; Изходящи съобщения</a><br>
<i>Съобщения по-стари от 90 дни се трият</i>
<br><br>


<?php if(!isset ($saobshteniq)) {


    ?>Нямате лични съобщяния<?php
}
else {

foreach ($saobshteniq as $v) { ?>

    <a href="lichni_syobshteniq_vij.php?id=<?php echo $v['id']; ?>"><i><?php echo $v['data']; ?></i>
        <b><?php echo $v['otnosno']; ?></b></a>
    
    от <a href="profile.php?profile=<?php echo $v['ot']; ?>"><b><?php echo $v['ot_ime']; ?></b></a>
   

    
    <?php if($v['procheteno']==0){ ?><img src="images/novoLS.gif" ALT="Ново ЛС"><?php } ?>
    <br>
<?php
}




}


Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>
