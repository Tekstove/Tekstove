<?php

use Tekstove\Artist\Artist as Artist;

Require("__top.php");

require SITE_PATH_TEMPLATE . '__top.php';
?><script src="js/mod.js"></script><?php
$bez_reklami = true;

if ($userclass < 20) {
    die("Достъпът отказан");
}

if (!isset($_COOKIE['key_mod_po_taka_l'])) {
    ?><META HTTP-EQUIV="refresh" content="0;URL=login_mod.php"><?php
    die();
}

$stm = $pdo->prepare("SELECT `password_mod_coockie` FROM `users` WHERE `id` = ? LIMIT 1");
$stm->bindValue(1, $username_id, PDO::PARAM_INT);
$stm->execute();

$data = $stm->fetch();
if ($data['password_mod_coockie'] != $_COOKIE['key_mod_po_taka_l']) {
    echo "Грешна парола";
    ?> <META HTTP-EQUIV="refresh" content="0;URL=login_mod.php"> <?php die();
} ?><a href="?pesnibezklipove=1">провери за песни без клипове</a>
<br>
<a href="?pesnibezstil=1">провери за песни без зададен стил</a> НЕ РАБОТИ
<br>
<a href="?posledniizpalniteli=1">Последно добавени изпълнители</a>
<br>
<a href="?iztrii_izpalnitel=1">Изтриване на изпълнител</a>
<br>
<a href="?iztrii_album=1">Изтриване на албум</a>
<br>
<a href="?problemi=1">Проблеми</a>
<br>
<a href="?chat_ban=1">Чат - нов бан</a>
    <br/>
    <a href="?ban_list=1">списък с банове</a> <b>работи</b>

<hr>

<?php
if ($userclass >= 100) {
    ?>
    <a href="?ipBanList=1">ip bans list</a><br/>
    <a href="?log=1">log</a> <a href="?log=1&log_iztrii_cron10min=1">10m cron</a> <a href="?log=1&log_iztrii_glasove=1">glasove</a><br/>


    <form action="?log=1" method="post">

        <input type="text" name="log_delete" value="%%">
        <input type="submit">

    </form>

    <br>
    <?php
}

if ($userclass >= 100) {
    ?><br><a href="?lichnisyobshteniq=1">последи лични съобщения</a>
    <br>
    <a href="?missing_redirects=1">missing redirects</a><br/>
    <br/>
    <a href="?smenipotrebitelklass=1">смяна на потребител клас</a>
    <br>
    <a href="?prebroi_pesni_za_potrebiteli=1">Преброй отново песните на потребителите</a> НЕ РАБОТИ
    <br>
    <a href="?phpinfo=1">php info</a>
    <br>
    <a href="?banIP=1">ip ban</a>
    <br/>
    <br>
    <br>
    <?php
}


if (isset($_GET['phpinfo'])) {
    if ($userclass < 100) {
        greshka('not allowed php info');
    }
    ob_start();
	phpinfo();
    $info = ob_get_contents();
    ob_clean();
    
    $info = preg_replace('#^.*\\<body\\>(.*)\\</body\\>.*$#ims', '$1', $info);
    
    echo $info;
    
	die();
}

