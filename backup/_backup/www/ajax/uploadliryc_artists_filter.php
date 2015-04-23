<?php
header("Cache-control:no-cache");
header('Content-Type: text/html; charset=UTF-8');


Require ("../__top.php");
use Tekstove\Artist\Artist as Artist;

try {
	
	if (isset($_GET['filter'], $_GET['kyde'])) {
		$filter = str_replace(" ", "%", $_GET['filter']);
		$kyde = (integer) $_GET['kyde'];
		$br_rez = 0;

		$filter = "%" . $filter . "%";

		if (isset($_GET['stranica']))
			$SQL_stranica = (int) $_GET['stranica'] * 20;
		else
			$SQL_stranica = 0;

		$stm = $pdo->prepare("
			SELECT
				`name`, `id`
			FROM
				`artists`
			WHERE
				LOWER(`name`) LIKE LOWER( ? )
				AND " . Artist::getSqlOnlyActive() . "
			ORDER BY
				`name`
			LIMIT ? ,21
		");
		$stm->bindValue(1, $filter, PDO::PARAM_STR);
		$stm->bindValue(2, $SQL_stranica, PDO::PARAM_INT);
		$stm->execute();
		foreach ($stm->fetchAll() as $v) {
			?><a href="#" onCLick="javascript:Izberi_Artist(<?php echo $v['id']; ?>,<?php echo $kyde; ?>,'<?php echo addslashes(htmlspecialchars($v['name'])); ?>');return false;"><?php echo htmlspecialchars($v['name']); ?></a><br><?php
			$br_rez++;
			if ($br_rez > 20) {
				?><br><a href="#" onClick="showHint(<?php echo $kyde; ?>, <?php echo (($SQL_stranica / 20) + 1); ?>, '<?php echo addslashes(htmlspecialchars($_GET['filter'])); ?>');return false"><b>Намерени са над 20 резултата, бъдете по-конкретни</b>&nbsp;&nbsp;&nbsp;&nbsp;следващи</a><?php
				die();
			};
		}
	}
} catch (Exception $e) {
	greshka($e);
}