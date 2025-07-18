<?php
require_once __root_dir . '/private/_common/src/exception.php';
require_once __root_dir . '/private/_common/model/users.php';
require_once __root_dir . '/private/_common/src/render.php';
require_once __DIR__ . '/model.php';

class UsersController
{
	private function handle_get()
	{
		Renderer::set_layout_file(__root_dir . '/private/_common/view/layout.php');
		Renderer::set_title('Users');

		if (isset($_GET['id'])) {
			try {
				$user = get_user($_GET['id']);
			} catch (DBNotFoundExp $e) {
				$_SESSION['msgs'][] = 'User not found.';
			}
			Renderer::add_var('user', $user);
			Renderer::set_content_file(__DIR__ . '/view.php');
			return;
		}

		$users = latest_users(5);
		Renderer::add_var('users', $users);
		Renderer::set_content_file(__root_dir . '/private/_common/view/users_container.php');
	}

	public function handle()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
