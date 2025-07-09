<?php
function search_users($search_query)
{
	return null;
}
function search_posts($search_query)
{
	$db_address = $_ENV['mysql_address'];
	$db_username = $_ENV['mysql_username'];
	$db_password = $_ENV['mysql_password'];
	$db_name = $_ENV['mysql_db_name'];
	$is_connection = false;
	$is_stmt = false;


	try {
		$connection = mysqli_connect($db_address, $db_username, $db_password, $db_name);
		$is_connection = true;
		$query = 'select * from(select title, body, user_id, levenshtein(lower(title), lower(?)) as dist from posts ) as sub where dist <= 3 order by dist asc limit 10';
		$stmt = mysqli_prepare($connection, $query);
		$is_stmt = true;
		mysqli_stmt_bind_param($stmt, 's', $search_query);
		mysqli_stmt_execute($stmt);

		mysqli_stmt_bind_result($stmt, $title, $body, $user_id, $dist);

		while (mysqli_stmt_fetch($stmt)) {
			error_log("error: $title");
			$search_results[] = [
				'title' => $title,
				'body' => $body,
				'user_id' => $user_id,
			];
		}
	} catch (mysqli_sql_exception $e) {
		if ($is_stmt) {
			mysqli_stmt_close($stmt);
		}
		if ($is_connection) {
			mysqli_close($connection);
		}
		throw $e;
		$_SESSION['msgs'][] = "Database Error: $e";
		header('Location: /search.php');
		exit;
	}

	mysqli_stmt_close($stmt);
	mysqli_close($connection);
	return $search_results;
}
