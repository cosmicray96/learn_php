<?php
require_once __root_dir . '/private/_common/model/db.php';

require_once __root_dir . '/private/_common/src/result.php';


function next_id_impl($column_state, $server_id)
{
	$column_name = $column_state['column_name'];
	$table_name = $column_state['table_name'];
	$type = $column_state['type'];
	$state = json_decode($column_state['state'], true);
	// make next id
}

function next_id(string $table, string $column): Result
{
	$meta_table_name = 'id_table';
	try {
		$pdo = get_pdo();
		$stmt = $pdo->prepare('select state from id_table where table_name = ? and column_name = ? limit 1');
		$stmt->execute([$table, $column]);

		$result = $stmt->fetch();
		if ($result === false) {
			return Result::make_err(ErrCode::Err);
		}

		$state = $result['state'];
		$next_id = next_id_impl($state, 0/*temp*/);
		return Result::make_ok($next_id);
	} catch (PDOException $e) {
		return Result::make_exception($e);
	}
	return Result::make_err(ErrCode::Err);
}
