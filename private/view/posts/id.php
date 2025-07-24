<?php require __root_dir . '/private/_common/view/post/full.php'; ?>
<?php require_once __root_dir . '/private/_common/view/comment/full.php'; ?>
<div class="comments_container">
	<?php foreach ($comments as $comment): ?>
		<?php render_comment($comment); ?>
	<?php endforeach; ?>
</div>
