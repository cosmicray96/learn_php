<?php
require_once realpath(__DIR__ . '/../_common/src/init.php');

class NewPostController
{
	public function handle()
	{
		$page_title = 'New Post';
		$content_file = realpath(__root_dir . '/private/new_post/view.php');
		require realpath(__root_dir . '/private/_common/view/layout.php');
	}
}
