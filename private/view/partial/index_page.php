<?php
if (!isset($_SESSION['username'])) {
	throw new AppVarNotProvidedExp('_SESSION[\'username\']');
}
?>
<p>Logged in as <?php echo $_SESSION['username']; ?></p>
