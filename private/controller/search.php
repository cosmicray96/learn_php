<?php
require_once __root_dir . '/private/src/controller.php';
require_once __root_dir . '/private/model/search.php';

class SearchController implements Controller
{
	private function handle_get()
	{
		Renderer::add_view_2('search_page_view', __view_dir . '/partial/search_page.php', null, null);
		Renderer::set_var_on_view('root', 'content_view', 'search_page_view');
		Renderer::global_state_insert('title', 'Search');

		if (!isset($_GET['query']) || !isset($_GET['type'])) {
			return;
		}

		$query = trim($_GET['query']);
		$type = $_GET['type'];

		if ($type === 'post') {
			$result = search_posts($query);
			Renderer::set_var_on_view('search_page_view', 'posts', $result);
		} elseif ($type === 'user') {
			$result = search_users($query);
			Renderer::set_var_on_view('search_page_view', 'users', $result);
		} else {
			$_SESSION['msgs'][] = 'type should be post or user';
		}
	}

	public function handle(SegmentedPath &$segmented_path): void
	{
		$segmented_path->consume_cur_segment();

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
