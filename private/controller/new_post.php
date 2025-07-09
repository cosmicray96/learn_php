<?php
require_once realpath(__DIR__ . '/../src/init.php');

class NewPostController
{
	public function handle()
	{
		$page_title = 'New Post';
		$content_file = realpath(__root_dir . '/private/view/new_post.php');
		require realpath(__root_dir . '/private/layout/layout.php');
	}
}
