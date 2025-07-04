<?php require_once "../../private/src/init.php" ?>
<html>

<head>
	<title>New Post</title>
	<link rel="stylesheet" href="/www/assets/css/new_post.css">
</head>

<body>
	<div id="root">

		<?php if (isset($_SESSION['msgs'])): ?>
			<div id="msgs_container">
				<?php foreach ($_SESSION['msgs'] as $msg): ?>
					<div class="msg">
						<h4>Message from server: </h4>
						<p><?php echo $msg; ?></p>
					</div>
				<?php endforeach; ?>
			</div>
			<?php unset($_SESSION['msgs']); ?>
		<?php endif; ?>

		<?php if (!isset($_SESSION['username'])): ?>
			<p>you need to <a href="/www/login.php">login</a> to post!</p>
		<?php else: ?>
			<p>Make a new post as <?php echo $_SESSION['username']; ?></p>


			<form id="form" method="POST" action="/api/new_post.php">
				<label>Title: <input type="text" name="title" required></label>
				<label>Body: <textarea name="body" required></textarea></label>
				<button type="submit">Submit New Post!</button>
			</form>

		<?php endif; ?>
	</div>
</body>

</html>
