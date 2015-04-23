<?php Require(SITE_PATH_TEMPLATE . '__top.php'); ?>

<script type="text/javascript">

    var filtyr_html='';
    filtyr_html+='<?php echo $js_filter; ?>';

    filtyr_html+='<br><input type="checkbox" name="prevod" value="1" <?php if (isset($_REQUEST['prevod']))
    echo "checked=\"checked\""; ?>>С превод';

    filtyr_html += '<?php echo addslashes($js_ezik_filter); ?>';

    var stranica_sega=<?php echo $page; ?>;
    filtyr_html+='<br>страница<select name="page" id="filter_stranica">';
    filtyr_html+='<option value="none">страница';
                
    for( q=0;q<<?php echo (int) ($pesni_obshto / 25); ?>;q++){
        if(q!=stranica_sega) filtyr_html+='<option value='+q+'>'+(q+1);
        else filtyr_html+='<option selected value='+q+'>'+(q+1);
    }
    filtyr_html+='</select>';

    filtyr_html = '<form action="" method="get">' +filtyr_html+ '<br><input type="submit" name="submit" value="Филтрирай"></form>';

    function pokaji_filtar(){
        $('#filtyr').html(filtyr_html);
    }



    function razgledai_video(videoyoutube,videovbox){
        var video = '';
        if(videovbox.length>2)
            video = videoVbox(videovbox, 1);
        else if(videoyoutube.length>2)
            video = videoYouTube(videoyoutube, 1);
        $('#naigorezaklip').html(video);

    }

    function razgledai_filter_stranica(nomer){
        $('#filter_stranica').val(nomer);
    }
</script>



<div id="naigorezaklip"></div>

<?php
$imalio6te = 0;
foreach ($pesni as $row) {



    $imalio6te++;
    if ($imalio6te >= 26)
        break;
    ?><div id="tekst"><a href="browse.php?id=<?php echo $row['id']; ?>">

            <?php echo htmlspecialchars($row['zaglavie_sakrateno']); ?></a>

        <?php if ($row['video_youtube']) { ?>&nbsp;<a href="#" onclick="razgledai_video('<?php echo $row['video_youtube']; ?>','0')"><img src="images/youtube_logo.gif" ALT="youtube"></a><?php } ?>
        <?php if ($row['video_vbox7']) { ?>&nbsp;<a href="#" onclick="razgledai_video('0','<?php echo $row['video_vbox7']; ?>')"><img src="images/vbox_logo.gif" ALT="vbox7"></a><?php } ?>
    </div>
    <div id="pokajiprozorecklip"></div>
<?php } ?>

<br>
<?php if ($page >= 1) { ?><a href="razgledai.php?page=<?php echo ($page - 1) . $linkfiltyr; ?>">&#60;&#60;Предишни</a><?php } ?>

&nbsp;&nbsp;<?php echo ($page + 1); ?>&nbsp;&nbsp;

<?php if ($imalio6te >= 26) { ?><a href="razgledai.php?page=<?php echo ($page + 1) . $linkfiltyr; ?>">Следващи&#62;&#62;</a> <?php } ?>


<br>
<div id="filtyr" class="edlink">



    <a href="#" onclick="pokaji_filtar()" ><b>Покажи Филтъра</b></a>
</div>

<?php Require ("__bdqsno.php"); ?>