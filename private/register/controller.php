<?php
require_once realpath(__DIR__ . '/../_common/src/init.php');
require_once realpath(__root_dir . '/private/_common/src/result.php');
require_once realpath(__root_dir . '/private/_common/model/users.php');

class RegisterController
{
	private function handle_post()
	{

		$result = register_user($_POST['username'], $_POST['password']);
		if (!$result['res']->is_success()) {
			$_SESSION['msgs'][] = "failed to register, error: {$result['res']->msg}";
		} else {
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['user_id'] = $result['data'];
			$_SESSION['msgs'][] = 'registered';
		}

		$page_title = 'Register';
		$content_file = realpath(__DIR__ . '/view.php');
		require realpath(__root_dir . '/private/_common/view/layout.php');
	}

	private function handle_get()
	{
		$page_title = 'Register';
		$content_file = realpath(__DIR__ . '/view.php');
		require realpath(__root_dir . '/private/_common/view/layout.php');
	}

	public function handle()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->handle_post();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
