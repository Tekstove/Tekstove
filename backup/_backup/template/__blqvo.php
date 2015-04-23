<td rowspan=2 style="
    vertical-align: top;
    border:0px;
    color:#000;
    padding: 20px 2px 15px 0px;
    max-width: 170px;"
    >

    <?php if (currentUser::isLogged()): ?>
        <div class="gore_dolu_zaoblqne_blqvo">
            <b class="rtop_zaoblqne">
                <b class="r1"></b>
                <b class="r2"></b>
                <b class="r3"></b>
                <b class="r4"></b>
            </b>
            <div class="gore_dolu_zaoblqne_blqvo_margin_text">
                <i>Моето&nbsp;Меню:</i><br/>
                Ранг:&nbsp;
                <?php echo currentUser::getInstance()->getRankAsText(); ?>

                <?php if (currentUser::getInstance()->getAcl()->isAllowed(Tekstove\Acl::LYRIC_TRANSLATION_CONFIRM)) {
                    $stm = $pdo->prepare("
                            (SELECT COUNT(`id`) AS `kolko` FROM `pm` WHERE `za`= ? AND `procheteno` = 0)
                            UNION ALL (SELECT COUNT(`id`) AS `kolko` FROM `edit_add_prevod`)
                            UNION ALL (SELECT COUNT(`id`) AS `kolko` FROM `problemi`)
                    ");
                    $stm->bindParam(1, $username_id, PDO::PARAM_INT);
                } else {
                    $stm = $pdo->prepare("
                                (SELECT COUNT(`id`) AS `kolko`,1 FROM `pm` WHERE `za` = ? AND `procheteno`= 0 )
                      UNION ALL (SELECT COUNT(`id`) AS `kolko`,2 FROM `edit_add_prevod` WHERE `za_user_id` = ? )
                    ");
                    $stm->bindParam(1, $username_id, PDO::PARAM_INT);
                    $stm->bindParam(2, $username_id, PDO::PARAM_INT);


                }

                $stm->execute();
                ?>

                <br/>
                <a href="/lichni_syobshteniq.php" title="Непрочетени Лични Съобщения">
                    Непрочетени&nbsp;ЛС:&nbsp;<b>
                <?php
                        $red = $stm->fetch();
                        echo $red['kolko'];
                        if ($red['kolko']) {
                            ?> <img src="/images/novoLS.gif" ALT="Ново ЛС">
                        <?php } ?></b>
                </a>
                <br/>

                <?php $red = $stm->fetch(); ?>
                <a href="/uploadlirycedit_prevod_vij_zaqvki.php">
                    Превод Заявки: <b><?php echo $red['kolko']; ?></b>
                </a>
                <br/>

                <?php if ($userclass >= 20): ?>
                    <?php $red = $stm->fetch(); ?>
                    <a href="/mod.php?problemi=1">
                        Проблеми <b><?php echo $red['kolko']; ?></b>
                    </a>
                <?php endif; ?>


                <div id="blqv_menu_extra_show" style="text-align: right;">
                    <a href="#">&dArr;&dArr;&dArr;</a>
                </div>
                <div style="display: none;" id="blqvo_menu_extra">
                    <a href="/profile.php?profile=<?php echo $username_id; ?>">Профил</a>
                    <br/>
                    <a href="/liubimi_play.php?id=<?php echo $username_id; ?>">Слушай <b>любими</b></a>
                    <br/>
                    <a href="/profile.php?profile=<?php echo $username_id; ?>">Мои преводи</a>
                    <br/>
                    <a href="/browse_deleted.php">Изтрити песни (всички)</a>
                    <br/>
                </div>

            </div>
            <b class="rbottom_zaoblqne">
                <b class="r4"></b>
                <b class="r3"></b>
                <b class="r2"></b>
                <b class="r1"></b>
            </b>
        </div>
    <?php endif; ?>


    <br/>
    <div class="gore_dolu_zaoblqne_blqvo">
        <b class="rtop_zaoblqne">
            <b class="r1"></b>
            <b class="r2"></b>
            <b class="r3"></b>
            <b class="r4"></b>
        </b>
        <div class="gore_dolu_zaoblqne_blqvo_margin_text">

            <a href="/search.php">Търсачка</a>
            <br/>
            <a href="/igra_start.php">Игра - Коя е песента</a>
            <br/>
            <a href="/top100.php?kakvo=populqrnost">Топ 100 популярни</a>
            <br/>
            <a href="/top100.php?kakvo=posledno_glasuvani">Топ 100 гласувани</a>
            <br/>
            <a href="/top100.php?kakvo=vidqna">Топ 100 преглеждани</a>
            <br/>
            <a href="/top100.php?kakvo=posledno_glasuvani">Нови 100 гласа</a>
            <br/>
            <a href="/forum.php">Форум</a>
            <br/>
            <a href="/forum_razdel_vij.php?razdel=1">&#187;&nbsp;Заявки за текстове</a>
            <br/>
            <a href="/forum_topic_nov.php?razdel=1">&#187;&nbsp;&#187;&nbsp;Нова заявки за текст</a>
            <br/>
            <a href="/forum_razdel_vij.php?razdel=6">&#187;&nbsp;Заявки за превод</a>
            <br/>
            <a href="/forum_topic_nov.php?razdel=6">&#187;&nbsp;&#187;&nbsp;Нова&nbsp;заявка&nbsp;за&nbsp;превод</a>
            <br/>
            <a href="/uploadliryc.php">Изпрати текст</a>
            <br/>
            <a href="/komentari_novi.php">Нови коментари</a>
            <br/>
            <a href="/potrebiteli.php">Списък с Потребители</a>
            <br />
            <a href="/groups.php">Лист потребителски групи</a>
            <br/>
            <a href="/partners.php">Партньори</a>
            <br/>
            <a href="/contact.php">Връзка с нас</a>
            <br/>
            <a href="#" onclick="$('#rss_feed').toggle('2000');
                        return false;">RSS<img src="/images/rss_20x15.png" title="rss feed" alt="rss feed" style="width: 20px; height: 15px; cursor: pointer;" /></a>
            <br/>
            <div id="rss_feed" style="display: none; border: 1px orange solid;">
                <a href="http://feeds.feedburner.com/tekstove/zJFY?format=xml">Нови мнения във форума</a>
            </div>




        </div>
        <b class="rbottom_zaoblqne">
            <b class="r4"></b>
            <b class="r3"></b>
            <b class="r2"></b>
            <b class="r1"></b>
        </b>
    </div>

    <br/>
    <div class="gore_dolu_zaoblqne_blqvo">
        <b class="rtop_zaoblqne"><b class="r1"></b><b class="r2"></b><b class="r3"></b><b class="r4"></b></b>
        <div class="gore_dolu_zaoblqne_blqvo_margin_text bb_code_text" style="margin-left: 1px;">
            <?php
                if (true || rand(0, 1)) {
                    $stm = $pdo->prepare('SELECT * FROM `novini` ORDER BY RAND() LIMIT 1');
                    $stm->execute();
                    if ($stm->rowCount() > 0) {
                        $data = $stm->fetch();
                        ?><a href="/forum_topic_vij.php?id=<?php echo $data['id'] ?>" title="Повече информация"><?php
                                echo nl2br(bbcode_format('[b]' . htmlspecialcharsX($data['data'] . '[/b]' . PHP_EOL . $data['text'])));
                                unset($data);
                                ?></a>
                                    <?php
                            }
                        } else { // FACEBOOK LIKE BOX
                            ?>

                            <iframe src ="http://s.tekstove.info/iframe/facebook_iframe.html" width="166" height="205" scrolling="no" frameborder="0"
                                    marginheight="0" marginwidth="0"></iframe>

                            <?php
                        }
                        ?>
        </div>
    </div>
    <b class="rbottom_zaoblqne">
        <b class="r4"></b>
        <b class="r3"></b>
        <b class="r2"></b>
        <b class="r1"></b>
    </b>



    <?php $todayData = today::getTodayOneHtml(); ?>
    <?php if ($todayData) : ?>
        <br/>
        <div class="gore_dolu_zaoblqne_blqvo">
            <b class="rtop_zaoblqne"><b class="r1"></b><b class="r2"></b><b class="r3"></b><b class="r4"></b></b>
            <div class="gore_dolu_zaoblqne_blqvo_margin_text">
                <?php echo $todayData; ?>
            </div>
            <b class="rbottom_zaoblqne"><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b>
        </div>
    <?php endif; ?>



</td>