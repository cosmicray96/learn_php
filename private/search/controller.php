<?php
require_once realpath(__DIR__ . '/../_common/src/init.php');
require_once realpath(__root_dir . '/private/search/model.php');

class SearchController
{
	public function handle()
	{
		if (isset($_GET['query'], $_GET['type'])) {
			$query = trim($_GET['query']);
			$type = $_GET['type'];

			try {
				if ($type === 'post') {
					$search_results_posts = search_posts($query);
				} elseif ($type === 'user') {
					$search_results_users = search_posts($query);
				}
			} catch (mysqli_sql_exception $e) {
				$_SESSION['msgs'][] = "Database Error: $e";
				header('Location: /search.php');
				exit;
			}
		}

		$page_title = 'Search Results';
		$content_file = realpath(__DIR__ . '/view.php');
		require realpath(__root_dir . '/private/_common/view/layout.php');
	}
}
