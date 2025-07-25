<?php
if (!isset($posts)) {
	throw new AppVarNotProvidedExp('posts');
}
if (!isset($page_count)) {
	throw new AppVarNotProvidedExp('page_count');
}
?>
<div class="posts_container">
	<?php
	Renderer::render_file(__view_dir . '/component/list.php', [
		'list' => $posts,
		'item_name' => 'post',
		'render_file' => __view_dir  . '/component/post/reduced.php',
		'base_url' => '/posts?',
		'page_count' => $page_count,
	]);
	?>
</div>
