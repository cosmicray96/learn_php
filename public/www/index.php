<?php require_once "../../private/src/init.php" ?>
<html>

<head>
	<title>hello</title>
	<link rel="stylesheet" href="/assets/css/root.css">
</head>

<body>
	<div id="root">

		<?php
		$value = "from php";
		echo "<p>from php, value: $value</p>";
		?>
		<p>hello</p>
		<?php require __root_dir . "/private/components/posts_container.php" ?>
	</div>

</body>

<script>
	console.log("javascript!!!");
	console.log("javascript!!!");
</script>

</html>
