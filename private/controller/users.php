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

		$page = isset($_GET['page']) ? $_GET['page'] : 0;
		$item_per_page = 10;
		$users = paginated_users($page, $item_per_page);
		$page_count = get_page_count($item_per_page);

		Renderer::add_view(new View('content', __view_dir . '/partial/users_page.php', []));
		Renderer::set_var_on_view('root', 'title', 'Users');
		Renderer::set_var_on_view('content', 'users', $users);
		Renderer::set_var_on_view('content', 'page_count', $page_count);
	}

	public function handle(): void
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
