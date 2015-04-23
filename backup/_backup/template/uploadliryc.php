<?php
 require SITE_PATH_TEMPLATE . "__top.php"; ?>

<table>
	<tr>
        <td>
            <font color="#FF0000">
                <?php if (false === currentUser::isLogged()) { ?>
                    <b>Не сте влезли в профила си , няма да можете да променяте песента по-късно.</b>
                    <a href="login.php">Вход</a>
                    <br>
                <?php } ?>
                Повтарящите песни се трият! <a href="http://tekstove.info/forum_topic_vij.php?id=568"><u>Правила</u></a><br>
                        ако искате преводът да се запише към профила, моля използвайте опцията 'Добави превод' при разглеждане на текста<br/>
                        <b>Не копирайте преводи !!!</b> Трием акаунти
            </font>
            <form action="" method="post">


                <?php if (isset ($pesni_povtoreniq)) { ?>
                    <br>
                    Намерихме песни, подобни на изпращаната, ако песента я няма, моля цъкни отново <b>изпрати</b>
                    <br>
                    <input type="hidden" name="dobavi" value="1">
                    <?php foreach ($pesni_povtoreniq as $v): ?>
                        <?php echo $v; ?><br>
                    <?php endforeach; ?>
                    <br><br><br><br>
                <?php } ?>

                <table>
                    <tr>
                        <td>

                            <?php for($q=1;$q<=6;$q++) { ?>
                                Изпълнител:
                                <input type="text" id="artist<?php echo $q;?>_tarsene" onkeyup="showHint(<?php echo $q; ?>)" maxlength="100" size=30 autocomplete="off">
                                            <input type="text" id="artist<?php echo $q; ?>_name" maxlength="100" size=30 disabled="disabled" value="<?php echo $pesen['artist'.$q.'_ime'];?>">
                                <input type="text" id="artist<?php echo $q; ?>" name="artist<?php echo $q; ?>" maxlength="100" size=6 value="<?php echo $pesen['artist'.$q];?>">
                                <a href="#" onCLick="javascript:value_smqna('artist<?php echo $q; ?>','');return false" title="Изтрии Изпълнителя">Изтрий</a>
                                <div id="artist<?php echo $q; ?>_ajax" class="tekstpesen"></div>
                            <?php } unset($q); ?>
                            <br>
                            <div class="edlink"><a href="#" onclick="window.open('artistadd.php','--','menubar=no,status=no,location=yes,toolbar=no,scrollbars=yes')">или добави нов</a></div>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            Заглавие*:<br/>
                            <input type="text" name="title" maxlength="60" size=40 value="<?php echo $pesen['title'];?>" autocomplete="off">
                            <br/>
                            <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td style="vertical-align: top;">
                                        Текст*:<br><textarea class="textarea_resizable" name="text" rows=20 cols=48 ><?php echo htmlspecialchars($pesen['text']);?></textarea>
                                    </td>
                                    <td style="vertical-align: top;">
                                        Текст (превод на Български):<br><textarea class="textarea_sync_resize" name="text_bg" rows=20 cols=48 ><?php echo htmlspecialchars($pesen['text_bg']);?></textarea>
                                    </td>
                                </tr>
                            </table>


                            <br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Album link например ( <b><i>http://tekstove.info/albumvij.php?id=<u>5</u></i></b> )
                            или само <u><b>5</b></u><br>
                            <input name="album1" id="album1" maxlength="60" size=40 value="<?php echo $pesen['album1']; ?>">
                            &nbsp;
                            <?php if (isset ($pesen_album_hint_id)) { ?>
                                <a href="#" onCLick="javascript:value_smqna('album1', '<?php echo $pesen_album_hint_id; ?>');return false;">
                                    да не да е номер <?php echo $pesen_album_hint_id; ?> -&gt; <b><?php echo $pesen_album_hint_ime; ?></b>
                                </a>
                            <?php } ?>


                            <br>

                            Друг Album <br><input name="album2" id="album2" maxlength="60" size=40 value="<?php echo $pesen['album2'] ?>">
                            <br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border=1>
                                <tr>
                                    <td>
                                        Video <a href="http://www.vbox7.com/" target="_BLANK"><u>Vbox7</u></a><br><input type="text" name="video_vbox7" maxlength="100" size=30 value="<?php echo $pesen['video_vbox7'];?>">
                                        <br><br>
                                        Video <a href="http://www.youtube.com/" target="_BLANK"><u>YouTube</u></a><br><input type="text" name="video_youtube" maxlength="100" size=30 value="<?php echo $pesen['video_youtube'];?>">
                                        <br><br>
                                        Video <a href="http://www.metacafe.com/" target="_BLANK"><u>MetaCafe</u></a><br><input type="text" name="video_metacafe" maxlength="150" size=30 value="<?php echo $pesen['video_metacafe'];?>">
                                        <br><br>
                                        Video Link<br><input type="text" name="video" maxlength="100" size=30 value="<?php echo $pesen['video'];?>"><br><br>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Картинка link<br>
                            <input type="text" name="image" maxlength="100" size=30 value="<?php echo $pesen['image'];?>">
                            <br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Допълнителна информация /например sountrack към игра или филм/
                            <br>
                            <textarea name="dopylnitelnoinfo" rows=5 cols=60><?php echo $pesen['dopylnitelnoinfo'];?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Стил<br>
                            -------------------
                            <br>
                            <?php foreach (lyric::janrove(1) as $k => $v) {
                                ?><input type="checkbox" name="<?php echo $k; ?>" value="1" <?php if($pesen["$k"]) { ?>checked="checked" <?php } ?>><?php echo $v; ?><br>
                           <?php   } ?>
                            <br>
                            Песента се пее на
                                <select name="pee_se_na">
                                <?php foreach (lyric::ezici() as $i => $e) {
                                    if ($pesen['pee_se_na'] == $i) {
                                        echo '<option selected value="'.$i.'">'.$e;
                                    } else { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $e;

                                    } ?>
                                <?php } ?>
                                </select>

                                <br>

                                <?php if ($username) { ?>
                                    <br>това е поле против автоматични скриптове, оставете празно или текста няма да бъде добавен.<br>
                                    <textarea name="linkss" rows=1 cols=20></textarea>
                                <?php } else { ?>
                                    <br>Защитва против ботове, моля отговете на въпроса (да/не)
                                    Вярно ли е че три плюс три е равно на седем <input type="text" name="antispam">
                                <?php } ?>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" name="submit" value="Изпрати!">
                            <br><br>
                        </td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
</table>
<?php require SITE_PATH_TEMPLATE . "__bdqsno.php"; ?>