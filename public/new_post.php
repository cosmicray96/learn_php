<?php
require_once realpath(__DIR__ . '/../private/_common/src/init.php');
require_once realpath(__root_dir . '/private/new_post/controller.php');

$controller = new NewPostController();
$controller->handle();
