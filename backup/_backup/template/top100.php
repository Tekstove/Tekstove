<?php Require(SITE_PATH_TEMPLATE . '__top.php'); ?>






<a href="top100.php?kakvo=glasa">с най-много гласове</a>
&nbsp;&#9679;&nbsp;
<a href="top100.php?kakvo=vidqna">най-гледани</a>
&nbsp;&#9679;&nbsp;
<a href="top100.php?kakvo=populqrnost">популярни напоследък</a>
&nbsp;&#9679;&nbsp;
<a href="top100.php?kakvo=posledno_glasuvani">последни 100 гласа</a>
<br>

<table class="ttop100"><tr><td class="tstop100">Място</td>
        <td class="tstop100">&nbsp;&nbsp;&nbsp;Песен</td>
    <td class="tstop100"><?php echo $kakvo_ime; ?></td></tr>

<?php
if(isset ($kod)) { echo $kod; }

else {

$mqsto = 1; foreach ($pesni as $v){ ?>
		<tr><td class="tstop100"><?php echo $mqsto; ?>&nbsp;</td>
		<td class="ttop100"><a href="browse.php?id=<?php echo $v['id']; ?>"><?php echo $v['zaglavie']; ?></a>
                </td><td class="tstop100"><?php if(isset ($v['kakvo'])) echo $v['kakvo']; ?></td></tr>
		<?php $mqsto++;
		}

}

                ?>
</table>


<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>