<?php require_once "../../private/src/init.php" ?>
<html>

<head>
	<title>New Post</title>
	<link rel="stylesheet" href="/www/assets/css/new_post.css">
</head>

<body>
	<div id="root">

		<form id="form" method="POST" action="/api/new_post.php">
			<label>Title: <input type="text" name="title" required></label>
			<label>Body: <textarea name="body" required></textarea></label>
			<label>Author: <input type="text" name="author" required></label>
			<button type="submit">Submit New Post!</button>

		</form>

	</div>
</body>

</html>
