<?php
require_once __root_dir . '/private/_common/src/exception.php';
require_once __root_dir . '/private/_common/model/db.php';
require_once __root_dir . '/private/_common/model/posts.php';



function latest_posts_with_username(int $count): array
{
	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('
		select 
		posts.id as id, 
		posts.title as title, 
		left(posts.body, 64) as body, 
		posts.user_id as user_id, 
		posts.created_at as created_at, 
		users.username as username
		from users inner join posts on users.id = posts.user_id order by posts.created_at desc limit ?');
	$stmt->bindValue(1, $count, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}

// returns assoc array of posts
function latest_posts(int $count): array
{
	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('select id, title, left(body, 64) as body, user_id, created_at from posts order by created_at desc limit ?');
	$stmt->bindValue(1, $count, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	add_username_to_posts($result);
	return $result;
}
