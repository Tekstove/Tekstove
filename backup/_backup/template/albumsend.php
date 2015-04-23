<?php Require(SITE_PATH_TEMPLATE . '__top.php'); ?>


<form action="" method="post" id="albumForm">

    Заглавие:<br>
    <input type="text" name="title" maxlength="60" size=40 value="">
    <br><br>
    Година:<br>
    <input type="text" name="year" maxlength="60" size=40 value="">
    <br><br>

    Вид:
    <select name="album_vid">
        <option value="0">---
        <option value="1">Музикален Албум
        <option value="2">Музика от Филм
        <option value="3">Музика от Игра
    </select>
    
    <br><br>

    <?php for($q=1; $q<=2; $q++): ?>
        Изпълнител:
        <input type="text" id="artist<?php echo $q;?>_tarsene" onkeyup="showHint(<?php echo $q; ?>)" maxlength="100" size=30>
        <input type="text" id="artist<?php echo $q; ?>_name" maxlength="100" size=30 disabled="disabled" value="">
        <input type="text" id="artist<?php echo $q; ?>" name="artist<?php echo $q; ?>" maxlength="100" size=6 value="">
        <a href="#" onCLick="javascript:value_smqna('artist<?php echo $q; ?>','');return false" title="Изтрии Изпълнителя">Изтрий</a>
        <div id="artist<?php echo $q; ?>_ajax" class="tekstpesen"></div>
    <?php endfor; ?>


    &nbsp;Или сборен албум:
    <input type="checkbox" name="va" value="1">
    <br><br>
    Картинка link<br>
    <input type="text" name="image" maxlength="100" size=30 value="">
    <br><br>
    Допълнителна информация<br>
    <textarea name="dopylnitelnoinfo" rows=5 cols=50 ></textarea>


    <br>Линк към песента или ID ( <u><b>http://www.tekstove.info/browse.php?id=123</b></u> или само <u><b>123</b></u> )
    <br>
    <?php
    for ($q = 1; $q <= 35; $q++): ?>
        <?php echo $q; ?>
        <input type="text" name="p<?php echo $q; ?>"
               maxlength="50" size=30
               value="">
        или името:
        <input type="text" name="p<?php echo $q; ?>n"
               maxlength="50" size=30
               value="">
        <br> 
    <?php endfor; ?>

    <br>
    <input type="submit" name="submit" value="Изпрати!" id="albumSend">
    <br><br>

</form>

<script>
    $('#albumSend').click(function() {
        var data = $('#albumForm').serialize();
       
        $.ajax({
            url: "",
            data: data,
            type: 'POST'
        }).done(function(response) {
            if (response.status === 'ok') {
                window.location = '/albumvij.php?id=' + response.id;
            } else {
                alert ('error');
            }
        });
       
       return false;
    });
</script>

<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>