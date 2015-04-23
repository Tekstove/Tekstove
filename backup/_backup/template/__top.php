<!DOCTYPE html>
<html>
	<head>

		<link rel="stylesheet" href="<?php echo SITE_STYLE_CSS; ?>" type="text/css">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

		<?php echo Cdn::getJsCode(); ?>

		<script src="/js/functions.js?v=4.4" type="text/javascript"></script>

		<link type="text/css" href="/css/smoothness/jquery-ui-<?php echo SITE_JS_JQUERY_UI_VERSION; ?>.custom.min.css" rel="stylesheet">



		<title>
			<?php
				if (isset ($meta_title)) {
					echo $meta_title;
				} else {
					echo "Текстове.инфо";
				}
			?>
		</title>
		<meta name="author" content="tekstove.info">
		<meta name="revisit-after" content="1 days">
		<meta name="robots" content="index, follow">
		<link rel="shortcut icon" href="/images/favicon.ico">
	</head>
<body>
<table class="glavna">
	<tr>
		<td colspan=3>
			<nav>
				<div class="top-menu">
					<div class="top-menu-home">
						<div class="menu_logo"><a href="/index.php" title="Начална страница"><img src="/images/logo_1.jpg" ALT="Начало"></a></div>
					</div>

					<div class="top-menu-container">
						<span class="top_menu_gore_dqsno">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/index.php">Начало</a><br/>
								&nbsp;&nbsp;<a href="/razgledai.php" rel="search">Разгледай</a><br/>
								<a href="/albumi.php">Албуми</a><br/><br/>
						</span>
					</div>

					<div class="top-menu-container">
						<span class="top_menu_gore_dqsno">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/search.php" rel="search">Търсачка</a><br/>
								&nbsp;&nbsp;&nbsp;&nbsp;<a href="/forum.php">Форум</a><br/>
								&nbsp;&nbsp;&nbsp;<a href="/_chat/">Чат</a>
						</span>
					</div>

					<div class="top-menu-container">
						<span class="top_menu_gore_dqsno">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/uploadliryc.php">Изпрати Tекст</a><br/>
								<?php if($userclass >= 1 ) { ?> &nbsp;&nbsp;&nbsp;&nbsp;<a href="/albumsend.php">Изпрати Албум</a><?php } ?>
						</span>
					</div>
				</div>


				<div style="min-width: 1024px; height: 20px; background-color: #000000;">

					<div class="top-menu-under-left top-menu-under">
							&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="/index.php">Начало</a>&nbsp;
							<a href="/razgledai.php" rel="search">Разгледай</a>&nbsp;
							<a href="/albumi.php">Албуми</a>&nbsp;
							<a href="/search.php" rel="search">Търсачка</a>&nbsp;
							<a href="/forum.php">Форум</a>&nbsp;
					</div>

					<div style="" class="top-menu-under top-menu-under-center">
						<a href="/uploadliryc.php" class="top">Изпрати Tекст</a>&nbsp;
						<?php if($userclass >= 1 ) { ?> <a href="/albumsend.php">Изпрати Албум</a>&nbsp; <?php } ?>
					</div>

					<div class="top-menu-under top-menu-under-right">
						<?php echo $user_menu; ?>
						&nbsp;&nbsp;&nbsp;&nbsp;
					</div>

				</div>

				<div class="prelivane_bukvi_header"></div>
				<div class="bukvi" id="bukvi_bg"></div>
			</nav>
		</td>
	</tr>
	<tr>
		<td class="nomer2" colspan=3>

			<div class="cherta_po_bukvite"></div>

			<table style="width:100%">
				<tr>
					<td class="top_sub_menu_genres">
						<a class="linkkart" href="/razgledai.php?stilraphiphop=1&amp;stilhiphop=1&amp;stilskit=1&amp;stilbreakbeat=1&amp;stilbigbeat=1&amp;stileastcoast=1"><img src="/images/stilrap.gif" ALT="RAP"></a>
						<a class="linkkart" href="/razgledai.php?stilelektronna=1"><img src="/images/stiltechno.gif" ALT="Techno" ></a>
						<a class="linkkart" href="/razgledai.php?stilchalga=1&amp;stilpopfolk=1"><img src="/images/stilchalga.gif" ALT="чалга"></a>
						<a class="linkkart" href="/razgledai.php?stilmetal=1&amp;stilmetal_heavy=1&amp;stilmetal_death=1&amp;stilmetal_nu=1&amp;stilmetal_gothic=1&amp;stilmetal_symphonic=1&amp;stilmetal_power=1"><img src="/images/stilmetal.gif" ALT="METAL"></a>
						<a class="linkkart" href="/razgledai.php?stilrok=1&amp;stilrok_clas=1&amp;stilrok_alt=1&amp;stilrok_hard=1"><img src="/images/stilrock.gif" ALT="ROCK"></a>
						<a class="linkkart" href="/razgledai.php?stillatam=1&amp;stilsamba=1&amp;stiltango=1&amp;stilsalsa=1"><img src="/images/latino.gif" ALT="Латино"></a>
						<a class="linkkart" href="/razgledai.php?stildetski=1"><img src="/images/stildetski.gif" ALT="Деткски"></a>
						<a class="linkkart" href="/razgledai.php?prevod=1"><img src="/images/stilprevod.gif" ALT="Преведени"></a>
					</td>
					<td>
						<a class="linkkart" id="top_menu_chat" href="/_chat/"><img src="/images/chat.gif" ALT="Чат"></a>
					</td>

					<td class="top_sub_menu_languages">
						<a class="linkkart" href="/razgledai.php?pee_se_na=1" TITLE="Песни на Български"><img src="/images/bg.gif" ALT="Песни на Български" style="width: 30px; height: 23px;"></a>
						<a class="linkkart" href="/razgledai.php?pee_se_na=2" TITLE="Песни на Английски"><img src="/images/en.gif" ALT="Песни на Английски" style="width: 30px; height: 23px;"></a>
						<a class="linkkart" href="/razgledai.php?pee_se_na=3" TITLE="Песни на Гръцки"><img src="/images/gr.gif" ALT="Песни на Гръцки" style="width: 30px; height: 23px;"></a>
						<a class="linkkart" href="/razgledai.php?pee_se_na=4" TITLE="Песни на Сръбски"><img src="/images/sr.gif" ALT="Песни на Сръбски" style="width: 30px; height: 23px;"></a>
						<a class="linkkart" href="/razgledai.php?pee_se_na=5" TITLE="Песни на Френски"><img src="/images/fr.gif" ALT="Песни на Френски" style="width: 30px; height: 23px;"></a>
						<a class="linkkart" href="/razgledai.php?pee_se_na=6" TITLE="Песни на Руски"><img src="/images/ru.gif" ALT="Песни на Руски" style="width: 30px; height: 23px;"></a>
						<a class="linkkart" href="/razgledai.php?pee_se_na=7" TITLE="Песни на Немски"><img src="/images/de.gif" ALT="Песни на Немски" style="width: 30px; height: 23px;"></a>
						<a class="linkkart" href="/razgledai.php?pee_se_na=8" TITLE="Песни на Италиански"><img src="/images/it.gif" ALT="Песни на Италиански" style="width: 30px; height: 23px;"></a>
					</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<?php Require SITE_PATH_TEMPLATE . "__blqvo.php"; ?>
        <td class="sadarjanie">
            <br/><br/>
