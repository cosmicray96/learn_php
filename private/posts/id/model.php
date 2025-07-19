<?php
require_once __root_dir . '/private/_common/src/exception.php';
require_once __root_dir . '/private/_common/model/db.php';
require_once __root_dir . '/private/_common/model/posts.php';


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
