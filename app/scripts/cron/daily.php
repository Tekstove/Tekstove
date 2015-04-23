<?php
require __DIR__ . '/__cli.php';

/* @var $pdo PDO */

$log = '';

//mail('angel.koilov@gmail.com', 'daily cron started', '');

$stm = $pdo->prepare('SELECT * FROM `novini` WHERE ( CURDATE() > `data`  )');
$stm -> execute();
foreach ($stm->fetchAll() as $r) {

    $log .= htmlspecialcharsX($r['data'].' '.$r['text']).'<hr>';


    $stm = $pdo->prepare('UPDATE `forum_topic` SET `topic_razdel` =  8 WHERE `id` = ? LIMIT 1');
    $stm -> bindValue(1, $r['id'], PDO::PARAM_INT);
    $stm -> execute();

}

$stm = $pdo->prepare('DELETE FROM `novini` WHERE ( CURDATE() > `data`  )');
$stm -> execute();

$stm = $pdo->prepare('DELETE FROM `pm` WHERE `data` < DATE_SUB(CURDATE(), INTERVAL 90 DAY) ');
$stm -> execute();
$log .= $stm->rowCount().' изтрити ЛС<br>';

$log .= 'готово';


//mail('angel.koilov@gmail.com', 'daily cron completed', $info);


$log .= 'start empting `flood_control`';
$emptyFloodControl = $pdo->exec("TRUNCATE TABLE `flood_control`");

$log .= ' ... completed';

$log .= PHP_EOL;


// archive chat
$stmuserMessagesCount = $pdo->prepare("
            SELECT
                COUNT(id) AS `count`
            FROM
                chat
            WHERE
                DATE(`date`) <= DATE(:yesterday)
                AND username_id = :userId
                AND id <> :lastMessageId
        ");
$stmUpdateUserArchivedMessagesCount = $pdo->prepare("
            UPDATE
                users
            SET
                chatMessages = chatMessages + :archivedMessages
            WHERE
                id = :userId
        ");
$userLastMessageStatement = $pdo->prepare("
            SELECT
                MAX(id) AS `id`
            FROM
                chat
            WHERE
                username_id = :userId
        ");

$stmChatMessageCountToday = $pdo->prepare("
    SELECT
        COUNT(id) AS `messagesCount`
    FROM
        chat
    WHERE
        DATE(date) = DATE(:today)
");

$stmDeleteUserArchivedMessages = $pdo->prepare("
            DELETE FROM
                chat
            WHERE
                DATE(`date`) <= DATE(:yesterday)
                AND username_id = :userId
                AND id <> :lastMessageId
        ");

$today = date('Y-m-d');
$yesterday = date('Y-m-d', strtotime('-1 day'));

$stmChatMessageCountToday->bindValue('today', $today);
$stmChatMessageCountToday->execute();
$stmChatMessageCountTodayData = $stmChatMessageCountToday->fetch();
if ($stmChatMessageCountTodayData['messagesCount'] > 100) {
    $stmDifferentUsers = $pdo->prepare("
        SELECT
            DISTINCT(username_id)
        FROM
            chat
        WHERE
            DATE(`date`) <= DATE(:yesterday)
            AND username_id IS NOT NULL
    ");
    $stmDifferentUsers->bindValue('yesterday', $yesterday);
    $stmDifferentUsers->execute();
    while ($chatData = $stmDifferentUsers->fetch()) {
        $userId = $chatData['username_id'];
        echo 'processing user ' . $userId;
        
        $userLastMessageStatement->bindValue('userId', $userId);
        $userLastMessageStatement->execute();
        
        if ($userLastMessageStatement->rowCount() == 0) {
            echo 'no messages found' . PHP_EOL;
            continue;
        }
        
        $userLastMessageStatementData = $userLastMessageStatement->fetch();
        $userLastMessageId = $userLastMessageStatementData['id'];
        
        $stmuserMessagesCount->bindValue('yesterday', $yesterday);
        $stmuserMessagesCount->bindValue('userId', $userId);
        $stmuserMessagesCount->bindValue('lastMessageId', $userLastMessageId);
        $stmuserMessagesCount->execute();
        $stmuserMessagesCountData = $stmuserMessagesCount->fetch();
        $userMessagesCount = $stmuserMessagesCountData['count'];
        
        
        
        $stmUpdateUserArchivedMessagesCount->bindValue('userId', $userId);
        $stmUpdateUserArchivedMessagesCount->bindValue('archivedMessages', $userMessagesCount);
        $stmUpdateUserArchivedMessagesCount->execute();
        
        
        $stmDeleteUserArchivedMessages->bindValue('yesterday', $yesterday);
        $stmDeleteUserArchivedMessages->bindValue('userId', $userId);
        $stmDeleteUserArchivedMessages->bindValue('lastMessageId', $userLastMessageId);
        $stmDeleteUserArchivedMessages->execute();
        
        echo PHP_EOL;
    }
    
    $stmDeleteGuestsMessages = $pdo->prepare("
        DELETE FROM
            chat
        WHERE
            username_id IS NULL
            AND DATE(`date`) <= DATE(:yesterday)
    ");
    
    $stmDeleteGuestsMessages->bindValue('yesterday', $yesterday);
    $stmDeleteGuestsMessages->execute();
    
    
    
} else {
    
    echo 'message count < 100. No data to archive';
    $log .= 'message count < 100. No data to archive';
}


zapis($log);

echo PHP_EOL . 'done' . PHP_EOL;