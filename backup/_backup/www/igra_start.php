<?php
require '__top.php';
Require(SITE_PATH_TEMPLATE . '__top.php'); ?>

<form action="igra.php" method="POST">
Изпълнител:
<input type="text" id="artist1_tarsene" onkeyup="showHint(1)" maxlength="100" size=30>
<input type="text" id="artist1_name" maxlength="100" size=30 disabled="disabled" value="">
<input type="text" id="artist1" name="id" maxlength="100" size=6 value="">
<a href="#" onCLick="javascript:value_smqna('artist1','');return false" title="Изтрии Изпълнителя">Изтрий</a>
<div id="artist1_ajax" class="tekstpesen"></div>

<input type="submit" name="submit" value="Напред"> или 
<a href="igra.php">от всички изпълнители</a>
</form>

<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>