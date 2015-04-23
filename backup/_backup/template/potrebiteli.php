<?php Require(SITE_PATH_TEMPLATE . '__top.php'); ?>
<table class="potrebiteli" align="center">
    <tr>
        <td class="potrebitelitop" colspan="4"><form action="" method="get" > Търси потребител по име: <input type="text" name="filtar" value="<?php if (isset($_GET['filtar'])) echo htmlspecialchars($_GET['filtar']); ?>"><input type="submit" value="търси"></form></td>
    </tr>


    <tr>
        <td class="potrebitelitop"><a href="?potrebiteli_sort=2">потребителско име</a></td>
        <td class="potrebitelitop"><a href="?potrebiteli_sort=3">изпратени текстове</a></td>
        <td class="potrebitelitop"><a href="?potrebiteli_sort=0">регистриран</a></td>
        <td class="potrebitelitop">ранг</td>
    </tr><?php
$imalio6te = 0;
foreach ($users as $user) {
    /* @var $user potrebitel */
    $imalio6te++;
    if ($imalio6te >= 31)
        break;
    ?><tr>
            <td class="potrebiteliime"><a href="profile.php?profile=<?php echo $user->getId(); ?>" title="Виж профила"><?php echo $user->getUsername(); ?></a></td>

            <td class="potrebiteliregistriran"><?php echo $user->getLyricsCount(); ?></td>


            <td class="potrebiteliregistriran"></td>

            <td class="potrebiteliregistriran"><?php echo $user->getRankAsText(); ?></td>

        </tr>

<?php } ?>
    <tr><td class="potrebitelitop" colspan="4">

            <?php ?>

            <?php if ($page >= 1) { ?><a href="potrebiteli.php?page=<?php echo ($page - 1);
            echo $linkfiltyr_sort; ?>">&#60;&#60;Предишни</a>&nbsp;&nbsp;<?php echo ($page + 1); ?>&nbsp;&nbsp;<?php } ?>
            <?php if ($imalio6te >= 31) { ?><a href="potrebiteli.php?page=<?php echo ($page + 1);
            echo $linkfiltyr_sort;
            echo $linkfiltyr; ?>">Следващи&#62;&#62;</a><?php } ?>

        </td></tr>
</table>

<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>