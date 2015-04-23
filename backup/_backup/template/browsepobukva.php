<?php Require(SITE_PATH_TEMPLATE . '__top.php'); ?>
<br>

Изпълнители:<br><br>


<table><tr><td style="padding: 0 0 0 30px;">

<?php
$br=1;
foreach ($izpalniteli as $v) { /* пропуск на проверка дали има защото вече имам с всички букви */ ?>
<a href="browsepoartist.php?id=<?php echo $v['id']; ?>"><?php echo htmlspecialchars($v['name']); ?></a><br>
<?php 
if($br==61) break;
$br++;         } ?>

</td></tr>
<tr><td>

<?php if($page) { ?><br><b><a href="?page=<?php echo ($page-1); ?>&amp;bukva=<?php echo urlencode($bukva); ?>">&#60;&#60;Предишна страница</a></b>&nbsp;&nbsp;<?php echo ($page+1); ?>&nbsp;&nbsp;<?php } ?>
<?php if($br==61) { ?><br><b><a href="?page=<?php echo ($page+1); ?>&amp;bukva=<?php echo urlencode($bukva); ?>"><u>Следваща страница&#62;&#62;</u></a></b><?php } ?>

<br>

<?php //echo $pagination_count; ?>


</td></tr></table>
	

<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>