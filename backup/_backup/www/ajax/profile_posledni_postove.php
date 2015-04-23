<?php header("Content-Type: text/xml;charset=utf-8");

require '../__top.php';

try{

$limit = 0;
if(!isset ($_GET['id'])) greshka('Не е посочено ИД');
$id = (int)$_GET['id'];

if(isset ($_GET['start'])) $limit = $_GET['start'];


$stm = $pdo->prepare('SELECT `forum_posts`.`post`, `forum_topic`.`id`, `forum_topic`.`topic_name` FROM `forum_posts`
    JOIN `forum_topic` ON `forum_posts`.`za_topic_id` = `forum_topic`.`id`
    WHERE `forum_posts`.`poster` = ? ORDER BY `forum_posts`.`id` DESC LIMIT ? ,21');
$stm -> bindValue(1, $id, PDO::PARAM_INT);
$stm -> bindValue(2, $limit*20, PDO::PARAM_INT);
$stm -> execute();


$broi = 0;



?><?xml version="1.0" encoding="utf-8" ?>
<pesni><?php
    if($stm->rowCount() == 0 ) {
    ?><pesen id="#" ime="Не е гласувал"></pesen><?php
}

foreach ($stm->fetchAll() as $v) {



    ?><pesen id="<?php echo $v['id']; ?>" ime="<?php echo  htmlspecialchars(htmlspecialchars($v['topic_name'])); ?>">
    <post><?php echo htmlspecialchars(bbcode_format(nl2br(htmlspecialchars($v['post'])))); ?></post>
    </pesen>
    <?php $broi++;
            if($broi == 20) {
            break;
            }


}

if($stm->rowCount() == 21 ){
    ?><link_oshte nomer="<?php echo $limit+1; ?>"></link_oshte><?php
}

?>
</pesni>
<?php
}
catch (Exception $e){
    greshka($e);
} ?>