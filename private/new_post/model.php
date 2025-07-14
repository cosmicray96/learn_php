<?php
require_once realpath(__root_dir . '/private/_common/src/result.php');
require_once realpath(__root_dir . '/private/_common/model/users.php');
require_once realpath(__root_dir . '/private/_common/model/db.php');

function submit_post(int $user_id, string $title, string $body): Result
{

	$result = user_exists($user_id);
	if ($result->is_err()) {
		return $result;
	}

	try {
		$pdo = get_pdo();
		$stmt = $pdo->prepare('insert into posts (title, body, user_id) values (?, ?, ?);');
		$stmt->execute([$title, $body, $user_id]);
		$post_id = $pdo->lastInsertId();
	} catch (PDOException $e) {
		return Result::make_err(ErrCode::Exception, $e);
	}

	return Result::make_ok($post_id);
}
