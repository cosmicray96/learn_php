<?php
require_once realpath(__DIR__ . '/../private/_common/src/init.php');
require_once realpath(__root_dir . '/private/posts/controller.php');

$controller = new PostsController();
$controller->handle();
