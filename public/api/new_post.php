<?php
require_once "../../private/src/init.php";

if (!isset($_SESSION['username'])) {
	$_SESSION['msgs'][] = 'you need to login in order to post';
	header('Location: /new_post.php');
	exit;
}

$db_address = $_ENV['mysql_address'];
$db_username = $_ENV['mysql_username'];
$db_password = $_ENV['mysql_password'];
$db_name = $_ENV['mysql_db_name'];

$title = $_POST['title'];
$body = $_POST['body'];
$username = $_SESSION['username'];
if (strlen($title) > 255) {
	$_SESSION['msgs'][] = 'titles cannot be longer than 255 characters';
	header('Location: /new_post.php');
	exit;
}

$connection;
try {
	$connection = mysqli_connect($db_address, $db_username, $db_password, $db_name);
} catch (mysqli_sql_exception $e) {
	$_SESSION['msgs'][] = 'could not connect to the database';
	header('Location: /new_post.php');
	exit;
}
$user_id;
$query = 'select id from users where username = ?';
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $user_id);

if (!mysqli_stmt_fetch($stmt)) {
	$_SESSION['msgs'][] = "user $username, is not found";
	mysqli_stmt_close($stmt);
	mysqli_close($connection);
	header('Location: /new_post.php');
	exit;
}
mysqli_stmt_close($stmt);


$query1 = 'insert into posts (title, body, user_id) values (?, ?, ?)';
$stmt1 = mysqli_prepare($connection, $query1);
mysqli_stmt_bind_param($stmt1, 'sss', $title, $body, $user_id);

if (mysqli_stmt_execute($stmt1)) {
	$_SESSION['msgs'][] = 'post submitted successfully!';
} else {
	$_SESSION['msgs'][] = 'error in submitting post!';
}
header('Location: /new_post.php');
mysqli_stmt_close($stmt1);

mysqli_close($connection);
exit;
