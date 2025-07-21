<?php
require_once __root_dir . '/private/_common/src/exception.php';
require_once __root_dir . '/private/_common/model/db.php';
require_once __root_dir . '/private/_common/model/id_generator.php';

class Scripts
{
	public static function add_bot_users(int $start_number, int $count)
	{
		$pdo = DB::get_pdo();
		for ($i = 0; $i < $count; $i++) {
			$number = $start_number + $i;
			$username = 'bot' . sprintf('%02d', $number);
			$password = 'bot' . sprintf('%02d', $number);
			$password_hash = password_hash($password, PASSWORD_DEFAULT);
			$id = next_id('users', 'id');

			$stmt = $pdo->prepare('
			insert into users 
			(id, username, password_hash) 
			values (?, ?, ?)
		');
			$success = $stmt->execute([$id, $username, $password_hash]);
			if (!$success) {
				throw new AppException();
			}
		}
	}
}
