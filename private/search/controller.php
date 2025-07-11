<?php
require_once realpath(__DIR__ . '/../src/init.php');
require_once realpath(__root_dir . '/private/model/search.php');

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
		$content_file = realpath(__root_dir . '/private/view/search.php');
		require realpath(__root_dir . '/private/layout/layout.php');
	}
}
