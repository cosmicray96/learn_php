<?php

require_once __root_dir . '/private/_common/src/exception.php';
require_once __root_dir . '/private/_common/model/db.php';

require_once __root_dir . '/private/_common/src/id_generator.php';


function next_id(string $table, string $column): mixed
{
	$server_id = 123;
	$pdo = DB::get_pdo();
	$stmt = $pdo->prepare('select state, type from id_table where server_id = ? and table_name = ? and column_name = ? limit 1 for update');
	$stmt->execute([$server_id, $table, $column]);

	$result = $stmt->fetch();
	if ($result === false) {
		throw new DBNotFoundExp("Requested metadata for server_id: $server_id, table: $table, and column: $column is not found.");
	}

	$state = $result['state'];
	$type = $result['type'];
	[$new_id, $new_state] = NextIdGenerator::generate($state, $type, $server_id);

	$stmt = $pdo->prepare('update id_table set state = ? where table_name = ? and column_name = ?');
	$result = $stmt->execute([$new_state, $table, $column]);

	if ($result === false) {
		throw new DBExp('Failed to update id_table with new state.');
	}
	return $new_id;
}
