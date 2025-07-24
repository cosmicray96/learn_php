<div class="user_full">
	<h2>Username: <?php echo $user['username']; ?></h2>
	<p>Id: <?php echo $user['id']; ?></p>
	<p>Created At: <?php echo $user['created_at']; ?></p>
	<p>Description: <?php echo $user['description']; ?></p>
</div>

<?php function render_user_full($user): void
{ ?>
	<div class="user_full">
		<h2>Username: <?php echo $user['username']; ?></h2>
		<p>Id: <?php echo $user['id']; ?></p>
		<p>Created At: <?php echo $user['created_at']; ?></p>
		<p>Description: <?php echo $user['description']; ?></p>
	</div>
<?php } ?>

<?php function render_user_reduced($user): void
{ ?>
	<a class="no_style" href="/users?id=<?php echo $user['id']; ?>">
		<div class="user_reduced">
			<h2>Name: <?php echo $user['username']; ?></h2>
			<p>Id: <?php echo $user['id']; ?></p>
		</div>
	</a>
<?php } ?>
