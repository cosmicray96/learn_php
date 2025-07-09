<form id="form" method="GET" action="/search.php">
	<label>Search: <input type="text" name="query"></label>
	<label>Type: <input type="radio" name="type" value="user">User</label>
	<label>Type: <input type="radio" name="type" value="post">Post</label>

	<button type="submit">Submit!</button>
</form>

<?php if (isset($search_results_posts)): ?>
	<div id="posts_container">
		<?php foreach ($search_results_posts as $result): ?>
			<div class="post">
				<p>Title: <?php echo $result['title']; ?></p>
				<p>User_id: <?php echo $result['user_id']; ?></p>
				<p>Body: <?php echo $result['body']; ?></p>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
