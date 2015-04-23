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
    <nav>
        <div style="position: fixed; float: left; width: 100%;">
    
        <div style="min-width: 1024px; height: 24px; background-color: #000000;">

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
                <?php if ($userclass >= 1) { ?> <a href="/albumsend.php">Изпрати Албум</a>&nbsp; <?php } ?>
            </div>

            <div class="top-menu-under top-menu-under-right">
                <?php echo $user_menu; ?>
                &nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            
        </div>
        <div class="prelivane_bukvi_header"></div>
        
    
    </div>
    </nav>
<table class="glavna" style="padding-top: 24px;">

	<tr>
		<?php Require(SITE_PATH_TEMPLATE . "__blqvo.php"); ?>
	<td class="sadarjanie">
<br/><br/>
