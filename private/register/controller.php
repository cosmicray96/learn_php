<?php
require_once realpath(__DIR__ . '/../_common/src/init.php');
require_once realpath(__root_dir . '/private/_common/src/result.php');
require_once realpath(__root_dir . '/private/_common/model/users.php');

class RegisterController
{
	private function handle_post()
	{

		$result = register_user($_POST['username'], $_POST['password']);
		if ($result->is_err()) {
			$err  = ErrCode_to_string($result->err);
			$_SESSION['msgs'][] = "failed to Register: $err";
		} else {

			$_SESSION['username'] = $_POST['username'];
			$_SESSION['user_id'] = $result->value;
			$_SESSION['password_hash'] = $_POST['password_hash'];
			$_SESSION['msgs'][] = 'Registered!';
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
