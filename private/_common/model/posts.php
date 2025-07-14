<?php
require_once realpath(__root_dir . '/private/_common/model/db.php');
require_once realpath(__root_dir . '/private/_common/src/result.php');

function get_post(int $post_id): Result
{
	try {
		$pdo = get_pdo();
		$stmt = $pdo->prepare('select * from posts where id = ? limit 1');
		$stmt->execute([$post_id]);
		$result = $stmt->fetch();

		if ($result === false) {
			return Result::make_err(ErrCode::DB_NotFound);
		}
	} catch (PDOException $e) {
		return Result::make_exception($e);
	}
	return Result::make_ok($result);
}
