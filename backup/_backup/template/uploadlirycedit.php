<?php
Require(SITE_PATH_TEMPLATE . '__top.php');
/* @var $pesen lyric */
?>

ако искате преводът да се запише към профила, моля използвайте опцията 'Добави превод' при разглеждане на текста
<?php if ($errors) : ?>
<div style="font-size: 20px; color: red;">
	<?php echo $errors; ?>
</div>
<?php endif; ?>
<form action="" method="post">
    <table>
        <tr>
			<td>

				<?php
				$v['1'] = $pesen->getArtist1();
				$v['1_ime'] = $pesen->getArtist1_ime();
				$v['2'] = $pesen->getArtist2();
				$v['2_ime'] = $pesen->getArtist2_ime();
				$v['3'] = $pesen->getArtist3();
				$v['3_ime'] = $pesen->getArtist3_ime();
				$v['4'] = $pesen->getArtist4();
				$v['4_ime'] = $pesen->getArtist4_ime();
				$v['5'] = $pesen->getArtist5();
				$v['5_ime'] = $pesen->getArtist5_ime();
				$v['6'] = $pesen->getArtist6();
				$v['6_ime'] = $pesen->getArtist6_ime();
				for ($q = 1; $q <= 6; $q++) {
					?>
					Изпълнител:
					<input type="text" id="artist<?php echo $q; ?>_tarsene" onkeyup="showHint(<?php echo $q; ?>)" maxlength="100" size=30 autocomplete="off">
					<input type="text" id="artist<?php echo $q; ?>_name" maxlength="100" size=30 disabled="disabled" value="<?php echo $v[$q . '_ime']; ?>">
					<input type="text" id="artist<?php echo $q; ?>" name="artist<?php echo $q; ?>" maxlength="100" size=6 value=<?php echo $v[$q]; ?>>
					<a href="#" onCLick="javascript:value_smqna('artist<?php echo $q; ?>','');return false" title="Изтрии Изпълнителя">Изтрий</a>
					<div id="artist<?php echo $q; ?>_ajax" class="tekstpesen"></div>

				<?php } unset($q, $v); ?>

				<div style="font-size: smaller; font-style: italic;">
					Забележка: номерирането е с по-висок приоритет от избирането по име от списъкът. Ако избирате от списикът изтрийте номера от полето
				</div>
					
                <br/>
                <div class="edlink">
					<a href="#" onclick="window.open('artistadd.php','','width=600,height=400,menubar=no,status=no,location=yes,toolbar=no,scrollbars=yes')">
						или добави нов
					</a>
				</div>
            </td></tr>
        <tr>
			<td>
				Заглавие :<br/>
				<input type="text" name="title" maxlength="60" size=40 value="<?php echo $pesen->getTitle(); ?>" autocomplete="off"/>
				<br><br>
			</td>
		</tr>
        <tr>
			<td>
                <table>
					<tr>
						<td>
							Текст:
						</td>
						<td>
							Текст (превод на Български):
						</td>
					</tr>
                    <tr>
						<td>
							<textarea class="textarea_resizable" name="text" rows=20 cols=48 ><?php echo $pesen->getText(true, false); ?></textarea>
						</td>
                        <td>
							<textarea class="textarea_sync_resize" name="text_bg" rows=20 cols=48 ><?php echo $pesen->getText_bg(true, false); ?></textarea>
						</td>
					</tr>
				</table>
            </td>
		</tr>
        <tr>
			<td>
				Album link ( <b><i>http://www.tekstove.info/albumvij.php?id=<u>5</u></i></b> ) или само <u><b>5</b></u><br><input name="album1" maxlength="60"size=40 value="<?php echo $pesen->getAlbum1(); ?>"><br>
				Втори Album ( <b><i>http://www.tekstove.info/albumvij.php?id=<u>6</u></i></b> ) или само <u><b>6</b></u><br><input name="album2" maxlength="60"size=40 value="<?php echo $pesen->getAlbum2(); ?>"><br><br>
			</td>
		</tr>

        <tr><td>Video Link, <i>Видео...</i><br><input type="text" name="video" maxlength="100" size=30 value="<?php echo $pesen->getVideo(); ?>"><br><br></td></tr>
        <tr><td>video Vbox7<br><input type="text" name="video_vbox7" maxlength="100" size=30 value="<?php echo $pesen->getVideo_vbox7(); ?>"><br><br></td></tr>
        <tr><td>Video YouTube<br><input type="text" name="video_youtube" maxlength="100" size=30 value="<?php echo $pesen->getVideo_youtube(); ?>"><br><br></td></tr>
        <tr><td>Video MetaCafe<br><input type="text" name="video_metacafe" maxlength="150" size=30 value="<?php echo $pesen->getVideo_metacafe(); ?>"><br><br></td></tr>


        <tr><td>Картинка 400x400 max<br><input type="text" name="image" maxlength="100" size=30 value="<?php echo $pesen->getImage(); ?>"><br><br></td></tr>

        <tr><td>Допълнителна информация /например sountrack към игра или филм/<br><textarea name="dopylnitelnoinfo" rows=5 cols=60><?php echo $pesen->getDopylnitelnoinfo(true, false); ?></textarea></td></tr>

        <tr><td>
				Стил<br>

				<?php
				$pesen_janrove = $pesen->getStil();
				foreach (lyric::janrove(1) as $k => $v) {
					?><input type="checkbox" name="<?php echo $k; ?>" value="1" <?php if (isset($pesen_janrove["$k"])) {
						?>checked="checked" <?php } ?>><?php echo $v; ?><br>

				<?php } ?>


                <br>Песента се пее на
                <select name="pee_se_na">
					<?php
					foreach (lyric::ezici() as $k => $v) {
						if ($pesen->getPee_se_na() == $k) {
							?><option selected value="<?php echo $k; ?>"><?php
					echo $v;
				} else {
							?><option value="<?php echo $k; ?>"><?php
							echo $v;
						}
					}
					?>
                </select>
 
                <br>
                <input type="checkbox" name="cenzora" value="1" <?php if ($pesen->cenzora18()) { ?>checked="checked" <?php } ?> >Цензура
                <br>

            </td></tr>


        <tr><td>
                <br><br>



				
				<input type="checkbox" name="delete" value="delete" id="delete" onclick="$('#iztrivane_prichina_div').slideDown(0);">
				<label for="delete">Изтрий</label><br>
				
                <div id="iztrivane_prichina_div" style="display: none">
					<?php echo (int) strlen($pesen->getText(1, 1)) + (int) $pesen->getId() + (int) strlen($username); ?>
					<input type="text" name="deletekod" class="tooltip" size=30 title="Въведи кода за да изтриеш песента" autocomplete="off">				
					<br/>
					<input name="lyric_delete_reason" value="2" type="radio" id="lyric_edit_delete_repeatable" onclick="$('#lyric_edit_delete_other_div').hide();$('#lyric_edit_delete_repeatable_div').show();">
					<label for="lyric_edit_delete_repeatable">повтаряща</label>
					<input name="lyric_delete_reason" type="radio" value="1" id="lyric_edit_delete_other" onclick="$('#lyric_edit_delete_other_div').show();$('#lyric_edit_delete_repeatable_div').hide();">
					<label for="lyric_edit_delete_other">друго</label>
					
				
				
					<div style="display: none;" id="lyric_edit_delete_other_div">
						Причина за изтриване ( ще се прати и като ЛС до изпрателия песента )
						<div style="color: red;">при повторение, посочвай линк към първата песен</div>
						<div id="bbcode_butoni"></div>

						<textarea name="lyric_edit_delete_other_reason" id="bbcode_input" style="width: 450px; height: 40px;" rows=15 cols=90></textarea>
					</div>
					
					<div style="display: none;" id="lyric_edit_delete_repeatable_div">
						линк към песетна:
						<input type="text" name="lyric_existing_link" autocomplete="off"/>
					</div>
                    

                </div>
				
				


            </td></tr>


		</tr>

		<?php if ($userclass >= 100) : ?>
		
		<tr>

			<td style="padding-top: 30px;">
				Download link: <br/>
				<input type="text" maxlength="255" name="download" value="<?php echo $pesen->getDownload(); ?>" />
				
			</td>
		</tr>
		
		<?php endif; ?>
		
        <tr><td>

                <input type="submit" name="submit" value="Промени"><br><br></td></tr>

    </table>
</form>

<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>