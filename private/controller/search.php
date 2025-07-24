<?php
require_once __root_dir . '/private/src/controller.php';
require_once __root_dir . '/private/model/search.php';

class SearchController implements Controller
{
	private function handle_get()
	{

		Renderer::add_view(new View('content', __view_dir . '/partial/search_page.php', []));
		if (!isset($_GET['query']) || !isset($_GET['type'])) {
			return;
		}

		$query = trim($_GET['query']);
		$type = $_GET['type'];

		if ($type === 'post') {
			$result = search_posts($query);
			Renderer::set_var_on_view('content', 'posts', $result);
		} elseif ($type === 'user') {
			$result = search_users($query);
			Renderer::set_var_on_view('content', 'users', $result);
		} else {
			$_SESSION['msgs'][] = 'type should be post or user';
		}

		Renderer::set_var_on_view('root', 'title', 'Search');
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
