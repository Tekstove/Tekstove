<?php Require(SITE_PATH_TEMPLATE . '__top.php'); ?>

<div id="bbcode_butoni"></div>
<form action="" method="post" name="comment_edit">
Коментар:<textarea class="textarea_resizable" name="comment" id="bbcode_input" rows=15 cols=90><?php echo htmlspecialchars($komentar['text']);?></textarea>
<br><input type="checkbox" name="delete" value="delete">Изтрий<br>
<input type="submit" name="submit" value="Промени!">
</form>
<div id="bbcode_emic"></div>

<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>