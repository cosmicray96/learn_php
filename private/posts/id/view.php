<?php

function render_comments(array &$comments): void
{
	foreach ($comments as $comment) {
		echo '<div class="comment_container">';
		echo '<p>' .
			'Username: ' . $comment['username'] .
			' :: ' . 'Id: ' . $comment['user_id'] .
			' :: ' . 'Comment Id: ' . $comment['id'] .
			'</p>';
		echo '<p>Created At: ' . $comment['created_at'] . '</p>';
		echo '<p>body: ' . $comment['body'] . '</p>';
		if (!empty($comment['children'])) {
			render_comments($comment['children']);
		}
		echo '</div>';
	}
}

?>

<?php require __root_dir . '/private/_common/view/post/full.php'; ?>

<!-- comments -->
<div class="comments_container">
	<?php if (isset($comments)): ?>
		<?php render_comments($comments); ?>
	<?php endif; ?>
</div>
