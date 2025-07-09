<?php
require_once realpath(__DIR__ . '/../private/src/init.php');
require_once realpath(__root_dir . '/private/controller/new_post.php');

$controller = new NewPostController();
$controller->handle();
