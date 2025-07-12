<?php if (isset($username)) : ?>
	<p>Username: <?php echo $username; ?></p>
	<p>Description: <?php echo $description; ?></p>
<?php elseif (isset($users)): ?>
	<div id="users_container">

		<?php foreach ($users as $user): ?>
			<div class="user">
				<p>Username: <?php echo $user['username']; ?></p>
				<p>Id: <?php echo $user['id']; ?></p>
				<p>Joined At: <?php echo $user['created_at']; ?></p>
			</div>
		<?php endforeach; ?>

	</div>
<?php endif; ?>
