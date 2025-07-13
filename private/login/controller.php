<?php
require_once realpath(__DIR__ . '/../_common/src/init.php');
require_once realpath(__root_dir . '/private/_common/model/users.php');

class LoginController
{
	private $view_file = null;
	private $title = null;
	private $vars = [];

	private function handle_get()
	{
		$this->view_file = realpath(__root_dir . '/private/login/view.php');
		$this->title = 'Login';
	}

	private function handle_post()
	{
		$this->view_file = realpath(__root_dir . '/private/login/view.php');
		$this->title = 'Login';

		$result = login_user($_POST['username'], $_POST['password']);

		if ($result->is_err()) {
			$err  = ErrCode_to_string($result->err);
			$_SESSION['msgs'][] = "failed to login: $err";
			return;
		}

		$_SESSION['username'] = $_POST['username'];
		$_SESSION['user_id'] = $result->value;
		$_SESSION['password_hash'] = $_POST['password_hash'];
		$_SESSION['msgs'][] = 'Logged in!';
	}

	private function render()
	{
		$page_title = $this->title;
		$content_file = $this->view_file;
		extract($this->vars);
		require realpath(__root_dir . '/private/_common/view/layout.php');
	}

	public function handle()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->handle_post();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}

		$this->render();
	}
}
