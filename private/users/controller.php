<?php
require_once realpath(__DIR__ . '/../_common/src/init.php');
require_once realpath(__root_dir . '/private/_common/src/result.php');
require_once realpath(__root_dir . '/private/_common/model/users.php');
require_once realpath(__DIR__ . '/model.php');

class UsersController
{

	private $view_file = null;
	private $title = null;
	private $vars = [];

	private function handle_get()
	{
		$this->title = 'Users';
		$this->view_file = realpath(__DIR__ . '/view.php');

		if (isset($_GET['user_id'])) {
			$result = get_user($_GET['user_id']);
			if ($result->is_ok()) {
				$this->vars['username'] = $result->unwrap()['username'];
				$this->vars['description'] = $result->unwrap()['description'];
			} else {
				$err = ErrCode_to_string($result->err);
				$_SESSION['msgs'][] = "Error: $err";
			}
			return;
		}
		$result = latest_users(5);
		if ($result->is_ok()) {
			$this->vars['users'] = $result->unwrap();
		}
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
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
		$this->render();
	}
}
