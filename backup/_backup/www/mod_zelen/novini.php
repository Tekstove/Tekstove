<?php
if($userclass!=9 && $userclass < 20 ){echo 'достъпът отказан'; die();}


    if(isset ($_GET['id'])) $id=(int)$_GET['id'];
    else greshka('не е посочено ИД');

    if(isset ($_POST['novina_izprateno'])){


        if(isset ($_POST['da_iztriq_li']) && $_POST['da_iztriq_li']=="da"){

            $stm = $pdo->prepare("DELETE FROM `novini` WHERE `id` = ? LIMIT 1");
            $stm -> bindValue(1, $id, PDO::PARAM_INT);
            $stm->execute();
            greshka(NULL, 'Новината изтрита');
        }



        if(isset ($_POST['novina_data']))
            $n_data = $_POST['novina_data'];
        else $n_data = NULL;

        if(isset ($_POST['novina_text'])) $n_text = $_POST['novina_text'];
        else $n_text = NULL;

        $stm = $pdo->prepare("UPDATE `novini` SET `text` = ? , `data` = ? WHERE `id` = ? LIMIT 1");
        $stm -> bindValue(1, $n_text, PDO::PARAM_STR);
        $stm -> bindValue(2, $n_data, PDO::PARAM_STR);
        $stm -> bindValue(3, $id, PDO::PARAM_INT);

        $stm -> execute();

        ?><META HTTP-EQUIV="refresh" content="2;URL=forum_topic_vij.php?id=<?php echo $id;?>"> <?php
        greshka(NULL, 'Готово');
    } // POST
    $stm = $pdo->prepare("SELECT * FROM `novini` WHERE `id` = :id LIMIT 1");
    $stm -> bindValue(':id', $id, PDO::PARAM_INT);
    $stm ->execute();

    $data = $stm->fetch();

    if($stm -> rowCount() ==0){
    $stm = $pdo->prepare("INSERT INTO `novini` (`id`,`data`) VALUES ( ? , ? )");

    $stm -> bindValue(1, $id, PDO::PARAM_INT);
    $stm -> bindValue(2, date('Y-m-d'), PDO::PARAM_STR );
    $stm -> execute();


    $stm = $pdo->prepare("SELECT * FROM `novini` WHERE `id` = ? LIMIT 1");
    $stm -> bindValue(1, $id, PDO::PARAM_INT);
    $stm -> execute();

    $data= $stm->fetch();
    }

    if($stm->rowCount() == 0 ) greshka("Не намирам новината, грешка 70");

    $n_data['text'] = htmlspecialchars($data['text']);
    $n_data['data'] = htmlspecialchars($data['data']);




Require(SITE_PATH_TEMPLATE.  '__top.php');
?>
<form action="" method="post">

    <div id="bbcode_butoni"></div>

    <br>

    <textarea cols="20" id="bbcode_input" name="novina_text" rows="5"><?php echo $n_data['text']?></textarea><br>
    <input type="text" name="novina_data" size="10" value="<?php echo $n_data['data']; ?>"><br>

    <select name="da_iztriq_li">
        <option value="ne">просто променям
        <option value="da">Искам да се изтрие
    </select>
    <br>
    <input type="submit" name="novina_izprateno" value="Промени">
</form>
<div id="bbcode_emic"></div>

    <?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php");