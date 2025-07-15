<?php
require_once realpath(__root_dir . '/private/_common/model/db.php');
require_once realpath(__root_dir . '/private/_common/src/result.php');

function get_user(int $user_id): Result
{
	$result = user_exists($user_id);
	if ($result->is_err()) {
		return $result;
	}
	try {
		$pdo = get_pdo();
		$stmt = $pdo->prepare('select * from users where id = ? limit 1');
		$stmt->execute([$user_id]);
		return Result::make_ok($stmt->fetch());
	} catch (PDOException $e) {
		return Result::make_exception($e);
	}
}

function user_exists(int $user_id): Result
{
	try {
		$pdo = get_pdo();
		$stmt = $pdo->prepare('select 1 from users where id = ? limit 1');
		$stmt->execute([$user_id]);
		$result = $stmt->fetch();
	} catch (PDOException $e) {
		return Result::make_exception($e);
	}
	if ($result === false) {
		return Result::make_err(ErrCode::DB_NotFound);
	}
	return Result::make_ok(true);
}

// returns int
function user_id_from_name(string $username): Result
{
	try {
		$pdo = get_pdo();
		$stmt = $pdo->prepare('select id from users where username = ? limit 1');
		$stmt->execute([$username]);
		$result = $stmt->fetch();
	} catch (PDOException $e) {
		return Result::make_exception($e);
	}
	if ($result === false) {
		return Result::make_err(ErrCode::DB_NotFound);
	}
	return Result::make_ok($result['id']);
}

//returns string
function username_from_id(int $user_id): Result
{
	try {
		$pdo = get_pdo();
		$stmt = $pdo->prepare('select username from users where id = ? limit 1');
		$stmt->execute([$user_id]);
		$result = $stmt->fetch();
	} catch (PDOException $e) {
		return Result::make_exception($e);
	}
	if ($result === false) {
		return Result::make_err(ErrCode::DB_NotFound);
	}
	return Result::make_ok($result['username']);
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
function login_user(string $username, string $password): Result
{
	if (!verify_password($password)) {
		return Result::make_err(ErrCode::Auth_InvalidPassword);
	}
	if (!verify_username($username)) {
		return Result::make_err(ErrCode::Auth_InvalidUsername);
	}

	try {
		$pdo = get_pdo();
		$stmt = $pdo->prepare('select id, password_hash from users where username = ? limit 1');
		$stmt->execute([$username]);
		$result = $stmt->fetch();
	} catch (PDOException $e) {
		return Result::make_exception($e);
	}

	if ($result === false) {
		return Result::make_err(ErrCode::DB_NotFound);
	}

	if (!password_verify($password, $result['password_hash'])) {
		return Result::make_err(ErrCode::Auth_WrongPassword);
	}
	return Result::make_ok($result['id']);
}

// returns int
function register_user(string $username, string $password): Result
{
	if (!verify_password($password)) {
		return Result::make_err(ErrCode::Auth_InvalidPassword);
	}
	if (!verify_username($username)) {
		return Result::make_err(ErrCode::Auth_InvalidUsername);
	}

	$result = user_id_from_name($username);
	if ($result->is_ok()) {
		return Result::make_err(ErrCode::Auth_NameTaken);
	}
	if ($result->error() !== ErrCode::DB_NotFound) {
		return $result;
	}

	try {
		$pdo = get_pdo();
		$stmt = $pdo->prepare('insert into users (username, password_hash, id) values (?, ?, ?)');
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		$stmt->execute([$username, $password_hash]);
	} catch (PDOException $e) {
		return Result::make_exception($e);
	}

	$result = user_id_from_name($username);
	if ($result->is_err()) {
		return Result::make_err(ErrCode::Err);
	}
	return Result::make_ok($result->value());
}
