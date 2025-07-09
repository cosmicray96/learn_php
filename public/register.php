<?php
require_once realpath(__DIR__ . '/../private/src/init.php');
require_once realpath(__root_dir . '/private/controller/register.php');

$controller = new RegisterController();
$controller->handle();
