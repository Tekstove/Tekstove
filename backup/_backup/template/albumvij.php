<?php Require(SITE_PATH_TEMPLATE . '__top.php');?>

<?php if ($album_sobstvenik) { ?>
    <br>
    <a href="/albumedit.php?id=<?php echo $album['id']; ?>">
        Промени
    </a>
    <br><br>
<?php } ?>


<h1>
    <?php if ($album['artist1id']) { ?>
        <b><a href="browsepoartist.php?id=<?php echo $album['artist1id']; ?>"><?php echo lyric::artist_name_ot_id($album['artist1id']); ?></a></b>
    <?php } ?>

    <?php if ($album['artist2id']) { ?>
        и
        <b>
            <a href="browsepoartist.php?artistb=<?php echo $album['artist2id']; ?>">
                <?php echo lyric::artist_name_ot_id($album['artist2id']); ?>
            </a>
        </b>
    <?php } ?>

    <?php echo '<br>' . htmlspecialcharsX($album['name']); ?>
</h1>



<?php if ($album['year']) { ?>(<i><?php echo $album['year']; ?></i>)<?php } ?>
<br>
<span id="video"></span>
<br>

<?php foreach ($pesen as $v) { ?>

    <br>

    <?php if (is_array($v)): ?>
        <?php echo $v['nomer']; ?>. <a href="browse.php?id=<?php echo $v['id']; ?>"><?php echo $v['zaglavie_sakrateno']; ?></a>

        <?php if($v['video_vbox7']) { ?>
                <a href="#" onClick="albumShowVideo('<?php echo addslashes($v['video_vbox7']);?>',1);return false;"><img src="images/vbox_logo.gif" ALT="видео в vbox7"></a>
        <?php } ?>
        <?php if ($v['video_youtube']) { ?>
                <a href="#" onClick="albumShowVideo('<?php echo addslashes($v['video_youtube']);?>',2);return false;"><img src="images/youtube_logo.gif" ALT="видео в youtube"></a>
        <?php } ?>
    <?php else: ?>

        <?php echo $v ?>

    <?php endif; ?>

<?php } ?>

<?php if($album['image']) { ?>
    <br><br>
    <img src="<?php echo $album['image']; ?>" ALT="Картинка на Албума">
    <br>
<?php } ?>
<?php if ($album['dopylnitelnoinfo']) { ?>
    <br><br>
    <i>
        Допълнителна информация:
    </i>
    <br>
    <?php echo nl2br(bbcode_format(htmlspecialcharsX($album['dopylnitelnoinfo']))); ?>
    <br>
<?php } ?>

<?php if ($album['up_id']) { ?>
    <br>
    Изпратено от
    <a href="profile.php?profile=<?php echo $album['up_id']; ?>">
        <b><u>
            <?php echo $album['up_ime']; ?>
        </u></b>
    </a>
        
<?php } ?>



<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>
