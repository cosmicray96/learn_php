<?php require_once realpath(__DIR__ . '/../private/src/init.php');

function search()
{
	if (!isset($_GET['query']) || !isset($_GET['type'])) {
		return null;
	}

	$db_address = $_ENV['mysql_address'];
	$db_username = $_ENV['mysql_username'];
	$db_password = $_ENV['mysql_password'];
	$db_name = $_ENV['mysql_db_name'];
	$is_connection = false;
	$is_stmt = false;

	$search_query = $_GET['query'];
	$search_type = $_GET['type'];


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
		$_SESSION['msgs'][] = "Database Error: $e";
		header('Location: /search.php');
		exit;
	}

	mysqli_stmt_close($stmt);
	mysqli_close($connection);
	return $search_results;
}
?>
<html>

<head>
	<title>Search</title>
	<link rel="stylesheet" href="/assets/css/core.css">
	<link rel="stylesheet" href="/assets/css/nav_container.css">
	<link rel="stylesheet" href="/assets/css/msgs_container.css">
	<link rel="stylesheet" href="/assets/css/form.css">
</head>

<body>
	<div id="root">

		<?php require __root_dir . '/private/components/nav_container.php'; ?>
		<?php require __root_dir . '/private/components/msgs_container.php'; ?>

		<form id="form" method="GET" action="/search.php">
			<label>Search: <input type="text" name="query"></label>
			<label>Type: <input type="radio" name="type" value="user">User</label>
			<label>Type: <input type="radio" name="type" value="post">Post</label>

			<button type="submit">Submit!</button>
		</form>

		<?php $search_results = search(); ?>
		<?php if ($search_results !== null): ?>
			<div id="posts_container">
				<?php foreach ($search_results as $result): ?>
					<div id="post">
						<p>Title: <?php echo $result['title']; ?></p>
						<p>User_id: <?php echo $result['user_id']; ?></p>
						<p>Body: <?php echo $result['body']; ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>


	</div>
</body>

</html>
