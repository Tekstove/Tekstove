<?php Require(SITE_PATH_TEMPLATE . '__top.php'); ?>

<div id="bbcode_butoni"></div>

<form action="" method="post" name="forum_post_edit">
<table><tr><td>
Коментар:<textarea name="post" id="bbcode_input" rows=15 cols=90><?php echo $post_data['post'];?></textarea>
</td></tr></table>

<input type="submit" name="submit" value="Промени!">
<?php if($userclass>=20){?>
    <br><input type="checkbox" name="iztrii">изтрий
    <?php    } ?>
</form>
<div id="bbcode_emic"></div>

<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>