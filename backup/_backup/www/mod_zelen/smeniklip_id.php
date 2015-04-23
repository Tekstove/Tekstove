<?php
if(!isset ($_REQUEST['smeniklip_id'])) greshka('ne e poso4eno id','Не намирам песента');
        $pesen = new lyric((int)$_REQUEST['smeniklip_id']);

        if($username_id != $pesen->getUp_id()){
          if($userclass<20) greshka('отказан достъп', 'Достъпът отказан');
            }


            if(isset ($_POST['izprati'],$_POST['pesen_id']) && ($pesen->getId() === (int)$_POST['pesen_id']) ){

                if(isset ($_POST['pesen_ytub'])) $Svideo_youtube = lyric::video_youtube($_POST['pesen_ytub']);
                else $Svideo_youtube = NULL;

                if(isset ($_POST['pesen_vbox'])) $Svideo_vbox7 = lyric::videoc_vboxcode($_POST['pesen_vbox']);
                else $Svideo_vbox7 = NULL;


                $stm = $pdo->prepare("UPDATE `lyric` set
                `video_vbox7` = ?,
                `video_youtube` = ?
                WHERE `id` = ? LIMIT 1
                ");

                $stm->bindValue(1, $Svideo_vbox7, PDO::PARAM_STR);
                $stm->bindValue(2, $Svideo_youtube, PDO::PARAM_STR);
                $stm->bindValue(3, $pesen->getId(), PDO::PARAM_STR);

                $stm->execute();


                ?>готово<br>

                <b><a href="browse.php?id=<?php echo $pesen->getId(); ?>">обратно към песента</a></b>
                <META HTTP-EQUIV="refresh" content="2;URL=browse.php?id=<?php echo $pesen->getId();?>">

                <?php die();
                }



            Require(SITE_PATH_TEMPLATE . '__top.php');
            ?>
            <br>смяна клип<br>
            <form action="" method="post">
                <input type="hidden" name="pesen_id" value="<?php echo $pesen->getId(); ?>">

                <h1><?php echo $pesen->get_Zaglavie_sakrateno(); ?></h1>
                <br>

                Vbox<input type="text" name="pesen_vbox" value="<?php echo $pesen->getVideo_vbox7();?>" size="35">
                <br>
                Ytube<input type="text" name="pesen_ytub" value="<?php echo $pesen->getVideo_youtube();?>" size="35">
                <br>
                <input type="submit" value="Смени" name="izprati">
            </form>

            <?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>