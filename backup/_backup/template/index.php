<?php
Require(SITE_PATH_TEMPLATE . '__top.php');


?><table class="pesni">
	<tr><td class="pesni"><div class="top100_index">най-нови текстове</div>


    <?php foreach ($pesni_posledni as $a) {

        ?><a href="browse.php?id=<?php echo $a['id']; ?>" title="<?php echo $a['title']; ?>"><?php echo $a['text']; ?></a><br>
        <?php } ?>



</td><td class="pesni">


    <div class="top100_index">най-нови преводи</div>
    <?php foreach ($pesni_prevedeni as $a) {
         ?><a href="browse.php?id=<?php echo $a['id'] ?>" title="<?php echo $a['title']; ?>"><?php echo $a['text']; ?></a><br>
           <?php } ?>

</td>
	</tr>
	<tr>
		<td class="pesni">

            <div class="top100_index"><a href="top100.php?kakvo=populqrnost">текстове популярни напоследък  -- Топ 100</a></div>
            <?php foreach ($pesni_populqrni as $a) {
                ?><a href="browse.php?id=<?php echo $a['id']; ?>" title="<?php echo $a['title'];?>"><?php echo $a['text'];?></a><br>
                <?php } ?>


		</td>
		<td class="pesni">

    <div class="top100_index"><a href="top100.php?kakvo=vidqna"><b>най-преглеждани текстове</b>&nbsp;&nbsp;--&nbsp;&nbsp;Топ 100</a></div>
		
    <?php

    foreach ($pesni_gledani as $v) {
?><a href="browse.php?id=<?php echo $v['id']; ?>" title="<?php echo $v['title'];?>"><?php echo $v['text'];?></a><br>
        
  <?php  }

    ?>

</td></tr><tr><td class="pesni">

        <div class="top100_index"><a href="top100.php?kakvo=posledno_glasuvani">последно гласувани&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;&nbsp;&nbsp;100 последни</a></div>

        <?php foreach ($pesni_glasuvani_posledn as $a) {

        ?><a href="browse.php?id=<?php echo $a['id']; ?>" title="<?php echo $a['title']; ?>"><?php echo $a['text']; ?></a><br>
        <?php } ?>

</td><td class="pesni">

    <div class="top100_index">произволни текстове от любими</div>
	<?php foreach ($pesni_liubimi as $a) {

            ?><a href="browse.php?id=<?php echo $a['id']; ?>" title="<?php echo $a['title']; ?>"><?php echo $a['text']; ?></a><br>

            <?php } ?>

            
</td></tr><tr><td class="pesni" colspan=2>

            <i><b>най-нови албуми</b></i><br>


            <table class="albums" style="text-align: center;"><tr>
            <?php foreach ($albumi as $a) {

            ?><td class="albumstd" style="text-align: center;">
                        
                        <a href="albumvij.php?id=<?php echo $a['id'] ?>" title="<?php echo $a['title']; ?>">

                            <b><?php echo $a['text'] . $a['year']; ?>
								<img src="<?php echo $a['image']; ?>" style="width: 130px; height: 130px;" ALT="Обложка" />
								<br/>
							</b>
                        </a>


            </td>

            <?php } ?>
            </tr></table>
            
	</td></tr>
	</table> <!-- 1234 -->
	<br>
<div style="width:100%; text-align:center;">

<?php echo $pozdrav; ?>
</div>

	<table style="width: 100%; border: 1px solid black;">
		<tr>
			<td style="text-align: left;">
	            <?php echo $broi_pesni; ?> текста (<i><?php echo $broi_pesni_s_prevod; ?> с превод</i>)
			</td>
			<td style="text-align: left;">
				<?php echo $broi_izpalnitelq; ?> изпълнителя
			</td>
			<td style="text-align: left;">
				&nbsp;<?php echo $broi_albuma; ?> албума
			</td>
			<td style="text-align: right;">&nbsp;
				<a href="potrebiteli.php" title="Виж листа с потребители">
					<?php echo $broi_poptrebiteli; ?> потребители
				</a>
			</td>
			<td style="text-align: right;">
				&nbsp;Последно регистриран
				<a href="profile.php?profile=<?php echo $posledno_registriran_id; ?>"><?php echo $posledno_registriran_ime; ?></a>
			</td>
		</tr>
	</table>

<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>
