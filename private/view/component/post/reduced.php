<?php
if (!isset($post)) {
	throw new AppException();
}
?>
<a class="no_style" href="/posts?id=<?php echo $post['id']; ?>">
	<div class="post_reduced">
		<h2>Title: <?php echo $post['title']; ?></h2>
		<p>Made By: <?php echo $post['username']; ?></p>
		<p>Created At: <?php echo $post['created_at']; ?></p>
	</div>
</a>
