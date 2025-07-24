<?php
if (!isset($users)) {
	throw new AppException();
}

?>
<?php require_once __root_dir . '/private/view/component/user/full.php'; ?>
<?php require_once __root_dir . '/private/view/function/list.php'; ?>

<div class="users_container">
	<?php render_list($users, 'render_user_reduced', 5, '/users?') ?>
</div>
