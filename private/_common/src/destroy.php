<?php
require_once __root_dir . '/private/_common/model/db.php';

function destroy_on_success()
{
	$pdo = get_pdo();
	$pdo->commit();
}

function destroy_on_failure()
{
	$pdo = get_pdo();
	$pdo->rollBack();
}
