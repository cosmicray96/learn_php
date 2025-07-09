<?php
require_once realpath(__DIR__ . '/../src/init.php');
require_once realpath(__root_dir . '/private/model/search.php');
require_once realpath(__root_dir . '/private/model/user.php');

class LoginController
{
	private function handle_get()
	{
		$page_title = 'Login';
		$content_file = realpath(__root_dir . '/private/view/login.php');
		require realpath(__root_dir . '/private/layout/layout.php');
	}

	private function handle_post()
	{
		$result = login_user($_POST['username'], $_POST['password']);
		if (!$result['res']->is_success()) {
			$_SESSION['msgs'][] = "failed to login, error: {$result['res']->msg}";
		} else {
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['user_id'] = $result['data'];
			$_SESSION['password_hash'] = $_POST['password_hash'];
			$_SESSION['msgs'][] = 'Logged in!';
		}

		$page_title = 'Login';
		$content_file = realpath(__root_dir . '/private/view/login.php');
		require realpath(__root_dir . '/private/layout/layout.php');
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
