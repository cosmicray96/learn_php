<?php
require_once realpath(__DIR__ . '/../_common/src/init.php');

require_once realpath(__root_dir . '/private/_common/src/result.php');

require_once realpath(__root_dir . '/private/_common/model/db.php');
require_once realpath(__root_dir . '/private/_common/model/users.php');

function add_username_to_posts(array &$posts)
{
	foreach ($posts as &$post) {
		$post['username'] = username_from_id($post['user_id'])->unwrap();
	}
}

// returns assoc array of posts
function latest_posts(int $count): Result
{
	try {
		$pdo = get_pdo();
		$stmt = $pdo->prepare('select id, title, left(body, 64) as body, user_id, created_at from posts order by created_at desc limit ?');
		$stmt->bindValue(1, $count, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll();
		add_username_to_posts($result);
		return Result::make_ok($result);
	} catch (PDOException $e) {
		return Result::make_err(ErrCode::Err, $e);
	}
}
