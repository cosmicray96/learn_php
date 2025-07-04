<?php require_once "../../private/src/init.php";
$db_address = "localhost";
$db_username = 'web_user';
$db_pass = 'webPASS32';
$db_name = 'my_app_db';


$username = $_POST['username'];
$password = $_POST['password'];
$password_hash = password_hash($password, PASSWORD_DEFAULT);

if (strlen($username) > 64) {
	$_SESSION['msgs'][] = "username: $username, is longer than 64 characters.";
	header('Location: /www/register.php');
	exit;
}
if (strlen($password) > 255) {
	$_SESSION['msgs'][] = "password is longer than 255 characters.";
	header('Location: /www/register.php');
	exit;
}

$connection;
try {

	$connection = mysqli_connect($db_address, $db_username, $db_pass, $db_name);
} catch (mysqli_sql_exception $e) {
	$_SESSION['msgs'][] = 'could not connect to the database';
	header('Location: /www/register.php');
	exit;
}
$query = 'select 1 from users where username = ? limit 1';
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
	header('Location: /www/register.php');
	mysqli_stmt_close($stmt);
	mysqli_close($connection);
	$_SESSION['msgs'][] = "user with username: $username, exists";
	exit;
}
mysqli_stmt_close($stmt);


$query1 = 'insert into users (username, password_hash) values (?, ?);';
$stmt1 = mysqli_prepare($connection, $query1);
mysqli_stmt_bind_param($stmt1, 'ss', $username, $password_hash);
if (mysqli_stmt_execute($stmt1)) {
	$_SESSION['msgs'][] = 'new user created!';
} else {
	$_SESSION['msgs'][] = 'failed to create new user';
}
mysqli_stmt_close($stmt1);

mysqli_close($connection);
header('Location: /www/register.php');
exit;
