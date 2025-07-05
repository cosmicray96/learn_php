<?php require_once "../private/src/init.php" ?>
<html>

<head>
	<title>New Post</title>
	<link rel="stylesheet" href="/assets/css/core.css">
	<link rel="stylesheet" href="/assets/css/nav_container.css">
	<link rel="stylesheet" href="/assets/css/msgs_container.css">
	<link rel="stylesheet" href="/assets/css/form.css">
</head>

<body>
	<div id="root">

		<?php include __root_dir . '/private/components/nav_container.php'; ?>
		<?php include __root_dir . '/private/components/msgs_container.php'; ?>

		<?php if (!isset($_SESSION['username'])): ?>
			<p>you need to <a href="/login.php">login</a> to post!</p>
		<?php else: ?>
			<p>Make a new post as <?php echo $_SESSION['username']; ?></p>

			<form id="form" method="POST" action="/api/new_post.php">
				<label>Title: <input type="text" name="title" required></label>
				<label>Body: <textarea name="body" required></textarea></label>
				<button type="submit">Submit New Post!</button>
			</form>

		<?php endif; ?>
	</div>
</body>

</html>
