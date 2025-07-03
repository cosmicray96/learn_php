<?php
$db_address = "localhost";
$db_username = 'web_user';
$db_pass = 'webPASS32';
$db_name = 'my_app_db';


$title = $_POST['title'];
$body = $_POST['body'];
$author = $_POST['author'];
if (strlen($title) > 255) {
	die("Title longer than 255");
}
if (strlen($author) > 100) {
	die("Author longer than 100");
}

$connection = mysqli_connect($db_address, $db_username, $db_pass, $db_name);

if (!$connection) {
	die("mysqli_prepare failed: " . mysqli_connect_error());
}


$query = 'insert into posts (title, body, author) values (?, ?, ?)';
$stmt = mysqli_prepare($connection, $query);
if (!$stmt) {
	die("mysqli_prepare failed: " . mysqli_error($connection));
}
mysqli_stmt_bind_param($stmt, 'sss', $title, $body, $body);

if (mysqli_stmt_execute($stmt)) {
	echo "Post was submitted successfully";
} else {
	echo "Post was NOT submitted";
}



mysqli_stmt_close($stmt);
mysqli_close($connection);
