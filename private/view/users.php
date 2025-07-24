<?php require_once __root_dir . '/private/view/user/full.php'; ?>
<?php require_once __root_dir . '/private/view/list_container.php'; ?>

<div class="users_container">
	<?php render_list($users, 'render_user_reduced', 5, '/users?') ?>
</div>
