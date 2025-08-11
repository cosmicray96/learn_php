<?php
require_once __root_dir . '/private/src/exception.php';

class DBExp extends AppException {}

class DBCannotConnectExp extends DBExp {}
class DBNotFoundExp extends DBExp {}
class DBInvalidQueryExp extends DBExp {}
class DBFailedQueryExp extends DBExp {}
class DBTransactionFailedExp extends DBExp {}
class DBPermissionDeniedExp extends DBExp {}


class DB
{
	private static bool $s_is_transaction = false;
	private static ?PDO $s_pdo = null;

	public static function get_pdo(): PDO
	{
		if (self::$s_pdo !== null) {
			return self::$s_pdo;
		}

		$db_address = $_ENV['mysql_address'];
		$db_username = $_ENV['mysql_username'];
		$db_password = $_ENV['mysql_password'];
		$db_name = $_ENV['mysql_db_name'];
		$charset = 'utf8mb4';

		$dsn = "mysql:host=$db_address;dbname=$db_name;charset=$charset";

		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		];

		try {
			self::$s_pdo = new PDO($dsn, $db_username, $db_password, $options);
		} catch (PDOException $e) {
			throw new DBCannotConnectExp();
		}
		try {
			self::$s_pdo->beginTransaction();
			self::$s_is_transaction = true;
		} catch (PDOException $e) {
			throw new DBTransactionFailedExp();
		}
		return self::$s_pdo;
	}

	public static function destroy_on_success()
	{
		if (self::$s_is_transaction) {
			self::$s_pdo->commit();
		}
	}

	public static function destroy_on_failure()
	{
		if (self::$s_is_transaction) {
			self::$s_pdo->rollBack();
		}
	}
}
