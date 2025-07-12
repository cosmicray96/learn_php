<?php
require_once realpath(__DIR__ . '/../_common/src/init.php');
require_once realpath(__root_dir . '/private/_common/src/result.php');
require_once realpath(__root_dir . '/private/_common/model/users.php');

require_once realpath(__DIR__ . '/model.php');

class UsersController
{
	private function handle_get()
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
		} else {
			$result = latest_users(5);
			if ($result->is_ok()) {
				$users = $result->value;
			}
		}

		$page_title = 'Users';
		$content_file = realpath(__DIR__ . '/view.php');
		require realpath(__root_dir . '/private/_common/view/layout.php');
	}
	public function handle()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			throw new RuntimeException("no post on users");
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
