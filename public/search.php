<?php require_once realpath(__DIR__ . '/../private/src/init.php');
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

		<?php
		if (isset($_GET['query']) && isset($_GET['type'])) {
			require_once realpath(__root_dir . '/private/src/search.php');
			if ($_GET['type'] === 'post') {
				$search_results_posts = search_posts($_GET['query']);
			}
			if ($_GET['type'] === 'user') {
				$search_results_users = search_users($_GET['query']);
			}
		}
		?>
		<?php if (isset($search_results_posts) && count($search_results_posts)): ?>
			<div id="posts_container">
				<?php foreach ($search_results_posts as $result): ?>
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
