
<?php
require_once realpath(__DIR__ . '/../src/init.php');
require_once realpath(__root_dir . '/private/_common/model/users.php');

function add_username_to_posts(array &$posts)
{
	foreach ($posts as &$post) {
		$post['username'] = username_from_id($post['user_id'])->unwrap();
	}
}
