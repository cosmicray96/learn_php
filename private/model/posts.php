<?php
require_once __root_dir . '/private/model/db.php';
require_once __root_dir . '/private/src/exception.php';

function add_username_to_post(array &$post)
{
	$post['username'] = username_from_id($post['user_id']);
}

function add_username_to_posts(array &$posts)
{
	foreach ($posts as &$post) {
		$post['username'] = username_from_id($post['user_id']);
	}
}

function get_post(int $post_id): array
{
	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('select * from posts where id = ? limit 1');
	$stmt->execute([$post_id]);
	$result = $stmt->fetch();
	add_username_to_post($result);

	if ($result === false) {
		throw new DBNotFoundExp();
	}
	return $result;
}

function paginated_post(int $page, int $count)
{
	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('
		select 
		posts.id as id, 
		posts.title as title, 
		left(posts.body, 64) as body, 
		posts.user_id as user_id, 
		posts.created_at as created_at, 
		users.username as username
		from users inner join posts on users.id = posts.user_id order by posts.created_at desc 
		limit ?
		offset ?	
		');
	$offset = $page * $count;
	$stmt->bindValue(1, $count, PDO::PARAM_INT);
	$stmt->bindValue(2, $offset, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}

function get_page_count($item_per_page): int
{

	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('
		select count(*) from posts');
	$stmt->execute();
	$posts_count = $stmt->fetchColumn();
	return ceil($posts_count / $item_per_page);
}

function latest_posts_with_username(int $count): array
{
	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('
		select 
		posts.id as id, 
		posts.title as title, 
		left(posts.body, 64) as body, 
		posts.user_id as user_id, 
		posts.created_at as created_at, 
		users.username as username
		from users inner join posts on users.id = posts.user_id order by posts.created_at desc limit ?');
	$stmt->bindValue(1, $count, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}

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
