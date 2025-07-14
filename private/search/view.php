<form id="form" method="GET" action="/search">
	<label>Search: <input type="text" name="query"></label>
	<label>Type: <input type="radio" name="type" value="user">User</label>
	<label>Type: <input type="radio" name="type" value="post">Post</label>

	<button type="submit">Submit!</button>
</form>


<?php if (isset($search_results_posts)): ?>
	<?php $posts = $search_results_posts; ?>
	<?php require realpath(__root_dir . '/private/_common/view/posts_container.php'); ?>
<?php elseif (isset($search_results_users)): ?>
	<?php $users = $search_results_users; ?>
	<?php require realpath(__root_dir . '/private/_common/view/posts_container.php'); ?>
<?php endif; ?>
