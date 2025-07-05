<?php require_once "../private/src/init.php" ?>
<html>

<head>
	<title>hello</title>
	<link rel="stylesheet" href="/assets/css/core.css">
	<link rel="stylesheet" href="/assets/css/nav_container.css">
	<link rel="stylesheet" href="/assets/css/msgs_container.css">
</head>

<body>
	<div id="root">
		<?php include __root_dir . '/private/components/nav_container.php'; ?>
		<?php include __root_dir . '/private/components/msgs_container.php'; ?>


		<?php if (isset($_SESSION['username'])): ?>
			<p>Logged in as <?php echo $_SESSION['username']; ?></p>
		<?php else: ?>
			<p>You are not logged in! <a href="/login.php">login!</a></p>
		<?php endif; ?>


	</div>

</body>

<script>
	console.log("javascript!!!");
	console.log("javascript!!!");
</script>

</html>
