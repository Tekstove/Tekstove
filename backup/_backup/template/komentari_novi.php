<?php Require(SITE_PATH_TEMPLATE . '__top.php'); ?>

<table class="komentari" ALIGN="center">
    <tr>
        <td>
            <table class="komentari2">
                <?php $imalio6tecom=0;
                foreach ($komentari as $v):

                    $imalio6tecom++;

                    if ($imalio6tecom==21): ?>
                        <tr>
                            <td>
                                <br><br>
                                <a href="?page=<?php echo ($page+1); ?>">По-Стари коментари</a>
                            </td>
                        </tr>
                        <?php break; ?>

                    <?php else: ?>
                        <tr>
                            <td class="komentari2_top">

                                <a href="profile.php?profile=<?php echo $v['sendby'];?>">
                                    <b><?php echo $v['sendby_ime'];?></b>
                                </a>

                            </td>
                            <td class="komentari2_top">
                                <?php echo $v['date_orig']; ?>
                                <?php if($v['sobstvenik']) { ?><a href="komentar_edit.php?id=<?php echo $v['id']; ?>"> edit</a><?php } ?>
                                | за песен <a href="browse.php?id=<?php echo $v['zakoqpesen']; ?>"><b><?php echo $v['pesen_ime']; ?></b></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php if ($v['sendby_avatar']) : ?>
                                    <img src="<?php echo $v['sendby_avatar']; ?>" class="avatar_limit" ALT="avatar">
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="bb_code_text">
                                    <?php echo $v['text'];?>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>

                <?php endforeach; ?>
            </table>
        </td>
    </tr>
</table>


<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>