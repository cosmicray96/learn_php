<?php
require_once realpath(__root_dir . '/private/_common/model/users.php');

require_once realpath(__root_dir . '/private/_common/src/result.php');
require_once realpath(__root_dir . '/private/_common/src/page.php');

class LoginController
{

	private function handle_get()
	{
		Page::$content_file = realpath(__root_dir . '/private/login/view.php');
		Page::$title = 'Login';
		return Result::make_ok();
	}

	private function handle_post()
	{
		Page::$content_file = realpath(__root_dir . '/private/login/view.php');
		Page::$title = 'Login';

		$result = login_user($_POST['username'], $_POST['password']);

		if ($result->is_err()) {
			return $result;
		}

		$_SESSION['username'] = $_POST['username'];
		$_SESSION['user_id'] = $result->value();
		$_SESSION['password_hash'] = $_POST['password_hash'];
		$_SESSION['msgs'][] = 'Logged in!';
		return Result::make_ok();
	}


	public function handle()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			return  $this->handle_post();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			return $this->handle_get();
		}
		return Result::make_err(ErrCode::Err);
	}
}
