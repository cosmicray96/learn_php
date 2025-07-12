<?php
require_once realpath(__DIR__ . '/../src/init.php');
require_once realpath(__root_dir . '/private/_common/model/db.php');
require_once realpath(__root_dir . '/private/_common/src/result.php');

// Result = [value => user_id, err => string]
function user_id_from_name(string $username): Result
{
	try {
		$pdo = get_pdo();
		$stmt = $pdo->prepare('select id from users where username = ? limit 1');
		$stmt->execute([$username]);
		$result = $stmt->fetch();
	} catch (PDOException $e) {
		return Result::make_err(ErrCode::Err, $e);
	}
	if ($result === false) {
		return Result::make_err(ErrCode::DB_NotFound);
	}
	return Result::make_ok($result['id']);
}

function verify_username(string $username): bool
{
	return (strlen($username) < 64);
}
function verify_password(string $password): bool
{
	return (strlen($password) < 255);
}

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
		return Result::make_err(ErrCode::Err, $e);
	}

	if ($result === false) {
		return Result::make_err(ErrCode::DB_NotFound);
	}

	if (!password_verify($password, $result['password_hash'])) {
		return Result::make_err(ErrCode::Auth_WrongPassword);
	}
	return Result::make_ok($result['id']);
}


function register_user(string $username, string $password): array
{
	if (!verify_password($password)) {
		return ['res' => new Result(ErrCode::ERR, 'invalid password')];
	}
	if (!verify_username($username)) {
		return ['res' => new Result(ErrCode::ERR, 'invalid username')];
	}

	$result = user_id_from_name($username);
	if (!$result['res']->is_success()) {
		if ($result['res']->code == ErrCode::DB_ERR) {
			return $result;
		}
	} else {
		return ['res' => new Result(ErrCode::ERR, 'username taken')];
	}

	try {
		$pdo = get_pdo();
		$stmt = $pdo->prepare('insert into users (username, password_hash) values (?, ?)');
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		$stmt->execute([$username, $password_hash]);
	} catch (PDOException $e) {
		return ['res' => new Result(ErrCode::ERR, "problem with DB: {$e->getMessage()}")];
	}

	$result = user_id_from_name($username);
	if ($result['res']->is_success()) {
		return $result;
	}
	return ['res' => new Result(ErrCode::ERR, 'problem with DB.')];
}
