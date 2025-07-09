<?php
require_once realpath(__DIR__ . '/../private/src/init.php');
require_once realpath(__root_dir . '/private/controller/index.php');

$controller = new IndexController();
$controller->handle();
