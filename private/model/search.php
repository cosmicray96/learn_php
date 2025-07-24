<?php
require_once __root_dir . '/private/model/db.php';
require_once __root_dir . '/private/model/posts.php';

function search_users($search_query): array
{
	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('select * from(select id, username, created_at, levenshtein(lower(username), lower(?)) as dist from users ) as sub where dist <= 3 order by dist asc limit 10');
	$stmt->execute([$search_query]);
	$result = $stmt->fetchAll();
	return $result;
}

function search_posts($search_query): array
{
	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('select * from(select id, title, left(body, 64) as body, user_id, levenshtein(lower(title), lower(?)) as dist from posts ) as sub where dist <= 3 order by dist asc limit 10');
	$stmt->execute([$search_query]);
	$result = $stmt->fetchAll();
	add_username_to_posts($result);
	return $result;
}
