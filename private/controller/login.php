<?php
require_once realpath(__DIR__ . '/../src/init.php');
require_once realpath(__root_dir . '/private/model/search.php');

class LoginController
{
	public function handle()
	{


		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// This is a POST request
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			// This is a GET request
		}

		$page_title = 'Login';
		$content_file = realpath(__root_dir . '/private/view/login.php');
		require realpath(__root_dir . '/private/layout/layout.php');
	}
}
