<?php
Require(SITE_PATH_TEMPLATE . '__top.php');
?>

<div id="bbcode_butoni"></div>
		<br>
                <form action="" method="post">

		<textarea name="post_text" id="bbcode_input" rows=9 cols=70></textarea>

		<input type="hidden" name="id" maxlength="5" size=5 value="<?php echo $id;?>">
		<br>
		<input type="submit" name="submit" value="Добави Мнението">
                </form>
		<div id="bbcode_emic"></div>
<?php
Require (SITE_PATH_TEMPLATE . "__bdqsno.php");
?>
