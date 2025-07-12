<?php
require_once realpath(__DIR__ . '/../_common/src/init.php');
require_once realpath(__root_dir . '/private/_common/src/result.php');
require_once realpath(__root_dir . '/private/_common/model/users.php');

class UsersController
{
	public function handle()
	{

		if (isset($_GET['user_id'])) {
			$result = get_user($_GET['user_id']);
			if ($result->is_ok()) {
				$username = ($result->value)['username'];
				$description = ($result->value)['description'];
			} else {
				$err = ErrCode_to_string($result->err);
				$_SESSION['msgs'][] = "Error: $err";
			}
		}

		$page_title = 'Users';
		$content_file = realpath(__DIR__ . '/view.php');
		require realpath(__root_dir . '/private/_common/view/layout.php');
	}
}
