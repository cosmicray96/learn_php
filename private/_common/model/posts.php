<?php
require_once realpath(__root_dir . '/private/_common/model/db.php');
require_once realpath(__root_dir . '/private/_common/src/result.php');

function get_post(int $post_id): array
{
	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('select * from posts where id = ? limit 1');
	$stmt->execute([$post_id]);
	$result = $stmt->fetch();

	if ($result === false) {
		throw new DBNotFoundExp();
	}
	return $result;
}
