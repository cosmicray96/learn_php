<?php if (!isset($_SESSION['username'])): ?>
	<p>you need to <a href="/login.php">login</a> to post!</p>
<?php else: ?>
	<p>Make a new post as <?php echo $_SESSION['username']; ?></p>

	<form id="form" method="POST" action="/handlers/new_post.php">
		<label>Title: <input type="text" name="title" required></label>
		<label>Body: <textarea name="body" required></textarea></label>
		<button type="submit">Submit New Post!</button>
	</form>

<?php endif; ?>
