<?php Require(SITE_PATH_TEMPLATE . '__top.php'); ?>

<a href="forum.php">Форум</a><br>

<table class="forum" border=1 cellpadding=6>

<?php	foreach ($mneniq as $v) { ?>

<tr><td class="forum_topic_gore_lqvo">
    <?php echo $v['skype']; ?><a href="profile.php?profile=<?php echo $v['ot']; ?>"><?php echo $v['username']; ?></a></td>
<td class="forum_topic_gore_dqsno"><?php echo $v['data']; ?></td>
</tr>
<tr>
    <td Valign="top"><?php
		if($v['avatar']) {?> <img src="<?php echo $v['avatar']; ?>" class="avatar_limit" ALT="avatar"><?php } ?>
		<br>
		<!--ранг: <?php /* echo potrebitel::getRankAsText($v['class']); */ ?>-->
	</td>
<td class="forum_topic_post_text bb_code_text"><?php echo $v['text']; ?>
</td>
</tr>
<tr>
    <td style="padding:1px;background-color:#DDDDDD;">
        <a href="profile.php?profile=<?php echo $v['ot']; ?>">профил</a>&nbsp;
        <a href="lichnosyobshtenie_send.php?za=<?php echo $v['ot']; ?>" title="Изпрати Лично Съобщение">ЛС</a>
    </td>
    <td style="padding:1px;background-color:#DDDDDD;">

        <a href="forum_topic_vij.php?id=<?php echo $v['topic_id'] ?>"> в тема: <b><?php echo $v['topic_name']; ?></b></a>
    </td>
</tr>
<tr><td colspan=2><div style="width:100%;background-color:#FFF;height:25px;border-top:silver dashed 1px;text-align:right">
</div></td></tr>

<?php
}
?></table>

<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>