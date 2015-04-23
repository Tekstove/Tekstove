<?php
/* @var $pesen lyric */
require SITE_PATH_TEMPLATE . '__top.php';

?>
<script type="text/javascript">
    pesen_id = '<?php echo $pesen->getId();?>';
    tekushta_stranica='browse.php?id=<?php echo $pesen->getId();?>';
    video_vbox = '<?php echo $pesen->getVideo_vbox7(); ?>';
    video_youtube = '<?php echo $pesen->getVideo_youtube();?>';
    video_metacafe = '<?php echo $pesen->getVideo_metacafe(); ?>';
    video_link = '<?php echo $pesen->getVideo(); ?>';
    video_autoplay = '<?php echo $username_autoplay; ?>';
</script>



<table width="100%" style="background-color:#EEEEEE;">
    <tr>
        <td style="background-color:#EEEEEE;">
            гледания: <?php echo $pesen->getVidqna(); ?>, популярност: <?php echo $pesen->getPopulqrnost(); ?>
        </td>
        <td style="background-color:#EEEEEE;">
            <div style="text-align:right;">
                <?php if ($pesen->getText_bg(false, false)) { ?>
                    <a href="#prevod" onCLick="javascript:showTranslation();" title="Покажи превода">Превод</a>&nbsp;&nbsp;
                <?php } ?>
                <div id="liubimi" style="display:inline;">
                    <?php if (currentUser::isLogged()) {
                        if ($pesen_v_liubimi_li_e) {
                           ?><a href="#" onCLick="javascript:liubimi_add_remove('remove',<?php echo $pesen->getId(); ?>);return false;" title="Изтрий песента от Любими">Изтрий от Любими</a><?php
                        } else {
                            ?><a href="#" onCLick="javascript:liubimi_add_remove('add',<?php echo $pesen->getId(); ?>);return false;" title="Добави песента към Любими">Добави към Любими</a> <?php
                        }
                    } ?>
                </div>
                <?php if ($pesen_sobstvenik): ?>
                    &nbsp;&nbsp;<a href="/uploadlirycedit.php?id=<?php echo $id; ?>" ><font color="green">Промени</font></a>
                    &nbsp;&nbsp;<a href="/mod_zelen.php?smeniklip_id=<?php echo $id; ?>" ><font color="green">Смени клипа</font></a>
                <?php endif; ?>

                <?php if (currentUser::isLogged() && currentUser::getInstance()->getAcl()->isAllowed(Tekstove\Acl::LYRIC_DELETE_DOUBLED)) : ?>
                    <a href="/lyric_delete_doubled.php?id=<?php echo $pesen->getId(); ?>">изтрии</a>
                <?php endif; ?>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="koi_e_glasuval_div_ajax"></div>
        </td>
    </tr>
</table>

