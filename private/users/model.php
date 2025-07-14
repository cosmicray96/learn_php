<?php
require_once realpath(__root_dir . '/private/_common/src/result.php');

require_once realpath(__root_dir . '/private/_common/model/db.php');
require_once realpath(__root_dir . '/private/_common/model/users.php');


// returns assoc array of users
function latest_users(int $count): Result
{
	try {
		$pdo = get_pdo();
		$stmt = $pdo->prepare('select * from users order by created_at desc limit ?');
		$stmt->bindValue(1, $count, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return Result::make_ok($result);
	} catch (PDOException $e) {
		return Result::make_err(ErrCode::Exception, $e);
	}
}
