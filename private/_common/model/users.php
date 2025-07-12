<?php require_once realpath(__DIR__ . '/../src/init.php');
require_once realpath(__root_dir . '/private/_common/model/db.php');
require_once realpath(__root_dir . '/private/_common/src/result.php');

function user_id_from_name(string $username): array
{
	try {
		$pdo = get_pdo();
		$stmt = $pdo->prepare('select 1 from users where username = ? limit 1');
		$stmt->execute([$username]);
		$result = $stmt->fetch();
	} catch (PDOException $e) {
		return ['res' => new Result(ErrCode::ERR, "problem with DB: {$e->getMessage()}")];
	}
	if (!empty($result)) {
		return ['res' => new Result(ErrCode::OK), 'data' => $result['id']];
	} else {
		return ['res' => new Result(ErrCode::ERR, 'user already exists')];
	}
}

function verify_username(string $username): bool
{
	return (strlen($username) < 64);
}
function verify_password(string $password): bool
{
	return (strlen($password) < 255);
}

function login_user(string $username, string $password): array
{
	if (!verify_password($password)) {
		return ['res' => new Result(ErrCode::ERR, 'invalid password')];
	}
	if (!verify_username($username)) {
		return ['res' => new Result(ErrCode::ERR, 'invalid username')];
	}

	try {
		$pdo = get_pdo();
		$stmt = $pdo->prepare('select id, password_hash from users where username = ? limit 1');
		$stmt->execute([$username]);
		$result = $stmt->fetch();
	} catch (PDOException $e) {

		return ['res' => new Result(ErrCode::ERR, "problem with DB: {$e->getMessage()}")];
	}

	if (empty($result)) {
		return ['res' => new Result(ErrCode::ERR, 'username not found')];
	}

	if (password_verify($password, $result['password_hash'])) {
		return ['res' => new Result(ErrCode::OK), 'data' => $result['id']];
	} else {
		return ['res' => new Result(ErrCode::ERR, 'wrong password')];
	}
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
