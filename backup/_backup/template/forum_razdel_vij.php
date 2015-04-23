<?php Require(SITE_PATH_TEMPLATE . '__top.php');?>



<br>
<a href="forum.php">Форум</a> -&gt; <a href="forum_razdel_vij.php?razdel=<?php echo $razdel ?>"><?php echo $razdel_ime; ?></a>
<br>
<?php if(($razdel==1)||($razdel==5)||($razdel==6)) { ?><center><b><u>Потвърдени</u></b> или <b><u>изпълнени и неактивни от 30 дни</u></b> теми се <b><u>местят в раздел Приключени заявки</u></b></center><br><?php } ?>

<table class="forum">
<tr><td class="forumtop">Тема</td>
<td class="forum_temi_br_top">мнения</td>
<td class="forumtop">Последно съобщение</td>
	</tr>
<?php $br=0;
foreach ($temi as $v) {
	$br++; ?>
        
	<tr><td class="flqvo" <?php if($v['priority'] > 0 ) { ?> style="font-weight: bold;" <?php } ?>>
		<a href="forum_topic_vij.php?id=<?php echo $v['id']; ?>"><?php echo $v['topic_name']; ?></a>
			</td>

<td class="forum_br_temi"><?php echo $v['topic_broi_mneniq']; ?></td>


<td class="fdqsno">
от <b><a href="profile.php?profile=<?php echo $v['poster']; ?>" title="виж профила"><?php echo $v['poster_ime']; ?></a></b> на <i><?php echo $v['data']; ?></i>
</td></tr>

<?php } ?>

<tr><td colspan=3>

<?php if($stranica) { ?> <a href="forum_razdel_vij.php?razdel=<?php echo $razdel; ?>&amp;stranica=<?php echo $stranica-1; ?>">по-нови</a><?php } ?>
&nbsp;&nbsp;&nbsp;<?php echo $stranica+1; ?>&nbsp;&nbsp;&nbsp;
<?php if($br==16) { ?><a href="forum_razdel_vij.php?razdel=<?php echo $razdel; ?>&amp;stranica=<?php echo $stranica+1; ?>">по-стари</a><?php } ?>
</td></tr>

</table>

<span>
<br><a class="linkkart" href="forum_topic_nov.php?razdel=<?php echo $razdel; ?>"><img src="images_f/nova_tema.gif" ALT="Нова Тема"></a>
</span>

<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>
