<?php
if (!isset($posts) || !isset($page_count)) {
	throw new AppException();
}
?>
<div class="posts_container">
	<?php
	$list = $posts;
	$item_name = 'post';
	$render_file = __view_dir  . '/component/post/reduced.php';
	$base_url = '/posts?';
	$page_count = $page_count;
	require __view_dir . '/component/list.php';
	?>
</div>
