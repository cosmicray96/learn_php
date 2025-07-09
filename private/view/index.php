<?php if (isset($_SESSION['username'])): ?>
	<p>Logged in as <?php echo $_SESSION['username']; ?></p>
<?php else: ?>
	<p>You are not logged in! <a href="/login.php">login!</a></p>
<?php endif; ?>
