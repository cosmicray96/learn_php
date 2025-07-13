<?php
require_once realpath(__DIR__ . '/../_common/src/init.php');
require_once realpath(__root_dir . '/private/search/model.php');

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
		error_log("here! Here!");

		$query = trim($_GET['query']);
		$type = $_GET['type'];

		try {
			if ($type === 'post') {
				$this->vars['search_results_posts'] = search_posts($query);
			} elseif ($type === 'user') {
				throw new RuntimeException('What?');
			}
		} catch (mysqli_sql_exception $e) {
			$_SESSION['msgs'][] = "Database Error: $e";
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
