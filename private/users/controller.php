<?php
require_once realpath(__DIR__ . '/../src/init.php');
require_once realpath(__root_dir . '/private/model/search.php');

class IndexController
{
	public function handle()
	{

		if (!isset($_POST['user_id'])) {
			$_SESSION['msgs'][] = "user_id not provided";
			header('Location: /index.php');
			exit;
		}
		$user_id = htmlspecialchars($_POST['user_id']);

		$page_title = 'Users';
		$content_file = realpath(__root_dir . '/private/view/users.php');
		require realpath(__root_dir . '/private/layout/layout.php');
	}
}
