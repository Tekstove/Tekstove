<?php require '../__top.php';

if(!isset ($_GET['id'])) greshka('не е посочено ид');

$id = $_GET['id'];

try{

$stm=$pdo->prepare('SELECT `text`,`text_bg` FROM `lyric` WHERE `id` = ? ');
$stm->bindValue(1, $id, PDO::PARAM_INT);
$stm->execute();

if($stm->rowCount()==0) greshka('Няма намерени песни', NULL);

$data = $stm->fetch();

echo htmlspecialchars($data['text']);


if($data['text_bg']) {

echo PHP_EOL.PHP_EOL.PHP_EOL.'<b>Превод</b>'.PHP_EOL.PHP_EOL.htmlspecialchars($data['text_bg']);

}


}
catch (Exception $e){
    greshka($e);
}

?>