<?php if (isset($username)) : ?>
	<p>username: <?php echo $username; ?></p>
<?php else: ?>
	<p>you are not logged it! <a href="/login.php">Login</a></p>
<?php endif; ?>
