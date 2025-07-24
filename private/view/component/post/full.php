<?php
if (!isset($post)) {
	throw new AppException();
}
?>
<div class="post_full">
	<h2>Title: <?php echo $post['title']; ?></h2>
	<p>Made By: <?php echo $post['username']; ?></p>
	<p>Created At: <?php echo $post['created_at']; ?></p>
	<p>Body: <?php echo $post['body']; ?></p>
</div>
