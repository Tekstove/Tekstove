<?php Require(SITE_PATH_TEMPLATE . '__top.php');?>




<br>
<?php if($userclass>=8){ ?>
        <div style="width:100%;text-align:right;">
        <?php if($userclass>10){ ?>
	<a href="mod.php?forum_edit=<?php echo $tema['id']; ?>">промени</a>
        <?php }
        if(  ( $userclass==9 || $userclass>10) && ( $tema['razdel']==7 ) ){?>
        &nbsp;&nbsp;&nbsp;<a href="mod_zelen.php?novini=1&id=<?php echo $tema['id']; ?>">новина: <?php

            if($tema['novina']) echo 'ok';
             else echo 'не';


            ?></a><?php
            } ?>
	</div>
        <?php } ?>

<a href="forum.php">Форум</a> -&gt; <a href="forum_razdel_vij.php?razdel=<?php echo $tema['razdel']; ?>"><?php echo $tema['razdel_ime']; ?></a>
-&gt; <?php echo $tema['topic_name']; ?>



<table class="forum" border=1 cellpadding=6>
	<?php foreach ($mneniq as $v) { ?>
	<tr>
        
<td class="forum_topic_gore_lqvo"><?php echo skype_code($v['poster_skype']); ?>
    <a href="profile.php?profile=<?php echo $v['poster']; ?>"><?php echo $v['poster_ime']; ?></a>
</td>
<td class="forum_topic_gore_dqsno"><?php echo $v['date']; ?></td>
</tr><tr>
<td Valign="top">
		<?php if($v['poster_avatar']) { ?> <img src="<?php echo $v['poster_avatar']; ?>" class="avatar_limit" ALT="avatar"><?php } ?>
		<br>
		<!--ранг: <?php /* echo potrebitel::getRankAsText($v['poster_class']); */ ?> -->


</td>
	<td class="forum_topic_post_text">
            <div class="bb_code_text">
                <?php echo nl2br(htmlspecialcharsX($v['post'])); ?>
            </div>
       </td></tr><tr><td style="padding:1px;background-color:#DDDDDD;">
<a href="profile.php?profile=<?php echo $v['poster']; ?>">профил</a>
&nbsp;
<a href="lichnosyobshtenie_send.php?za=<?php echo $v['poster']; ?>" title="Изпрати Лично Съобщение">ЛС</a>
</td>
<td style="padding:1px;background-color:#DDDDDD;">

<?php if(($userclass>=20)||($v['poster']==$username_id)) { ?><div style="width:100%;text-align:right;">
        <a href="forum_post_edit.php?id=<?php echo $v['id']; ?>"><u>Промени</u></a></div> <?php } ?>

</td>
</tr>

<tr><td colspan=2><div style="width:100%;background-color:#999999;height:5px;"></div></td></tr>


<?php } ?>
</table>

<br>&nbsp;&nbsp;&nbsp;<a class="linkkart"href="forum_topic_post.php?id=<?php echo $tema['id']; ?>"><img src="images_f/novo_mnenie.gif" ALT="Добави Мнение"></a>




<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>
