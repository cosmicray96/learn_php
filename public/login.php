<?php
require_once realpath(__DIR__ . '/../private/src/init.php');
require_once realpath(__root_dir . '/private/controller/login.php');

$controller = new LoginController();
$controller->handle();
