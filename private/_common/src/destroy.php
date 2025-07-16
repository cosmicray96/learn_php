<?php
require_once __root_dir . '/private/_common/model/db.php';

function destroy_on_success()
{
	DB::destroy_on_success();
}

function destroy_on_failure()
{
	DB::destroy_on_failure();
}
