<?php

if (!isset($comment)) {
	throw new AppException();
}

$scope = function ($comment) {
	require __FILE__;
};

?>
<div class="comment_full">
	<div class="comment_parent_full">
		<p>Username: <?php echo $comment['username']; ?></p>
		<p>Created At: <?php echo $comment['created_at']; ?></p>
		<p>Body: <?php echo $comment['body']; ?></p>
	</div>

	<div class="comment_children_full">
		<?php foreach ($comment['children'] as $child): ?>
			<?php
			$scope($child);
			?>
		<?php endforeach; ?>
	</div>
</div>
