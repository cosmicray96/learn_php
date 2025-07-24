<?php
if (!isset($posts) || !isset($page_count)) {
	throw new AppException();
}
?>
<?php require_once __root_dir . '/private/view/component/post/full.php'; ?>
<?php require_once __root_dir . '/private/view/function/list.php'; ?>
<div class="posts_container">
	<?php render_list($posts, 'render_post_reduced', $page_count, '/posts?') ?>
</div>
