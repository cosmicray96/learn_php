<?php
require_once 'init.php';

function get_username_from_id($user_id)
{
	$is_connection = false;
	$is_stmt = false;
	$db_address = $_ENV['mysql_address'];
	$db_username = $_ENV['mysql_username'];
	$db_password = $_ENV['mysql_password'];
	$db_name = $_ENV['mysql_db_name'];
	$username = false;

	$connection = false;
	$stmt = false;
	try {
		$connection = mysqli_connect($db_address, $db_username, $db_password, $db_name);
		$query  = 'select username from users where id = ? limit 1';
		$stmt = mysqli_prepare($connection, $query);
		mysqli_stmt_bind_param($stmt, 's', $user_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $username);
		mysqli_stmt_fetch($stmt);
	} catch (mysqli_sql_exception $e) {
		$_SESSION['msgs'][] = "Database Error: $e";
		if ($is_stmt) {
			mysqli_stmt_close($stmt);
		}
		if ($is_connection) {
			mysqli_close($connection);
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($connection);
	return $username;
}
