<?php
ini_set('log_errors', 1);
ini_set('error_log', '/tmp/php_debug.log');
session_start();
if (!isset($_SESSION['msgs'])) {
	$_SESSION['msgs'] = [];
}
define('__root_dir', (__DIR__ . "/../.."));
require_once __root_dir . '/vendor/autoload.php';
Dotenv\Dotenv::createImmutable(__root_dir)->load();

$s_webpage_address = "";
