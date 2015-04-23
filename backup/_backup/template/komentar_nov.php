<?php
/* @var $pesen lyric */
Require(SITE_PATH_TEMPLATE . '__top.php'); ?>

<br>
        <div id="bbcode_butoni"></div>
	<form action="" method="post">
	<textarea class="textarea_resizable" name="comment" id="bbcode_input" rows=15 cols=90></textarea>
	<input type="hidden" name="id" maxlength="5" size=5 value="<?php echo $id;?>">
	<br>
	<input type="submit" name="subjoin" value="Добави коментара">
        </form>
        <div id="bbcode_emic"></div>
	<br><br><br>

        <a href="browsepoartist.php?id=<?php echo $pesen->getArtist1(); ?>"><?php echo $pesen->getArtist1_ime(); ?></a>
        &nbsp;-&nbsp;<a href="browse.php?id=<?php echo $pesen->getId(); ?>"><?php echo $pesen->getTitle(); ?></a>
		<hr>

                <table>
                    <?php foreach ($komentari as $k) { ?>
                            <tr><td>
                                <table width=100% border=1>
                                    <tr><td align=left>
                                    <a href="profile.php?profile=<?php echo $k['sendby']; ?>"><?php echo $k['sendby_ime']; ?></a>
                                    </td><td align=right>
                                    <?php echo $k['date_orig']; ?>
                                    </td></tr><tr><td>
                                    </td><td>
                                    <?php echo nl2br(htmlspecialchars($k['text'])); ?>
                                    </td></tr>
                                </table>
                            <?php } ?>
                    </td></tr>
		</table>





<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>