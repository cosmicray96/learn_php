<div id="posts_container">
	<?php foreach ($posts as $post): ?>
		<div class="post">
			<h2><?php echo $post['title']; ?></h2>
			<p><?php echo $post['body']; ?></p>
		</div>
	<?php endforeach; ?>

</div>
