<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of msgHelper
 *
 * @author potaka
 */
class msgHelper {
    public static function siteOverloaded($msg = 'site overloaded', $code = 500) {
        
        if ($code == 500) {
            @header('HTTP/1.1 500 Internal Server Error');
        }
        
        ?>
            <hrml>
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                </head>
                <body>
            Сайтът е претоварен, опитайте пак след 2-3 минути.<br/>
            Site is overloaded, try again after 2-3 minutes<br/>
        <?php
       
    }
}