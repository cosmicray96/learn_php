<?php
require_once __root_dir . '/private/src/controller.php';
require_once __root_dir . '/private/src/render.php';

require_once __root_dir . '/private/model/users.php';
require_once __DIR__ . '/users/id.php';

class UsersController implements Controller
{
	private function handle_get()
	{

		if (isset($_GET['id'])) {
			$controller = new Users_IdController();
			$controller->handle();
			return;
		}

		$users = latest_users(5);

		Renderer::add_view(new View('content', __view_dir . '/partial/users_page.php', []));
		Renderer::set_var_on_view('root', 'title', 'Users');
		Renderer::set_var_on_view('content', 'users', $users);
		Renderer::set_var_on_view('content', 'page_count', 5);
	}

	public function handle(): void
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
