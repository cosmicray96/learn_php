<?php
require_once __root_dir . '/private/_common/src/exception.php';
require_once __DIR__ . '/model.php';

class SearchController
{
	private function handle_get()
	{
		Renderer::set_content_file(__DIR__ . '/view.php');
		Renderer::set_layout_file(__root_dir . '/private/_common/view/layout.php');
		Renderer::set_title('Search');

		if (!isset($_GET['query']) || !isset($_GET['type'])) {
			return;
		}

		$query = trim($_GET['query']);
		$type = $_GET['type'];

		if ($type === 'post') {
			$result = search_posts($query);
			Renderer::add_var('posts', $result);
		} elseif ($type === 'user') {
			$result = search_users($query);
			Renderer::add_var('users', $result);
		} else {
			$_SESSION['msgs'][] = 'type should be post or user';
		}
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
