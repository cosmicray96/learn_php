<?php if (isset($post_id)): ?>
	<p>Should be post here</p>
<?php elseif (isset($posts)): ?>

	<div id="posts_container">
		<?php foreach ($posts as $post): ?>
			<div class="post">
				<h2>Title: <?php echo $post['title']; ?></h2>
				<p>Made By: <?php echo $post['username']; ?></p>
				<p>Created At: <?php echo $post['created_at']; ?></p>
				<p>Body: <?php echo $post['body']; ?></p>
			</div>
		<?php endforeach; ?>
	</div>

<?php endif; ?>
