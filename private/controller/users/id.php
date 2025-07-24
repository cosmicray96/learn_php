<?php
require_once  __root_dir . '/private/src/controller.php';
require_once __root_dir . '/private/model/users.php';

class Users_IdController implements Controller
{
	private function handle_get(): void
	{
		try {
			$user = get_user($_GET['id']);
		} catch (DBNotFoundExp $e) {
			$_SESSION['msgs'][] = 'User not found.';
		}

		Renderer::add_view(new View('content', __view_dir . '/partial/users/id.php', []));
		Renderer::set_var_on_view('root', 'title', 'Users');
		Renderer::set_var_on_view('content', 'user', $user);
	}


	public function handle(): void
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			throw new AppNotImplExp();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
