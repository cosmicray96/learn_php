<?php
if (!isset($users)) {
	throw new AppException();
}
?>
<div class="users_container">

	<?php
	$list = $users;
	$item_name = 'user';
	$render_file = __view_dir  . '/component/user/reduced.php';
	$base_url = '/user?';
	$page_count = $page_count;
	require __view_dir . '/component/list.php';
	?>
</div>
