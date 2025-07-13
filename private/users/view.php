<?php require_once realpath(__DIR__ . '/../_common/src/init.php'); ?>

<?php if (isset($user)) : ?>
	<p>Username: <?php echo $user['username']; ?></p>
	<p>Id: <?php echo $user['id']; ?></p>
	<p>Created At: <?php echo $user['created_at']; ?></p>
	<p>Description: <?php echo $user['description']; ?></p>
<?php elseif (isset($users)): ?>
	<?php require realpath(__root_dir . '/private/_common/view/users_container.php'); ?>
<?php endif; ?>
