<?php
if (!isset($_SESSION['username'])) {
	throw new AppException();
}
?>
<p>Logged in as <?php echo $_SESSION['username']; ?></p>
