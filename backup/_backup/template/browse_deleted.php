<?php
/* @var $pesen lyric */
Require(SITE_PATH_TEMPLATE . '__top.php'); ?>



<?php if($pesni == NULL ) { ?>
Няма записи
<?php } else {

    foreach ($pesni as $v) { ?>

<h2><a href="#" onclick="browse_deleted_show_info(<?php echo $v['id']; ?>); return false;" ><?php echo $v['zaglavie']; ?></a> [<?php echo $v['lyric_id']; ?>]</h2>


    <div style="display: none;" id="browse_deleted_details_<?php echo $v['id']; ?>">
<div style="background-color: #DDD;">

    изтрил <a href="profile.php?profile=<?php echo $v['iztril_id']; ?>"><?php echo $v['iztril_ime']; ?></a>
	<br/>
	изпратил текста <b><?php echo $v['up_name']; ?></b>
	<br/>

    причина: <?php echo $v['prichina']; ?>

</div>

<table>

    <tr>
        <td>
            <?php echo $v['text']; ?>
        </td>

        <td>

            <?php echo $v['text_bg']; ?>

        </td>

    </tr>


</table>


<hr>
<br>
    </div>
    <?php }
} ?>



<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>