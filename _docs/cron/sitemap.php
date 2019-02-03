<?php

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;

require __DIR__ . '/__cli.php';
define('SITEMAP_PATH', SITE_PATH . 'www/sitemap.xml');

function checkf($filename, $action)
{
	if (is_writable($filename))
		return true;
	else
		return false;
}

function writef($filename, $arr = NULL)
{
	$filename = SITEMAP_PATH;
	if (checkf($filename, "write")) {
		$fp = fopen($filename, "a+");
		if (empty($fp)) {
			greshka('sitemap xml append error');
		}
		fwrite($fp, $arr);
		fclose($fp);
		$wdata = "Записването е успешно.";
	}
	else
		$wdata = "\n R/W permission error." . $filename;
	return $wdata;
}

echo "<br><br>deleting old sitemap...";

$filename = SITEMAP_PATH;

$fs = new Filesystem();
if (false === $fs->exists(SITEMAP_PATH)) {
    $fs->touch(SITEMAP_PATH);
}

$fs->chmod(SITEMAP_PATH, 0644);


$fp = fopen($filename, "w");
fclose($fp);
echo "... done.";

writef("wwwreport", "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<urlset xmlns=\"http://www.google.com/schemas/sitemap/0.84\" >

<url>
<loc>http://tekstove.info/</loc>
<priority>0.9</priority>
<changefreq>always</changefreq>
</url>
");

echo "<br><br>--Започване добавяне на песни";
$stm = $pdo->prepare("SELECT `id` FROM `lyric` WHERE `pee_se_na` = 1 OR `text_bg` LIKE('%_%') ");
$stm->execute();

echo PHP_EOL . PHP_EOL . $stm->rowCount() . PHP_EOL;
foreach ($stm->fetchAll() as $v) {

	writef("wwwreport", "
<url>
<loc>http://tekstove.info/browse.php?id=" . $v['id'] . "</loc>
<priority>1.0</priority>
<changefreq>weekly</changefreq>
</url>
");
}
echo PHP_EOL . "--Започване добавяне на изпълнители";
$stm = $pdo->prepare("SELECT `id` FROM `artists` ");
$stm->execute();
echo PHP_EOL . $stm->rowCount() . PHP_EOL;
foreach ($stm->fetchAll() as $v) {
	writef("wwwreport", "
<url>
<loc>http://tekstove.info/browsepoartist.php?id=" . $v['id'] . "</loc>
<priority>0.7</priority>
<changefreq>weekly</changefreq>
</url>
");
}

echo PHP_EOL . PHP_EOL;
writef("wwwreport", "
</urlset>
");
echo PHP_EOL . "--done......";