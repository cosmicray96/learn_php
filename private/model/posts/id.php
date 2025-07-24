<?php
require_once __root_dir . '/private/_common/src/exception.php';
require_once __root_dir . '/private/_common/model/db.php';
require_once __root_dir . '/private/_common/model/posts.php';

function get_comments($post_id): array
{
	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('
		select 
		comments.id as id,
		comments.post_id as post_id,
		comments.user_id as user_id,
		comments.body as body,
		comments.parent_id as parent_id,
		comments.created_at as created_at,
		users.username as username
		from comments inner join users 
		on users.id = comments.user_id
		where comments.post_id = ?
	');
	$stmt->execute([$post_id]);
	$result = $stmt->fetchAll();

	$refs = [];
	$tree = [];
	foreach ($result as &$comment) {
		$refs[$comment['id']] = &$comment;
		$comment['children'] = [];
	}
	foreach ($result as &$comment) {
		if ($comment['parent_id'] === null) {
			$tree[] = &$comment;
		} else {
			$refs[$comment['parent_id']]['children'][] = &$comment;
		}
	}
	/*
	error_log('Result: ' . json_encode($result));
	error_log('Tree: ' . json_encode($tree));
	*/
	return $tree;
}
