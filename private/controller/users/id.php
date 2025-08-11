<?php
require_once  __root_dir . '/private/src/controller.php';
require_once  __root_dir . '/private/controller/index.php';
require_once __root_dir . '/private/model/users.php';

class Users_IdController implements Controller
{

	private mixed $_user_id;

	private function handle_get(): void
	{
		try {
			$user = get_user($this->_user_id);
		} catch (DBNotFoundExp $e) {
			$_SESSION['msgs'][] = 'User not found.';
			$controller = new IndexController();
			$controller->handle($segmented_path);
			return;
		}

		Renderer::add_view_2('users_id_page_view', __view_dir . '/partial/users/id_page.php', ['user' => $user], null);
		Renderer::set_var_on_view('root', 'content_view', 'users_id_page_view');
		Renderer::global_state_insert('title', 'Users Id');
	}

	public function handle(SegmentedPath &$segmented_path): void
	{
		$this->_user_id = $segmented_path->consume_cur_segment();
		if ($segmented_path->peek_cur_segment() !== null) {
			(new E404Controller())->handle($segmented_path);
			return;
		}

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			throw new AppNotImplExp();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
