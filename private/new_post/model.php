<?php
require_once __root_dir . '/private/_common/src/exception.php';
require_once __root_dir . '/private/_common/model/users.php';
require_once __root_dir . '/private/_common/model/db.php';
require_once __root_dir . '/private/_common/model/id_generator.php';

function submit_post(int $user_id, string $title, string $body): mixed
{
	if (!user_exists($user_id)) {
		throw new DBNotFoundExp("Requested user(id:$user_id) not found.");
	}

	$pdo = DB::get_pdo();
	$new_id = next_id('posts', 'id');
	$stmt = $pdo->prepare('insert into posts (id, title, body, user_id) values (?, ?, ?, ?);');
	$stmt->execute([$new_id, $title, $body, $user_id]);

	return $new_id;
}
