<?php require_once "../private/src/init.php" ?>
<html>

<head>
	<title><?php echo $page_title; ?></title>
	<link rel="stylesheet" href="/assets/css/core.css">
	<link rel="stylesheet" href="/assets/css/nav_container.css">
	<link rel="stylesheet" href="/assets/css/msgs_container.css">
	<link rel="stylesheet" href="/assets/css/form.css">
	<link rel="stylesheet" href="/assets/css/foot_container.css">
</head>

<body>
	<div id="root">
		<?php require __root_dir . '/private/view/nav_container.php'; ?>
		<?php require __root_dir . '/private/view/msgs_container.php'; ?>


		<?php require $content_file; ?>

		<?php require __root_dir . '/private/view/foot_container.php'; ?>
	</div>

</body>

</html>
