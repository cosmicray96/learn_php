<?php require __view_dir . '/component/posts/full.php'; ?>
<?php require_once __view_dir . '/function/comment.php'; ?>
<div class="comments_container">
	<?php foreach ($comments as $comment): ?>
		<?php render_comment($comment); ?>
	<?php endforeach; ?>
</div>
