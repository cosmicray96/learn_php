<?php
require_once realpath(__DIR__ . '/../src/init.php');
require_once realpath(__root_dir . '/private/model/search.php');

class RegisterController
{
	public function handle()
	{
		$page_title = 'Register';
		$content_file = realpath(__root_dir . '/private/view/register.php');
		require realpath(__root_dir . '/private/layout/layout.php');
	}
}
