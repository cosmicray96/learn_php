<?php
require_once realpath(__DIR__ . '/../_common/src/init.php');
require realpath(__root_dir . '/private/_common/model/get_posts.php');

class PostsController
{
	public function handle()
	{
		$posts = get_posts();

		$page_title = 'Posts';
		$content_file = realpath(__DIR__ . '/view.php');
		require realpath(__root_dir . '/private/_common/view/layout.php');
	}
}
