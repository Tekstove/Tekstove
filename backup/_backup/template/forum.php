<?php Require(SITE_PATH_TEMPLATE . '__top.php'); ?>

<br>
<table class="forum" cellpadding=6>
<tr>
    <td colspan="2"><a href="forum.php">Форум</a></td>
    <td><a href="forum_novi_mneniq.php">Нови мнения</a></td>
</tr>
<tr><td class="forumtop">Раздел</td>
<td class="forum_temi_br_top">Теми</td>
<td class="forumtop">Последно мнение</td></tr>

<?php

foreach ($razdeli as $v) { ?>


<tr><td class="flqvo">
        <a href="forum_razdel_vij.php?razdel=<?php echo $v['id']; ?>"><?php echo $v['name']; ?></a>
	</td>

<td class="forum_br_temi"><?php echo $v['temi']; ?></td>


<td class="fdqsno"><b>в:</b>
	<a href="forum_topic_vij.php?id=<?php echo $v['topic']['id']; ?>"><?php echo $v['topic']['topic_name']; ?></a>
	<br><b>от: </b>
        <a href="profile.php?profile=<?php echo $v['mnenie_id']; ?>"><?php echo $v['mnenie_ime']; ?></a></td>

</tr>


<?php } ?>
</table>


<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>
