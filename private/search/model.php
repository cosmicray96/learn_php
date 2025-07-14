<?php
require_once realpath(__root_dir . '/private/_common/src/result.php');
require_once realpath(__root_dir . '/private/_common/model/db.php');
require_once realpath(__root_dir . '/private/_common/model/search.php');

function search_users($search_query): Result
{
	try {
		$pdo = get_pdo();
		$stmt = $pdo->prepare('select * from(select id, username, created_at, levenshtein(lower(username), lower(?)) as dist from users ) as sub where dist <= 3 order by dist asc limit 10');
		$stmt->execute([$search_query]);
		$result = $stmt->fetchAll();
		return Result::make_ok($result);
	} catch (PDOException $e) {
		return Result::make_err(ErrCode::Exception, $e);
	}
}

function search_posts($search_query): Result
{
	try {
		$pdo = get_pdo();
		$stmt = $pdo->prepare('select * from(select title, body, user_id, levenshtein(lower(title), lower(?)) as dist from posts ) as sub where dist <= 3 order by dist asc limit 10');
		$stmt->execute([$search_query]);
		$result = $stmt->fetchAll();
		add_username_to_posts($result);
		return Result::make_ok($result);
	} catch (PDOException $e) {
		return Result::make_err(ErrCode::Exception, $e);
	}
}
