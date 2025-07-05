<?php require_once "../../private/src/init.php";
$s_webpage_address = "/www/posts.php";
?>
<html>

<head>
	<title>Posts</title>
	<link rel="stylesheet" href="/www/assets/css/msgs_container.css">
	<link rel="stylesheet" href="/www/assets/css/posts.css">
</head>

<body>
	<div id="root">
		<?php include __root_dir . '/private/components/msgs_container.php'; ?>

		<div id="posts_container">
			<?php
			require __root_dir . '/private/src/get_posts_2.php';
			$posts = get_posts();
			?>
			<?php foreach ($posts as $post): ?>
				<div class="post">
					<h2><?php echo $post['title']; ?></h2>
					<p><?php echo $post['body']; ?></p>
				</div>
			<?php endforeach; ?>

		</div>

	</div>
</body>

</html>
