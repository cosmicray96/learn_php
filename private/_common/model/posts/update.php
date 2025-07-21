<?php
require_once __root_dir . '/private/_common/model/db.php';
/*
function update_posts_page_index(): void
{
	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('
		select created_at from posts_page_index
		where page = (
			select max(page) from posts_page_index
		) limit 1
	');
	$stmt->execute();
	$last_created_at = $stmt->fetchColumn();


	while (true) {
		$stmt = $pdo->prepare('select 
		created_at
		from posts
		where created_at > ?
		order by created_at asc
		limit 20
	');
		$stmt->execute([$last_created_at]);
		$result = $stmt->fetch();

		if (count($result) < 20) {
			break;
		}

		$max_created_at = $result[19]['created_at'];

		$stmt = $pdo->prepare('insert into posts_page_index (created_at) values (?)');
		$stmt->execute([$max_created_at]);

		$last_created_at = $max_created_at;
	}
}
*/
