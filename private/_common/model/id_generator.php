<?php
require_once __root_dir . '/private/_common/model/db.php';

require_once __root_dir . '/private/_common/src/result.php';
require_once __root_dir . '/private/_common/src/id_generator.php';


function next_id(string $table, string $column): Result
{
	$server_id = 123;
	try {
		$pdo = get_pdo();
		$stmt = $pdo->prepare('select state, type from id_table where table_name = ? and column_name = ? limit 1 for update');
		$stmt->execute([$table, $column]);

		$result = $stmt->fetch();
		if ($result === false) {
			return Result::make_err(ErrCode::Err);
		}
		$state = $result['state'];
		$type = $result['type'];
		$result = NextIdGenerator::generate($state, $type, $server_id);

		if ($result->is_err()) {
			return $result;
		}
		$new_id = $result->value()['new_id'];
		$new_state = $result->value()['new_state'];

		$stmt = $pdo->prepare('update id_table set state = ? where table_name = ? and column_name = ?');
		$result = $stmt->execute([$new_state, $table, $column]);

		if ($result === false) {
			return Result::make_err(ErrCode::Err);
		}
		return Result::make_ok($new_id);
	} catch (PDOException $e) {
		return Result::make_exception($e);
	}
}
