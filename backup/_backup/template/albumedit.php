<?php Require(SITE_PATH_TEMPLATE . '__top.php'); ?>

<script>
function album_autonumber(id){
    document.getElementById("p"+id).value=parseFloat(document.getElementById("p"+(id-1)).value)+1;
}
</script>

<form action="" method="post">
    <table>
        <tr>
            <td>
                Заглавие:<br><input type="text" name="title" maxlength="60" size=40 value="<?php echo $album['name'];?>"><br><br>
                Година:<br><input type="text" name="year" maxlength="60" size=40 value="<?php echo $album['year'];?>"><br><br>


                Вид:
                <select name="album_vid">
                <?php
                if ($album['vid']) {
                    if(($album['vid'])==1) echo "<option selected value=\"1\">Музикален Албум";
                        else if (($album['vid'])==2) echo "<option value=\"2\">Музика от Филм";
                            else if (($album['vid'])==3) echo "<option value=\"3\">Музика от Игра";
                                else echo "<option selected value=\"0\">---";
                    }
                ?>
                        <option value="0">---
                        <option value="1">Музикален Албум
                        <option value="2">Музика от Филм
                        <option value="3">Музика от Игра
                </select>



                <br><br>
                            <?php for($q=1;$q<=2;$q++) { ?>
                            Изпълнител:
                            <input type="text" id="artist<?php echo $q;?>_tarsene" onkeyup="showHint(<?php echo $q; ?>)" maxlength="100" size=30>
                            <input type="text" id="artist<?php echo $q; ?>_name" maxlength="100" size=30 disabled="disabled" value="<?php echo $album['artist'.$q.'_ime'];?>">
                            <input type="text" id="artist<?php echo $q; ?>" name="artist<?php echo $q; ?>" maxlength="100" size=6 value=<?php echo $album['artist'.$q.'id']; ?>>
                            <a href="#" onCLick="javascript:value_smqna('artist<?php echo $q; ?>','');return false" title="Изтрии Изпълнителя">Изтрий</a>
                            <div id="artist<?php echo $q; ?>_ajax" class="tekstpesen"></div>
                            <?php } ?>




                &nbsp;Или сборен албум:
                <input type="checkbox" name="va" value="1" <?php if ($album['va']) echo "checked=\"checked\"";?>>
                <br><br>
                Картинка link <input type="text" name="image" maxlength="100" size=30 value="<?php echo $album['image'];?>"><br><br>
                Допълнителна информация<br><textarea name="dopylnitelnoinfo" rows=5 cols=30><?php echo $album['dopylnitelnoinfo'];?></textarea>


                <br>Линк към песента или ID ( <u><b>http://www.tekstove.info/browse.php?id=123</b></u> или само <u><b>123</b></u> )
                <br>
                <?php
                for ($q = 1; $q <= 35; $q++) {
                    echo $q;
                    if ($q>1) { ?>
                        <a href="#" onCLick="javascript:album_autonumber(<?php echo $q; ?>);return false">
                            &nbsp;+&nbsp;
                        </a>
                    <?php } ?>

                    <input type="text" name="p<?php echo $q; ?>" id="p<?php echo $q; ?>" maxlength="50" size=20 value="<?php echo $album['p'.$q]; ?>">
                    или името:
                    <input type="text" name="p<?php echo $q; ?>n" maxlength="50" size=20 value="<?php echo $album['p'.$q.'n']; ?>">
                    <br>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="submit" value="Изпрати!"><br><br>
            </td>
        </tr>
    </table>
</form>

<?php Require ("__bdqsno.php"); ?>