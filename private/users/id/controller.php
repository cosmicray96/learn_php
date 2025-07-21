<?php
require_once __root_dir . '/private/_common/model/users.php';

class Users_IdController
{
	private function handle_get()
	{
		try {
			$user = get_user($_GET['id']);
		} catch (DBNotFoundExp $e) {
			$_SESSION['msgs'][] = 'User not found.';
		}
		Renderer::set_title('Users');
		Renderer::add_var('user', $user);
		Renderer::set_content_file(__DIR__ . '/view.php');
		Renderer::set_layout_file(__root_dir . '/private/_common/view/layout.php');
	}


	public function handle()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			throw new AppNotImplExp();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