if (isset ($_GET['missing_redirects'])) {
    if ($_SESSION['class'] < 100) {
        greshka('missing redirects with access < 100');
    }


    $stm = $pdo->prepare("
        SELECT
            `lyric-iztriti`.*,
            u2.username AS `deleter_username`,
            u1.username AS `up_username`
        FROM
            `lyric-iztriti`
        LEFT JOIN
            `lyric_redirect` ON `deleted_id` = `lyric_id`
        LEFT JOIN
            users u1
                ON u1.id = `lyric-iztriti`.up_id
        LEFT JOIN
            users u2
                ON
                    u2.id = `lyric-iztriti`.id_ztril
        WHERE
            deleted_id IS NULL
        ORDER BY
            `lyric-iztriti`.`id` DESC
        LIMIT 100
        ");
    $stm -> execute();
    ?>
    <?php foreach($stm->fetchAll() as $l) : ?>
        <?php 
        $redirectTo = '';
        preg_match('~browse\.php\?id=([0-9]+)~i', $l['prichina'], $matches);
        if (!empty($matches)) {
            $redirectTo = $matches[1];
        }

        $elementName = uniqid();

        ?>
        id: <?php echo $l['lyric_id']; ?>
        <div class="bb_code_text">
            reason: <?php echo htmlspecialcharsX($l['prichina']); ?> <br/>
        </div>
        title: <?php echo htmlspecialcharsX($l['zaglavie_sakrateno']); ?>
        <br/>
        изпратена от <b><a href="#"><?php echo htmlspecialcharsX($l['up_username']); ?></a></b>,
        изтрита от <b><a href="#"><?php echo htmlspecialcharsX($l['deleter_username']); ?></a></b>
        <br/>
        <input type="text" id="<?php echo $elementName; ?>_from" value="<?php echo $l['lyric_id']; ?>"/>
        -&gt;
        <input type="text" value="<?php echo $redirectTo; ?>" id="<?php echo $elementName; ?>_to"/>
        <input type="button" value="add" onclick="addLyricRedirect('<?php echo $elementName; ?>')" />
        <hr/>

    <?php endforeach; ?>

        <script type="text/javascript">
            function addLyricRedirect(elementPrefix) {
                var from = $('#'+elementPrefix+'_from');
                var to = $('#'+elementPrefix+'_to');
                $.ajax(
                   {
                       type: "POST",
                       url: "/mod/lyric_redirect.php",
                       data: {
                           'lyricFrom':from.attr('value'),
                           'lyricTo':to.attr('value')
                       },
                       dataType: 'json',
                       cache: false,
                       success: function(message)
                       {
                           if (message.status == undefined || message.status == 0) {
                               alert('redirect failed');
                           }
                       },
                       error: function(message) {
                           alert('redirect failed');
                       }
                   });
            }
        </script>
    <?php


}



echo '<hr>';

if (isset($_GET['ipBanList'])) {
    if ($userclass < 100) {
        greshka('user class too low 93');
    }

    $stm = $pdo->prepare('SELECT * FROM `bans` WHERE `date` > CURRENT_TIMESTAMP() ORDER BY `date` DESC');

    $stm->execute();

    if ($stm->rowCount() > 0) {
        foreach ($stm->fetchAll() as $v):
            ?>
            <?php echo htmlspecialcharsX($v['date']); ?>
            &nbsp;&nbsp;&nbsp;
            <?php echo long2ip($v['ip']); ?>

            <br/>

            <?php
        endforeach;
    }
}

if (isset($_GET['banIP'])) {
    if ($userclass < 100) {
        greshka('user class too low 93');
    }


    if (isset($_POST['ip']) && isset($_POST['minutes'])) {

        ban::newBanIP($_POST['ip'], $_POST['minutes']);

        echo 'добавен бан<br>';
    }
    ?>
    <form action="" method="post">


                                        ip<input type="text" name="ip" size="7" value="">

                                        minutes <input type="text" name="minutes" size="5" value="<?php echo '1'; ?>">

        <input type="submit" name="submit" value="ban">

        <br>
        <input type="button" onclick="$('input[name=\'minutes\']').val(60);" value="час">
        <input type="button" onclick="$('input[name=\'minutes\']').val(120);" value="два часа">
        <input type="button" onclick="$('input[name=\'minutes\']').val(1440);" value="ден">
        <input type="button" onclick="$('input[name=\'minutes\']').val(2880);" value="два дена">
        <input type="button" onclick="$('input[name=\'minutes\']').val(4320);" value="три дена">
        <input type="button" onclick="$('input[name=\'minutes\']').val(10080);" value="седмица">

    </form>
    <?php
}


if (isset($_GET['chat_ban'])) {

    if (isset($_POST['chat_msg_id'], $_POST['chat_ban_minutes'])) {

        $force = false;
        if (isset($_POST['chat_force']) && $_POST['chat_force']) {
            $force = true;
        }


        $chat_msg_id = (int) $_POST['chat_msg_id'];
        $chat_ban_minutes = (int) $_POST['chat_ban_minutes'];
        if ($chat_ban_minutes < 1) {
            $chat_ban_minutes = 2;
        }

        $ban = chat_ban::newBanFromMessageID($chat_msg_id, $chat_ban_minutes, $username, $force);

        echo chat_ban::getBanMessageFromStatus($ban);
    } // if chat_msg_id
    else {

        if (isset($_GET['chat_msg_id'])) {
            $chat_msg_id = (int) $_GET['chat_msg_id'];
        }
        else {
            $chat_msg_id = NULL;
        }
    }
    ?>

    <form action="" method="post">

        msg id <input type="text" name="chat_msg_id" size="7" value="<?php if ($chat_msg_id)
        echo $chat_msg_id; ?>">

        minutes <input type="text" name="chat_ban_minutes" size="5" value="<?php echo '1'; ?>">

        <input type="submit" name="submit" value="ban">

        <label for="chat_force_checkbox_1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;force </label>
        <input type="checkbox" name="chat_force" id="chat_force_checkbox_1">


        <br>
        <input type="button" onclick="$('input[name=\'chat_ban_minutes\']').val(60);" value="час">
        <input type="button" onclick="$('input[name=\'chat_ban_minutes\']').val(120);" value="два часа">
        <input type="button" onclick="$('input[name=\'chat_ban_minutes\']').val(1440);" value="ден">
        <input type="button" onclick="$('input[name=\'chat_ban_minutes\']').val(2880);" value="два дена">
        <input type="button" onclick="$('input[name=\'chat_ban_minutes\']').val(4320);" value="три дена">
        <input type="button" onclick="$('input[name=\'chat_ban_minutes\']').val(10080);" value="седмица">

    </form>


    <?php
}



if (isset($_GET['ban_list'])) {
        $stm = $pdo->prepare('
            SELECT *
            FROM `bans`
            WHERE `date` > CURRENT_TIMESTAMP
            ');
        $stm->execute();
        if ($stm->rowCount() == 0) {
            echo 'няма банове по IP <br/>';
        } else {
            foreach ($stm->fetchAll(PDO::FETCH_ASSOC) as $b) {
                echo 'ip: ' . long2ip($b['ip']) . '<br/>to: ' . $b['date'];
                echo '<br/> username:' . htmlspecialcharsX($b['username']) . ', reason: ' . htmlspecialcharsX($b['comment']);
                echo '<hr/>';
            }
        }

        $stm = $pdo->prepare('SELECT * FROM `users` WHERE `banned` >= CURRENT_TIMESTAMP');
        $stm->execute();
        if ($stm->rowCount() == 0) {
            echo 'няма банове по потребители <br/>';
        } else {
            foreach ($stm->fetchAll() as $u) {
                ?><a href="/profile.php?profile=<?php echo $u['id']; ?>"><?php echo htmlspecialcharsX($u['username']); ?></a><?php
                echo ', date: ' . $u['banned'];
                echo '<hr>';
            }
        }

}







if (isset($_GET['forum_edit'])) {

    $id = (int) $_GET['forum_edit'];

    if (isset($_POST['promeni'])) {
        $stm = $pdo->prepare('UPDATE `forum_topic` SET `topic_name` = ? , `topic_razdel` = ? WHERE `id` = ? LIMIT 1');
        $stm->bindValue(1, $_POST['title'], PDO::PARAM_STR);
        $stm->bindValue(2, $_POST['razdel'], PDO::PARAM_INT);
        $stm->bindValue(3, $id, PDO::PARAM_INT);
        $stm->execute();
        ?><META HTTP-EQUIV="refresh" content="0;URL=forum_topic_vij.php?id=<?php echo $id; ?>"><?php
        die();
    }


    $stm = $pdo->prepare('SELECT * FROM `forum_topic` WHERE `id` = ? LIMIT 1');
    $stm->bindValue(1, $id, PDO::PARAM_INT);

    $stm->execute();

    $data = $stm->fetch();

    $stm = $pdo->prepare('SELECT * FROM `forum_razdel` ');
    $stm->execute();
    $data_razdeli = $stm->fetchAll();
    ?>
    <form action="" method="post">
        <input type="text" name="title" value="<?php echo htmlspecialchars($data['topic_name']); ?>"><br>
        <select name="razdel">
            <option value="<?php echo $data['topic_razdel']; ?>">Не променяй
    <?php
    foreach ($data_razdeli as $v) {
        ?><option value="<?php echo $v['id']; ?>"><?php echo $v['name'];
    } ?>

        </select>



        <input type="submit" value="Промени" name="promeni">
        <br>
        <input type="button" onclick="$('select').val(8);" value="Минали събития">
    </form>



    <?php
}












if (isset($_REQUEST['problemi'])) {
    $q = 1;
    $stm = $pdo->prepare('SELECT * FROM `problemi` ORDER BY `id` DESC LIMIT 50');
    $stm->execute();

    foreach ($stm->fetchAll() as $v) {
        ?><div id="<?php echo $q; ?>"><a href="<?php echo $v['url']; ?>" target="_blank"><?php echo nl2br($v['problem']); ?></a>
            <a onclick="mod_problem(<?php echo $v['id'] . ',' . $q . ', ' . (int) $v['lyric_id']; ?>)"><span style="color:red">изтрии</span></a><?php
        if ($v['ot_user_id']) {
            ?> от <a href="profile.php?profile=<?php echo $v['ot_user_id']; ?>" target="_BLANK"><?php echo potrebitel::ime_ot_id($v['ot_user_id']); ?></a>
                <?php
            }
            ?><hr></div> <?php
        $q++;
    }
} // PROBLEMI


if (isset($_REQUEST['log'])) {
    if ($userclass < 100)
        greshka('отказан достъп до лога');


    if (isset($_POST['log_delete'])) {
        if ($_POST['log_delete'] === '%%') {
            die('%% error');
        }

        $stm = $pdo->prepare("DELETE FROM `log` WHERE `text` LIKE ( :log_delete ) ");
        $stm->bindValue(':log_delete', $_POST['log_delete']);
        $stm->execute();
        echo '<h1>' . $stm->rowCount() . ' изтрити</h1><br>';
    }




    if (isset($_GET['log_iztrii_glasove'])) {
        $stm = $pdo->prepare("DELETE FROM `log` WHERE `text` LIKE ('%[kakvo] =&gt; glasove%') ");
        $stm->execute();
        echo '<h1>' . $stm->rowCount() . ' изтрити</h1><br>';
    }


    if (isset($_GET['log_iztrii_atistb'])) {
        $stm = $pdo->prepare("DELETE FROM `log` WHERE `text` LIKE ('%[artistb] =%') ");
        $stm->execute();
        echo '<h1>' . $stm->rowCount() . ' изтрити</h1><br>';
    }

    if (isset($_GET['log_iztrii_cron10min'])) {
        $stm = $pdo->prepare("DELETE FROM `log` WHERE `text` = '10 min cron completed successful' ");
        $stm->execute();
        echo '<h1>' . $stm->rowCount() . ' изтрити</h1><br>';
    }




    if (isset($_GET['logid'])) {
        $stm = $pdo->prepare("DELETE FROM `log` WHERE `id` <= ? ");
        $stm->bindValue(1, $_GET['logid'], PDO::PARAM_INT);
        $stm->execute();
    }



    $stm = $pdo->prepare("SELECT * FROM `log` ORDER BY `id` LIMIT 20");
    $stm->execute();
    foreach ($stm->fetchAll() as $v) {
        ?><br><hr>
        <h1><?php echo htmlspecialchars($v['data']); ?> [<?php echo $v['id']; ?> ]</h1>
        <hr><?php
        echo $v['text'];

        $query_log_id = $v['id'];
    }

    if (isset($query_log_id)) {
        ?><a href="?log=1&logid=<?php echo $query_log_id; ?>"><br>изтрии лога</a><?php
    }
}






// posledni izpylniteli
if (isset($_GET['posledniizpalniteli'])) {
    echo '<div class="profile_vij_statistika">';
    $stm = $pdo->prepare("SELECT * FROM `artists` ORDER BY `id` DESC LIMIT 25");
    $stm->execute();
    foreach ($stm->fetchAll() as $v) {
        ?><a href="browsepoartist.php?id=<?php echo $v['id']; ?>"><?php echo htmlspecialchars($v['name']); ?></a> от <?php echo potrebitel::ime_ot_id($v['addedby']); ?><br>
        <?php
    }

    echo '</div>';
}



// изтриване на изпълнител
if (isset($_GET['iztrii_izpalnitel'])) {

    if (isset($_POST['submit'], $_POST['iztrivane_id'])) {
        $iztrivane_id = (int) $_POST['iztrivane_id'];

        $stm = $pdo->prepare(" SELECT `id` from `lyric`
                        WHERE	`artist1` = :id
                        OR	`artist2` = :id
                        OR	`artist3` = :id
                        OR	`artist4` = :id
                        OR	`artist5` = :id
                        OR	`artist6` = :id ");
        $stm->bindValue(':id', $iztrivane_id, PDO::PARAM_INT);
        $stm->execute();
        foreach ($stm->fetchAll() as $v) {
            ?><a href="browse.php?id=<?php echo $v['id']; ?>">намерена песен на изпълнителя</a><?php
            die();
        }

        $artist = new Artist($iztrivane_id);
        $artist->delete();

        echo 'изтрито';
    }
    else {
        ?>
        <form action="" method="post">
                                                                                        ID:
            <br><input type="text" name="iztrivane_id" maxlength="6" size=6>
            <input type="submit" name="submit" value="Изтрии">
        </form>



        <?php
    }
}


if (isset($_GET['iztrii_album'])) {

    if (isset($_POST['submit'])) {
        $iztrivane_id = (int) $_POST['iztrivane_album_id'];

        $stm = $pdo->prepare(" SELECT `name`,`artist1id`,`dopylnitelnoinfo`,`year`,`image`,`p1`,`p1n` FROM `albums` WHERE `id` = ? ");
        $stm->bindValue(1, $iztrivane_id, PDO::PARAM_INT);
        $stm->execute();
        if ($stm->rowCount() == 0)
            greshka(NULL, 'Албумът не е намерен');
        $v = $stm->fetch();
        foreach ($v as $ak => $av) {
            if ($av) {
                echo htmlspecialchars($av) . ' трябва да се изтрие ' . htmlspecialchars($ak);
                die();
            }
        }

        $stm = $pdo->prepare('DELETE FROM `albums` WHERE `id` = ? LIMIT 1');
        $stm->bindValue(1, $iztrivane_id, PDO::PARAM_INT);
        $stm->execute();

        echo '<br>албума изтрит';
        die();
    }
    else {
        ?>
        <form action="" method="post">
                                                                                        ID:
            <br><input type="text" name="iztrivane_album_id" maxlength="6" size=6>
            <input type="submit" name="submit" value="Изтрии">
        </form>



        <?php
    }
}





// Лични съобения
if (isset($_GET['lichnisyobshteniq']) && ($userclass >= 100)) {
    if (isset($_GET['iztrii_ld_id'])) {
        die('ne raboti');
        mysql_query('DELETE FROM `pm` WHERE `id` = ' . (int) $_GET['iztrii_ld_id']);
    }



    echo "<br><br>";
    $stm = $pdo->prepare('SELECT * FROM pm ORDER BY id DESC LIMIT 25');
    $stm->execute();
    foreach ($stm->fetchAll() as $row) {
        ?>

        от <b><a href="profile.php?profile=<?php echo $row['ot']; ?>"><?php echo potrebitel::ime_ot_id($row['ot']); ?></a></b>
        за <b><?php echo potrebitel::ime_ot_id($row['za']); ?></b>
        относно <b><?php echo htmlspecialcharsX($row['otnosno']); ?></b>
        <a href="?lichnisyobshteniq=1&iztrii_ld_id=<?php echo $row['id']; ?>"> del </a>
        <?php echo long2ip($row['ip']); ?>
        <div style="background:#AAAAAA;"><?php echo htmlspecialcharsX($row['text']); ?></div><br/><br/>
        <?php
    }
}



if (isset($_GET['artist_edit'])) {
    $artist_id = (int) $_GET['artist_edit'];

    if (isset($_POST['ime'])) {
        $stm = $pdo->prepare('UPDATE `artists` SET `name` = ? WHERE `id` = ? ');
        $stm->bindValue(1, $_POST['ime'], PDO::PARAM_STR);
        $stm->bindValue(2, $artist_id, PDO::PARAM_INT);
        $stm->execute();
    }




    $stm = $pdo->prepare('SELECT * FROM `artists` WHERE `id` = ? LIMIT 1');
    $stm->bindValue(1, $artist_id, PDO::PARAM_INT);
    $stm->execute();

    if ($stm->rowCount() == 0)
        die('Няма такъв изпълнител');

    $data = $stm->fetch();
    ?>

    <form action="" method="POST">
        име:<input type="text" name="ime" value="<?php echo htmlspecialchars($data['name']); ?>">
        <input type="submit" value="промени">

    </form>
    <?php
}




//Начало Песни без клипове
if (isset($_GET['pesnibezklipove'])) {
    echo "<br><br>";
    $querypesnibezklip = mysql_query("SELECT id FROM lyric WHERE video_vbox7='' AND video_youtube='' ORDER BY `id` DESC LIMIT 20");
    $stmLyricsWithoutClips = $pdo->prepare("
        SELECT
            *
        FROM
            lyric
        WHERE
            video_vbox7 = ''
            AND video_youtube = ''
        ORDER BY
            `id` DESC
        LIMIT
            20
        ");
    $stmLyricsWithoutClips->execute();
    $lyricsWithoutClips = $stmLyricsWithoutClips->fetchAll();
    foreach ($lyricsWithoutClips as $lyricData) {
        $lyric = new lyric($lyricData);
        echo "<a href=\"browse.php?id=" . $lyric->getId() . "\">" . $lyric->get_Zaglavie_sakrateno() . "</a><br>";
    }
}
//Край песни без клипове
