<?php
require_once __root_dir . '/private/_common/model/db.php';
require_once __root_dir . '/private/_common/src/exception.php';

function add_username_to_post(array &$post)
{
	$post['username'] = username_from_id($post['user_id']);
}

function add_username_to_posts(array &$posts)
{
	foreach ($posts as &$post) {
		$post['username'] = username_from_id($post['user_id']);
	}
}

function get_post(int $post_id): array
{
	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('select * from posts where id = ? limit 1');
	$stmt->execute([$post_id]);
	$result = $stmt->fetch();
	add_username_to_post($result);

	if ($result === false) {
		throw new DBNotFoundExp();
	}
	return $result;
}
