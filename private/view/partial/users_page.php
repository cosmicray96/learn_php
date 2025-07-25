<?php
if (!isset($users)) {
	throw new AppVarNotProvidedExp('users');
}
if (!isset($page_count)) {
	throw new AppVarNotProvidedExp('page_count');
}
?>
<div class="users_container">

	<?php
	Renderer::render_file(__view_dir . '/component/list.php', [
		'list' => $users,
		'item_name' => 'user',
		'render_file' => __view_dir  . '/component/user/reduced.php',
		'base_url' => '/users?',
		'page_count' => $page_count,
	]);
	?>
</div>
