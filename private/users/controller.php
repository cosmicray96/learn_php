<?php
require_once realpath(__DIR__ . '/../src/init.php');

class UsersController
{
	public function handle()
	{

		if (isset($_POST['username'])) {
			$username = htmlspecialchars($_POST['username']);
		}

		$page_title = 'Users';
		$content_file = realpath(__DIR__ . '/view.php');
		require realpath(__root_dir . '/private/_common/view/layout.php');
	}
}
