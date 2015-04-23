<?php
Require("__top.php");

$bez_reklami = true;
potrebitel::zadaljitelno_lognat($username_id);

try{


//   начало новини

if(isset ($_GET['novini'])){
    if( ($userclass == 9) || ($userclass >= 20) ){
        require 'mod_zelen/novini.php';
        }

    }// край новини


//========================================================================================================================


//Начало Смяна клип
        if(isset ($_GET['smeniklip_id'])){
        require 'mod_zelen/smeniklip_id.php';
        }//Край смяна



 



} catch (Exception $e) {
greshka($e);
}

?>