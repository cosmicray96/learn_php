<?php
require_once realpath(__DIR__ . '/../private/_common/src/init.php');
require_once realpath(__root_dir . '/private/index/controller.php');

$controller = new IndexController();
$controller->handle();
