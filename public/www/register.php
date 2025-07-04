<?php require_once "../../private/src/init.php" ?>
<html>

<head>
	<title>Login</title>
	<link rel="stylesheet" href="/www/assets/css/register.css">
</head>

<body>
	<div id="root">

		<?php if (isset($_SESSION['msgs'])): ?>
			<div id="msgs_container">
				<?php foreach ($_SESSION['msgs'] as $msg): ?>
					<div class="msg">
						<h4>Message from server: </h4>
						<p><?php echo $msg ?></p>
					</div>
				<?php endforeach; ?>
			</div>
			<?php unset($_SESSION['msgs']); ?>
		<?php endif; ?>

		<form id="form" method="POST" action="/api/register.php">
			<label>Username: <input type="text" name="username" required></label>
			<label>Password: <input type="test" name="password" required></label>
			<button type="submit">Register!</button>

		</form>

	</div>
</body>

</html>
