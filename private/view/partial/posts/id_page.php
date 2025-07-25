<?php
if (!isset($post)) {
	throw new AppVarNotProvidedExp('post');
}
if (!isset($comments)) {
	throw new AppVarNotProvidedExp('comments');
}
require_once __root_dir . '/private/src/render.php';
?>
<?php require __view_dir . '/component/post/full.php'; ?>
<div class="comments_container">
	<?php foreach ($comments as $comment): ?>

		<?php
		Renderer::render_file(__view_dir . '/component/comment/full.php', [
			'comment' => $comment,
		]);
		?>
	<?php endforeach; ?>
</div>
