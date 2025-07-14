<?php if (isset($post)): ?>
	<div class="post">
		<h2>Title: <?php echo $post['title']; ?></h2>
		<p>Made By: <?php echo $post['username']; ?></p>
		<p>Created At: <?php echo $post['created_at']; ?></p>
		<p>Body: <?php echo $post['body']; ?></p>
	</div>
<?php elseif (isset($posts)): ?>

	<?php require realpath(__root_dir . '/private/_common/view/posts_container.php'); ?>

<?php endif; ?>
