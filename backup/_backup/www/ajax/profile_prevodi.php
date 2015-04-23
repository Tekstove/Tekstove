<?php header("Content-Type: text/xml;charset=utf-8");

require '../__top.php';


if (!isset ($_GET['id'])) {
    greshka('Не е посочено ИД');
}
$id = (int)$_GET['id'];

$limit = 0;
if (isset ($_GET['start'])) {
    $limit = $_GET['start'];
}


$stm = $pdo->prepare('SELECT * FROM `prevodi` WHERE `user_id` = :id ORDER BY `id` DESC LIMIT :limit ,21');
$stm -> bindValue(':id', $id, PDO::PARAM_INT);
$stm -> bindValue(':limit', $limit*20, PDO::PARAM_INT);
$stm -> execute();

$broi = 0;

?><?xml version="1.0" encoding="utf-8" ?>
<pesni>
    <?php if($stm->rowCount() == 0 ) { ?>
        <pesen id="#" ime="Няма преводи"></pesen>
    <?php } ?>

<?php foreach ($stm->fetchAll() as $v) { ?>
    <pesen id="<?php echo $v['id']; ?>" ime="<?php echo  htmlspecialchars(htmlspecialchars($v['zaglavie'])); ?>">
    </pesen>
    <?php $broi++;
            if ($broi == 20) {
                break;
            }
    ?>
<?php } ?>

<?php if($stm->rowCount() == 21 ) { ?>
    <link_oshte nomer="<?php echo $limit+1; ?>"></link_oshte>
<?php } ?>

</pesni>