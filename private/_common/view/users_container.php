	<div id="users_container">
		<?php foreach ($users as $user): ?>
			<a class="no_style" href="/users?id=<?php echo $user['id']; ?>">
				<div class="user_container">
					<p>Name: <?php echo $user['username']; ?></p>
					<p>Id: <?php echo $user['id']; ?></p>
					<p>Created At: <?php echo $user['created_at']; ?></p>
				</div>
			</a>
		<?php endforeach; ?>
	</div>
