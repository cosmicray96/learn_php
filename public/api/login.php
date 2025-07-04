<?php require_once "../../private/src/init.php";
error_log("Title: ");

$db_address = $_ENV['mysql_address'];
$db_username = $_ENV['mysql_username'];
$db_password = $_ENV['mysql_password'];
$db_name = $_ENV['mysql_db_name'];


$username = $_POST['username'];
$password = $_POST['password'];

if (strlen($username) > 64) {
	$_SESSION['msgs'][] = "username: $username, is longer than 64 characters.";
	header('Location: /www/register.php');
	exit;
}
if (strlen($password) > 255) {
	$_SESSION['msgs'][] = 'password is longer than 255 characters.';
	header('Location: /www/register.php');
	exit;
}

$connection;
try {


	$connection = mysqli_connect($db_address, $db_username, $db_password, $db_name);
} catch (mysqli_sql_exception $e) {
	$_SESSION['msgs'][] = 'could not connect to the database';
	header('Location: /www/login.php');
	exit;
}


$query = 'select password_hash from users where username = ?';
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, 's', $username);
if (!mysqli_stmt_execute($stmt)) {
	$_SESSION['msgs'][] = 'error in finding user in database';
	mysqli_stmt_close($stmt);
	mysqli_close($connection);
	header('Location: /www/login.php');
	exit;
}

$password_hash;
mysqli_stmt_bind_result($stmt, $password_hash);
if (mysqli_stmt_fetch($stmt)) {

	if (password_verify($password, $password_hash)) {

		$_SESSION['username'] = $username;
		$_SESSION['password_hash'] = $password_hash;
		$_SESSION['msgs'][] = 'Logged in!';
	} else {
		$_SESSION['msgs'][] = 'incorrect password!';
	}
} else {
	$_SESSION['msgs'][] = "user with name: $username doesnt exist.";
}
header('Location: /www/login.php');
mysqli_stmt_close($stmt);
mysqli_close($connection);
