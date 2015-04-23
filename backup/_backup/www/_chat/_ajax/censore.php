<?php

header("Content-type: application/json");

require __DIR__ . '/../../__top.php';

if (false === currentUser::isLogged() || false == currentUser::getInstance()->getAcl()->isAllowed(\Tekstove\Acl::CHAT_CENSORE)) {
    zapis('not allowed');
    echo json_encode(['status' => 0]);
    die;
}


$id = (int) $_POST['id'];

$chat = new Tekstove\Chat();

$returnData = [];

try {
    $chat->censore($id);
    $returnData['status'] = 1;
} catch (Tekstove\Chat $e) {
    $returnData['status'] = 0;
}

echo json_encode($returnData);
