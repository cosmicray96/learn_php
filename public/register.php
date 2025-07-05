<?php require_once "../private/src/init.php" ?>
<html>

<head>
	<title>Login</title>
	<link rel="stylesheet" href="/assets/css/core.css">
	<link rel="stylesheet" href="/assets/css/nav_container.css">
	<link rel="stylesheet" href="/assets/css/msgs_container.css">
	<link rel="stylesheet" href="/assets/css/form.css">
</head>

<body>
	<div id="root">

		<?php include __root_dir . '/private/components/nav_container.php'; ?>
		<?php include __root_dir . '/private/components/msgs_container.php'; ?>

		<form id="form" method="POST" action="/api/register.php">
			<label>Username: <input type="text" name="username" required></label>
			<label>Password: <input type="test" name="password" required></label>
			<button type="submit">Register!</button>

		</form>

	</div>
</body>

</html>
