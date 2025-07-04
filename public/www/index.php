<?php require_once "../../private/src/init.php" ?>
<html>

<head>
	<title>hello</title>
	<link rel="stylesheet" href="/www/assets/css/index.css">
</head>

<body>
	<div id="root">

		<?php if (isset($_SESSION['username'])): ?>
			<p>Logged in as <?php echo $_SESSION['username']; ?></p>
		<?php endif; ?>


	</div>

</body>

<script>
	console.log("javascript!!!");
	console.log("javascript!!!");
</script>

</html>
