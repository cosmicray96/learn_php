<?php
require_once realpath(__DIR__ . '/../_common/src/init.php');
require_once realpath(__DIR__ . '/model.php');

class SearchController
{
	private $view_file = null;
	private $title = null;
	private $vars = [];

	private function handle_get()
	{
		$this->title = 'Search';
		$this->view_file = realpath(__DIR__ . '/view.php');

		if (!isset($_GET['query']) || !isset($_GET['type'])) {
			return;
		}

		$query = trim($_GET['query']);
		$type = $_GET['type'];

		if ($type === 'post') {
			$result = search_posts($query);
			if ($result->is_ok()) {
				$this->vars['search_results_posts'] = $result->unwrap();
			}
		} elseif ($type === 'user') {
			$result = search_users($query);
			if ($result->is_ok()) {
				$this->vars['search_results_users'] = $result->unwrap();
			}
		} else {
			$_SESSION['msgs'][] = 'type should be post or user';
		}
	}

	private function render()
	{
		$page_title = $this->title;
		$content_file = $this->view_file;
		extract($this->vars);
		require realpath(__root_dir . '/private/_common/view/layout.php');
	}

	public function handle()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
		$this->render();
	}
}
