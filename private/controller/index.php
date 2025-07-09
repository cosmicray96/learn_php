<?php
require_once realpath(__DIR__ . '/../src/init.php');
require_once realpath(__root_dir . '/private/model/search.php');

class IndexController
{
	public function handle()
	{
		$page_title = 'Index';
		$content_file = realpath(__root_dir . '/private/view/index.php');
		require realpath(__root_dir . '/private/layout/layout.php');
	}
}
