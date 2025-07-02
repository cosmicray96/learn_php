<html>

<head>
	<title>hello</title>
	<link rel="stylesheet" href="/assets/css/root.css">
	<link rel="stylesheet" href="/assets/css/header.css">
	<link rel="stylesheet" href="/assets/css/nav_bar.css">
</head>

<body>
	<div id="root">
		<div id="header">
			<div id"logo">
				Logo
			</div>

			<nav id="nav_container">
				<ul id="nav_bar">
					<li class="nav_item">Home</li>
					<li class="nav_item">About</li>
					<li class="nav_item">Contacts</li>
				</ul>
			</nav>
		</div>

		<?php
		$value = "from php";
		echo "<p>from php, value: $value</p>";
		?>
	</div>
</body>

<script>
	console.log("javascript!!!");
	console.log("javascript!!!");
</script>

</html>
