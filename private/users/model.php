<?php
require_once __root_dir . '/private/_common/src/exception.php';

require_once __root_dir . '/private/_common/model/db.php';
require_once __root_dir . '/private/_common/model/users.php';


// returns assoc array of users
function latest_users(int $count): array
{
	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('select * from users order by created_at desc limit ?');
	$stmt->bindValue(1, $count, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}
