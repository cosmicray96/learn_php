<?php require_once realpath(__DIR__ . '/../src/init.php');
require_once realpath(__root_dir . '/private/src/db.php');
require_once realpath(__root_dir . '/private/src/result.php');

function login_user($username, $password): array
{
	if (strlen($username) >= 64) {
		return [new Result(ErrCode::ERR, 'username too long')];
	}
	if (strlen($password) >= 255) {
		return [new Result(ErrCode::ERR, 'password too long')];
	}

	try {
		$pdo = get_pdo();
		$stmt = $pdo->prepare('select id, password_hash from users where username = ? limit 1');
		$result = $stmt->execute([$username]);


		$result = $stmt->fetch();
	} catch (PDOException $e) {

		return [new Result(ErrCode::ERR, "problem with DB: {$e->getMessage()}")];
	}

	if (empty($result)) {
		return [new Result(ErrCode::ERR, 'username not found')];
	}

	if (password_verify($password, $result['password_hash'])) {
		return [new Result(ErrCode::OK, $result['id'])];
	} else {
		return [new Result(ErrCode::ERR, 'wrong password')];
	}
}
