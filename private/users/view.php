<?php if (isset($username)) : ?>
	<p>Username: <?php echo $username; ?></p>
	<p>Description: <?php echo $description; ?></p>
<?php else: ?>
	<p>No user_id provided</p>
<?php endif; ?>
