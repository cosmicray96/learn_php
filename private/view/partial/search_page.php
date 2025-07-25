<form id="form" method="GET" action="/search">
	<label>Search: <input type="text" name="query"></label>
	<label>Type: <input type="radio" name="type" value="user">User</label>
	<label>Type: <input type="radio" name="type" value="post">Post</label>

	<button type="submit">Submit!</button>
</form>

<?php
if (isset($posts)) {
	foreach ($posts as $post) {
		Renderer::render_file(__view_dir . '/component/post/reduced.php', ['post' => $post]);
	}
} elseif (isset($users)) {
	foreach ($users as $user) {
		Renderer::render_file(__view_dir . '/component/user/reduced.php', ['user' => $user]);
	}
}
?>
