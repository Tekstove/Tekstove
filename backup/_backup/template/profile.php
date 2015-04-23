<?php Require(SITE_PATH_TEMPLATE . '__top.php'); ?>
<?php /* @var $profile potrebitel */ ?>

<h1><a href="?profile=<?php echo $profile->getId(); ?>"><?php echo $profile->getUsername(); ?></a></h1><br><br>
<?php if ($profile->getAvatar()) { ?> <br><img src="<?php echo $profile->getAvatar(); ?>" ALT="Avatar"><br><?php } ?>

<br><div class="bb_code_text"><?php echo $profile->getAbout(); ?></div><br><br>

<?php if (!empty($groups)): ?>
<div>
	<span style="font-size: 20px;">Групи:</span>
	
	<?php foreach ($groups as $group): ?>
		<?php /* var $group Tekstove\Acl\Group */ ?>
		<img src="<?php echo $group->getImage(); ?>"
			 class="tooltip" title="<?php echo $group->getName(); ?>"
			 />
	<?php endforeach; ?>
</div>
</div>

<?php endif; ?>


        <div class="profile_statistika">
        <div id="profile_izprateni_tekstove"></div>
        <div id="profile_izprateni_tekstove_menu">
            <a href="#" onclick="porfile_izprateni_pesni(<?php echo $id; ?>);return false;"><b>Изпратени текстове</b></a> ( <?php echo $profile->getLyricsCount(); ?> )
        </div>
        <div id ="profile_posledno_glasuvani"></div>
        <div id ="profile_posledno_glasuvani_menu">
            <a href="#" onclick="porfile_posledni_glasa(<?php echo $id; ?>);return false;"><b>Гласове</b></a> (  <?php echo $statistic['broi_glasove']; ?> )
        </div>


        <div id ="profile_posledno_komentara"></div>
        <div id ="profile_posledno_komentara_menu">
            <a href="#" onclick="porfile_posledni_komentara(<?php echo $id; ?>);return false;"><b>Коментара</b></a> (  <?php echo $statistic['broi_komentari']; ?> )
        </div>

        <div id ="profile_posledno_postove"></div>
        <div id ="profile_posledno_postove_menu">
            <a href="#" onclick="porfile_posledni_postove(<?php echo $id; ?>);return false;"><b>Форум съобщения</b></a> (  <?php echo $statistic['broi_postove']; ?> )
        </div>

        <div id ="profile_prevodi"></div>
        <div id ="profile_prevodi_menu">
            <a href="#" onclick="porfile_prevodi(<?php echo $id; ?>);return false;"><b>Преводи</b></a> (  <?php echo $profile->getTranslationCount();  ?> )
        </div>

        </div>
	<?php if (isset ($pozdrav['id'])) { ?>
		<br><?php echo $profile->getUsername(); ?> те поздравява с &nbsp;
		<b><a href="browse.php?id=<?php echo  $pozdrav['id']; ?>"><?php echo $pozdrav['title']; ?></a></b>
	<?php } ?>

	<br>
	
	<hr><a href="lichnosyobshtenie_send.php?za=<?php echo $profile->getId(); ?>" title="Изпрати лично събщение">Лично съобщение</a> |

	Ранг: <?php echo $profile->getRankAsText(); ?>
	 | <?php /* echo skype_code($profile['skype'],1); */ ?>
	 | <a href="liubimi_play.php?id=<?php echo $profile->getId(); ?>">Любими песни</a>
	<hr>




<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>
