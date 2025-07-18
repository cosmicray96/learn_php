<form id="form" method="GET" action="/search">
	<label>Search: <input type="text" name="query"></label>
	<label>Type: <input type="radio" name="type" value="user">User</label>
	<label>Type: <input type="radio" name="type" value="post">Post</label>

	<button type="submit">Submit!</button>
</form>


<?php if (isset($posts)): ?>
	<?php require __root_dir . '/private/_common/view/posts_container.php'; ?>
<?php elseif (isset($users)): ?>
	<?php require __root_dir . '/private/_common/view/users_container.php'; ?>
<?php endif; ?>
