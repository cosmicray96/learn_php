<?php require_once "../../private/src/init.php";
$db_address = "localhost";
$db_username = 'web_user';
$db_pass = 'webPASS32';
$db_name = 'my_app_db';


$username = $_POST['username'];
$password = $_POST['password'];

if (strlen($username) > 64) {
	die("username longer than 64");
}
if (strlen($password) > 255) {
	die("password longer than 255");
}

$connection = mysqli_connect($db_address, $db_username, $db_pass, $db_name);

if (!$connection) {
	$_SESSION['msgs'][] = 'could not connect to the database';
	header('Location: /www/login.php');
	exit;
}


$query = 'select password_hash from users where username = ?';
$stmt = mysqli_prepare($connection, $query);
if (!$stmt) {
	die("mysqli_prepare failed: " . mysqli_error($connection));
}
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);

$password_hash;
mysqli_stmt_bind_result($stmt, $password_hash);
if (mysqli_stmt_fetch($stmt)) {
	// user found!

	if (password_verify($password, $password_hash)) {

		$_SESSION['username'] = $username;
		$_SESSION['password_hash'] = $password_hash;
		$_SESSION['msgs'][] = 'Logged in!';
		header('Location: /www/login.php');
		exit;
	} else {
		$_SESSION['msgs'][] = 'incorrect password!';
		header('Location: /www/login.php');
		exit;
	}
} else {
	$_SESSION['msgs'][] = "user with name: $username doesnt exist.";
	header('Location: /www/login.php');
	exit;
	/*
	$query1 = 'insert into users (username, password_hash) values (?, ?);';
	$stmt1 = mysqli_prepare($connection, $query1);
	$password_hash1 = password_hash($password, PASSWORD_DEFAULT);
	mysqli_stmt_bind_param($stmt1, 'ss', $username, $password_hash1);
	mysqli_stmt_execute($stmt1);
	echo 'Created new user!';
	*/
}


mysqli_stmt_close($stmt);
mysqli_close($connection);
