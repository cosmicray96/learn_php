<?php require_once "../../private/src/init.php" ?>
<html>

<head>
	<title>Login</title>
	<link rel="stylesheet" href="/www/assets/css/new_post.css">
</head>

<body>
	<div id="root">

		<form id="form" method="POST" action="/api/new_user.php">
			<label>Username: <input type="text" name="username" required></label>
			<label>Password: <input type="test" name="password" required></label>
			<button type="submit">Check or Submit New User!</button>

		</form>

	</div>
</body>

</html>
