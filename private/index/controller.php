<?php
require_once realpath(__DIR__ . '/../_common/src/init.php');

class IndexController
{
	public function handle()
	{
		$page_title = 'Index';
		$content_file = realpath(__DIR__ . '/view.php');
		require realpath(__root_dir . '/private/_common/view/layout.php');
	}
}
