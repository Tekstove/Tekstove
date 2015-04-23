<?php

require __DIR__ . '/__top.php';

$groupsManger = new \Tekstove\GroupsManager();
$groups = $groupsManger->getGroups();

require SITE_PATH_TEMPLATE . 'groups.php';
