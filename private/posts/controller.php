<?php
require_once realpath(__DIR__ . '/../_common/src/init.php');
require realpath(__root_dir . '/private/_common/src/get_posts.php');

class PostsController
{
	public function handle()
	{
		$posts = get_posts();

		$page_title = 'Posts';
		$content_file = realpath(__root_dir . '/private/posts/view.php');
		require realpath(__root_dir . '/private/_common/view/layout.php');
	}
}
