	<div id="users_container">
		<?php foreach ($users as $user): ?>
			<div class="user">
				<p>Name: <?php echo $user['username']; ?></p>
				<p>Id: <?php echo $user['id']; ?></p>
				<p>Created At: <?php echo $user['created_at']; ?></p>
			</div>
		<?php endforeach; ?>
	</div>
