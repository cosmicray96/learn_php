<?php
require_once __root_dir . '/private/src/controller.php';
require_once __root_dir . '/private/src/render.php';

require_once __root_dir . '/private/model/users.php';
require_once __DIR__ . '/users/id.php';

class UsersController implements Controller
{
	private function handle_get()
	{
		$page = isset($_GET['page']) ? $_GET['page'] : 0;
		$item_per_page = 10;
		$users = paginated_users($page, $item_per_page);
		$page_count = get_page_count($item_per_page);

		Renderer::set_var_on_view('root', 'content_view', 'users_page_view');
		Renderer::global_state_insert('title', 'Users');
		Renderer::add_view_2('users_page_view', __view_dir . '/partial/users_page.php', ['users' => $users, 'page_count' => $page_count], null);
	}

	public function handle(SegmentedPath &$segmented_path): void
	{
		$segmented_path->consume_cur_segment();

		if ($segmented_path->peek_cur_segment() !== null) {

			(new Users_IdController())->handle($segmented_path);
			return;
		}

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			throw new AppNotImplExp();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
