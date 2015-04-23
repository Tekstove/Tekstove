<?php Require(SITE_PATH_TEMPLATE . '__top.php'); ?>

<div id="bbcode_butoni"></div>
		<form action="" method="post" name="newtopicform">
			<table border=1>
			<tr><td>
			<div style="width:730px;">

			<div style="float:left;width:260px;">
			Заглавие:<br>
                        <input name="title" maxlength="40" size=35 value="<?php if(isset ($_POST['title'])) echo htmlspecialchars($_POST['title']);?>"><br><br>
			</div>


			</div>

			</td></tr>

			<tr><td>Мнение<br>
                                <textarea name="post" id="bbcode_input" rows=9 cols=70><?php if(isset ($_POST['post'])) echo htmlspecialchars($_POST['post']);?></textarea>

                        </td></tr>

			<tr><td>
			<input type="hidden" name="razdel" value="<?php echo $_GET['razdel']; ?>">


			</td></tr>
			<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Изпрати!"><div id="bbcode_emic"></div></td></tr>
			</table>
		</form>

<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>