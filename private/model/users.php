<?php
require_once __root_dir . '/private/src/exception.php';
require_once __root_dir . '/private/model/db.php';
require_once __root_dir . '/private/model/id_generator.php';

class AuthExp extends AppException {}
class AuthInvalidUsernameExp extends AuthExp {}
class AuthInvalidPasswordExp extends AuthExp {}
class AuthWrongPasswordExp extends AuthExp {}
class AuthNameTakenExp extends AuthExp {}


function get_user(int $user_id): array
{
	if (!user_exists($user_id)) {
		throw new DBNotFoundExp();
	}
	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('select * from users where id = ? limit 1');
	$stmt->execute([$user_id]);
	$result = $stmt->fetch();
	if ($result === false) {
		throw new DBNotFoundExp();
	}
	return $result;
}

function user_exists(int $user_id): bool
{
	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('select 1 from users where id = ? limit 1');
	$stmt->execute([$user_id]);
	$result = $stmt->fetch();

	if ($result === false) {
		return false;
	}
	return true;
}

// returns int
function user_id_from_name(string $username): mixed
{
	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('select id from users where username = ? limit 1');
	$stmt->execute([$username]);
	$result = $stmt->fetch();
	if ($result === false) {
		return null;
	}
	return $result['id'];
}

function username_from_id(int $user_id): ?string
{
	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('select username from users where id = ? limit 1');
	$stmt->execute([$user_id]);
	$result = $stmt->fetch();

	if ($result === false) {
		return null;
	}
	return $result['username'];
}

function verify_username(string $username): bool
{
	return (strlen($username) < 64);
}
function verify_password(string $password): bool
{
	return (strlen($password) < 255);
}

// returns int
function login_user(string $username, string $password): mixed
{
	if (!verify_password($password)) {
		throw new AuthInvalidPasswordExp();
	}
	if (!verify_username($username)) {
		throw new AuthInvalidUsernameExp();
	}

	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('select id, password_hash from users where username = ? limit 1');
	$stmt->execute([$username]);
	$result = $stmt->fetch();

	if ($result === false) {
		throw new DBNotFoundExp();
	}

	if (!password_verify($password, $result['password_hash'])) {
		throw new AuthWrongPasswordExp();
	}
	return $result['id'];
}

// returns int
function register_user(string $username, string $password): mixed
{
	if (!verify_password($password)) {
		throw new AuthInvalidPasswordExp();
	}
	if (!verify_username($username)) {
		throw new AuthInvalidUsernameExp();
	}

	if (user_id_from_name($username) !== null) {
		throw new AuthNameTakenExp();
	}

	$next_id = next_id('users', 'id');
	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('insert into users (username, password_hash, id) values (?, ?, ?)');
	$password_hash = password_hash($password, PASSWORD_DEFAULT);
	$stmt->execute([$username, $password_hash, $next_id]);

	$user_id = user_id_from_name($username);
	if ($user_id === null) {
		throw new DBExp();
	}

	return $user_id;
}

function latest_users(int $count): array
{
	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('select * from users order by created_at desc limit ?');
	$stmt->bindValue(1, $count, PDO::PARAM_INT);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return $result;
}
