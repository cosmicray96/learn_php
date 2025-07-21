<?php
require_once __root_dir . '/private/_common/src/exception.php';
require_once __root_dir . '/private/_common/model/users.php';
require_once __root_dir . '/private/_common/src/render.php';
require_once __DIR__ . '/model.php';
require_once __DIR__ . '/id/controller.php';

class UsersController
{
	private function handle_get()
	{
		if (isset($_GET['id'])) {
			$controller = new Users_IdController();
			$controller->handle();
			return;
		}

		$users = latest_users(5);
		Renderer::add_var('users', $users);
		Renderer::set_content_file(__DIR__ . '/view.php');
		Renderer::set_layout_file(__root_dir . '/private/_common/view/layout.php');
		Renderer::set_title('Users');
	}

	public function handle()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
