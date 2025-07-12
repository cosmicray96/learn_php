<?php
require_once realpath(__DIR__ . '/../src/init.php');


function get_pdo(): PDO
{
	static $pdo = null;

	if ($pdo) {
		return $pdo;
	}

	$db_address = $_ENV['mysql_address'];
	$db_username = $_ENV['mysql_username'];
	$db_password = $_ENV['mysql_password'];
	$db_name = $_ENV['mysql_db_name'];
	$charset = 'utf8mb4';

	$dsn = "mysql:host=$db_address;dbname=$db_name;charset=$charset";

	$options = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	];

	$pdo = new PDO($dsn, $db_username, $db_password, $options);
	return $pdo;
}
