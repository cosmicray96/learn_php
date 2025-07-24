<?php
if (!isset($user)) {
	throw new AppException();
}
?>
<a class="no_style" href="/users?id=<?php echo $user['id']; ?>">
	<div class="user_reduced">
		<h2>Name: <?php echo $user['username']; ?></h2>
		<p>Id: <?php echo $user['id']; ?></p>
	</div>
</a>