<div id="syob6tenie"></div>
<table width=100%>
    <tr>
        <td align="left">
            <h1>
                <?php if ($pesen->getArtist1()) { {  ?><a href="browsepoartist.php?id=<?php echo $pesen->getArtist1(); ?>" title="Виж текстовете на <?php echo $pesen->getArtist1_ime(); ?>"><?php echo $pesen->getArtist1_ime(); ?></a> <?php } ?>
                <?php if ($pesen->getArtist2()){{ ?> и <a href="browsepoartist.php?id=<?php echo $pesen->getArtist2(); ?>" title="Виж текстовете на <?php echo $pesen->getArtist2_ime(); ?>"><?php echo $pesen->getArtist2_ime(); ?></a> <?php } ?>
                <?php if ($pesen->getArtist3()){{ ?> и <a href="browsepoartist.php?id=<?php echo $pesen->getArtist3(); ?>" title="Виж текстовете на <?php echo $pesen->getArtist3_ime(); ?>"><?php echo $pesen->getArtist3_ime(); ?></a> <?php } ?>
                <?php if ($pesen->getArtist4()){{ ?> и <a href="browsepoartist.php?id=<?php echo $pesen->getArtist4(); ?>" title="Виж текстовете на <?php echo $pesen->getArtist4_ime(); ?>"><?php echo $pesen->getArtist4_ime(); ?></a> <?php } ?>
                <?php if ($pesen->getArtist5()){{ ?> и <a href="browsepoartist.php?id=<?php echo $pesen->getArtist5(); ?>" title="Виж текстовете на <?php echo $pesen->getArtist5_ime(); ?>"><?php echo $pesen->getArtist5_ime(); ?></a> <?php } ?>
                <?php if ($pesen->getArtist6()){{ ?> и <a href="browsepoartist.php?id=<?php echo $pesen->getArtist6(); ?>" title="Виж текстовете на <?php echo $pesen->getArtist6_ime(); ?>"><?php echo $pesen->getArtist6_ime(); ?></a> <?php } ?>
                <?php }}}}}}
                ?> - <?php echo $pesen->getTitle(); ?>
            </h1>
        </td>
        <td align="right">
            <div class="browse_glasuvai_buton">
                <div id="glasuvane" style="padding-top:12px">
                    <?php echo $pesen->getGlasa(); ?>
                    <br/>
                    <?php if ($pesen_potrebitel_glasuval_li_e === false) { ?>
                        <a href="#" onCLick="glasuvai(<?php echo $pesen->getId(); ?>);return false;" title="Гласувай">Гласувай</a>
                    <?php } else { ?>
                        <?php if (false === currentUser::isLogged()) { ?>
                            <a href="login.php" title="Гласувай">Гласувай</a>
                        <?php } else { ?>
                            гласа
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            
            <div id="browse_koi_e_glasuval"><a href="#" onclick="return koi_e_glasuval();">кой е гласувал</a></div>

        </td>
    </tr>
</table>

<?php if ($pesen_albumi): ?>
    <?php foreach ($pesen_albumi as $v): ?>
        <a href="albumvij.php?id=<?php echo $v['id']; ?>">
            <img src="images/album.jpg" alt="албум">
            <i><font size=5><?php echo $v['ime']; ?></font></i>
        </a>
    <?php endforeach; ?>
<?php endif; ?>

<br>
<table>
    <tr>
        <td>
            <div id="video"></div>
            <div id="video_butoni"></div>
        </td>
        <td>
            <div id="browse_problemi"></div>
        </td>
    </tr>
</table>
<?php
// ===== krai video sekciq
?>
<div class="bb_code_text">
    <?php echo $pesen->getDopylnitelnoinfo(); ?>
</div>

<?php if ($pesen->getDownload()): ?>
    <div>
        <a href="<?php echo $pesen->getDownload(); ?>">свали песента <b>download</b></a>
    </div>
<?php endif; ?>


	<div style="width:100%">

        <?php if ($pesen_izpratil) { ?>
            <div style="float:left;">
                изпратено от:
                <b>
                    <a href="profile.php?profile=<?php echo $pesen_izpratil['id']; ?>"><?php echo $pesen_izpratil['ime']; ?></a>
                </b> 
            </div>
        <?php } ?>
        
        <?php if ($userclass >= 100) {
            echo $pesen->getIp_upload();
        } ?>

            
	</div>

	<br>
    <br>
    Маркирана като:
    <?php if ($pesen->getStil()) {
        foreach ($pesen->getStil() as $k => $v) {
            if ($v) { ?>
                <a href="razgledai.php?<?php echo $k; ?>=1"><?php echo $v; ?></a> ,
            <?php } ?>
        <?php  } ?>
    <?php  } ?>
	

    <?php if ($pesen->getPee_se_na()) {
        ?> на <a href="razgledai.php?pee_se_na=<?php echo $pesen_pee_se_na['id']; ?>"><?php echo $pesen_pee_se_na['ime']; ?></a>
    <?php } ?>

<?php if (\Tekstove\Registry::getInstance()->getAdsense()): ?>
	<br/>
	<br/>

	<script type="text/javascript"><!--
		google_ad_client = "ca-pub-9814286074038098";
		/* tekstove 728x90 */
		google_ad_slot = "2608653217";
		google_ad_width = 728;
		google_ad_height = 90;
	//-->
	</script>
	<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
	</script>
<?php endif; ?>
<br>
<a name="prevod" id="prevod"></a>

<?php if ($pesen->cenzora18()) { ?>
	<div id="browse_tekst_buton" class="browse_cenzora">
        18+
        <br>
        Текстът съдържа нецензурирани думи или изрази
        <br>
        <a href="#prevod" onclick="browseShowCensoredLyric(); return false;">
            Покажи текста
        </a>
    </div>
	<div id="browse_tekst" style="display:none;">
<?php } ?>
        
        <table style="border-spacing: 15px;">
            <tr>
                <td style="background-color : #f5f5ff;padding:4px;" Valign="top">
                    <span id="text_glaven">
                        <?php echo $pesen->getText(); ?>
                    </span>
                </td>

        <?php if ($pesen->getText_bg()): ?>

                <td style="background-color : #f5f5ff;padding:4px;"  Valign="top">
                    <span id="text_bg"
                          <?php if (currentUser::isLogged()): ?>
                            style="display:none"
                          <?php endif; ?>
                    >
                        <?php echo $pesen->getText_bg(); ?>
                    </span>
                    <span id="text_bg_show"
                        <?php if (false === currentUser::isLogged()): ?>
                            style="display:none"
                        <?php endif; ?>
                    >
                        <a href="#" onCLick="javascript:showTranslation();return false" title="Покажи превода">
                            <b>
                                <br>&nbsp;П&nbsp;<br>&nbsp;о&nbsp;<br>&nbsp;к&nbsp;<br>&nbsp;а&nbsp;<br>&nbsp;ж&nbsp;
                                <br>&nbsp;и&nbsp;<br>&nbsp;&nbsp;&nbsp;<br>&nbsp;П&nbsp;<br>&nbsp;р&nbsp;
                                <br>&nbsp;е&nbsp;<br>&nbsp;в&nbsp;<br>&nbsp;о&nbsp;<br>&nbsp;д&nbsp;<br>&nbsp;а&nbsp;
                            </b>
                        </a>
                    </span>
                </td>

        <?php else: ?>

            <?php if ($pesen->getPee_se_na() != 1): ?>
                <td style="background-color : #f5f5ff;padding:4px;"  Valign="top">
                    <a href="uploadlirycedit_prevod.php?id=<?php echo $id; ?>">
                        <font color="blue">
                            <br>&nbsp;Д&nbsp;<br>&nbsp;о&nbsp;<br>&nbsp;б&nbsp;<br>&nbsp;а&nbsp;<br>&nbsp;в&nbsp;<br>&nbsp;и&nbsp;
                            <br>&nbsp;&nbsp;&nbsp;<br>&nbsp;п&nbsp;<br>&nbsp;р&nbsp;<br>&nbsp;е&nbsp;<br>&nbsp;в&nbsp;
                            <br>&nbsp;о&nbsp;<br>&nbsp;д&nbsp;<br>
                        </font>
                    </a>
                </td>
            <?php endif; ?>

        <?php endif; ?>

            </tr>
        </table>

<?php if ($pesen->cenzora18()) { ?>
    </div>
<?php } ?>


<table class="komentari">
    <tr>
        <td>
            <a href="komentar_nov.php?id=<?php echo $pesen->getId(); ?>">Добави Коментар</a>
        </td>
    </tr>

    <tr>
        <td>
            <table class="komentari2">
                <?php if ($pesen_komentari): ?>
                    <?php foreach ($pesen_komentari as $v): ?>
                        <tr>
                            <td class="komentari2_top">
                                <?php echo $v['user_skype']; ?>
                                <a href="profile.php?profile=<?php echo $v['user_id']; ?>"><?php echo $v['user_ime']; ?></a>
                            </td>
                            <td class="komentari2_top">
                                <?php echo $v['data_orig'];
                                if ($v['owner']): ?>
                                    <a href="komentar_edit.php?id=<?php echo $v['id'] ?>">edit</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php if ($v['user_avatar']) {
                                    ?><img src="<?php echo $v['user_avatar']; ?>" class="avatar_limit" alt="avatar">
                                <?php } ?>
                            </td>
                            <td>
                                <div class="bb_code_text">
                                    <?php echo $v['text']; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </td>
    </tr>

<?php if (isset ($pesen_oshte_komentari)) { ?>
    <tr>
        <td>
            <br><br><a href="<?php echo $pesen_oshte_komentari; ?>">По-Стари коментари</a>
        </td>
    </tr>
<?php } ?>


</table>

<?php require SITE_PATH_TEMPLATE . "__bdqsno.php"; ?>