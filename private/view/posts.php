<?php require_once __root_dir . '/private/_common/view/post/full.php'; ?>
<?php require_once __root_dir . '/private/_common/view/list_container.php'; ?>
<div class="posts_container">
	<?php render_list($posts, 'render_post_reduced', $page_count, '/posts?') ?>
</div>
