<div id="posts_container">
	<?php foreach ($posts as $post): ?>

		<a class="no_style" href="/posts.php?id=<?php echo $post['id']; ?>">
			<div class="post">
				<h2>Title: <?php echo $post['title']; ?></h2>
				<p>Made By: <?php echo $post['username']; ?></p>
				<p>Created At: <?php echo $post['created_at']; ?></p>
				<p>Body: <?php echo $post['body']; ?></p>
			</div>
		</a>
	<?php endforeach; ?>
</div>
