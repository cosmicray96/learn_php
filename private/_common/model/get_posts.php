<?php

function get_posts_2()
{
	$posts = [
		'title1' => 'body1 body1 body1 body1 body1',
		'title2' => 'body2 body2 body2 body2 body2',
		'title3' => 'body3 body3 body3 body3 body3',
		'title4' => 'body4 body4 body4 body4 body4',
	];
	return $posts;
}
function get_posts()
{
	$is_connection = false;
	$is_stmt = false;
	$db_address = $_ENV['mysql_address'];
	$db_username = $_ENV['mysql_username'];
	$db_password = $_ENV['mysql_password'];
	$db_name = $_ENV['mysql_db_name'];

	$connection = 0;
	try {

		$connection = mysqli_connect($db_address, $db_username, $db_password, $db_name);
		$is_connection = true;

		$query = 'select title, body from posts';
		$stmt = mysqli_prepare($connection, $query);
		$is_stmt = true;
		mysqli_stmt_execute($stmt);

		$title =  0;
		$body = 0;
		$posts = [];
		mysqli_stmt_bind_result($stmt, $title, $body);
		while (mysqli_stmt_fetch($stmt)) {
			$posts[] = ['title' => $title, 'body' => $body];
		}
	} catch (mysqli_sql_exception $e) {
		$_SESSION['msgs'][] = 'error in database interactions: ' . $e;
		global $s_webpage_address;
		header("Location: /www/index.php");
		if ($is_stmt) {
			mysqli_stmt_close($stmt);
		}
		if ($is_connection) {
			mysqli_close($connection);
		}
		exit;
	}

	mysqli_stmt_close($stmt);
	mysqli_close($connection);
	return $posts;
	/*
	$posts = [
		['title' => 'title1', 'body' => 'body1 body1 body1 body1 body1'],
		['title' => 'title2', 'body' => 'body2 body2 body2 body2 body2'],
		['title' => 'title3', 'body' => 'body3 body3 body3 body3 body3'],
		['title' => 'title4', 'body' => 'body4 body4 body4 body4 body4'],
	];

	return $posts;
	*/
}
