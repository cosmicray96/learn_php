<?php require_once "../private/src/init.php" ?>
<html>

<head>
	<title>Users</title>
	<link rel="stylesheet" href="/assets/css/core.css">
	<link rel="stylesheet" href="/assets/css/nav_container.css">
	<link rel="stylesheet" href="/assets/css/msgs_container.css">
</head>

<body>
	<div id="root">

		<?php require __root_dir . '/private/components/nav_container.php'; ?>
		<?php require __root_dir . '/private/components/msgs_container.php'; ?>

		<?php
		if (!isset($_POST['user_id'])) {
			$_SESSION['msgs'][] = "user_id not provided";
			header('Location: /index.php');
			exit;
		}
		$user_id = $_POST['user_id'];
		?>

		<p>username: <?php echo $user_id; ?></p>

	</div>
</body>

</html>
