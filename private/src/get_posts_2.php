<?php

function get_posts()
{

	$db_address = "localhost";
	$db_username = 'web_user';
	$db_pass = 'webPASS32';
	$db_name = 'my_app_db';

	$connection = mysqli_connect($db_address, $db_username, $db_pass, $db_name);

	if (!$connection) {
		die("mysqli_prepare failed: " . mysqli_connect_error());
	}

	$sql = 'select title, body from posts';
	$result = mysqli_query($connection, $sql);

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$posts[] = ['title' => $row['title'], 'body' => $row['body']];
		}
	}

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
