<?php
require_once realpath(__DIR__ . '/../src/init.php');
require_once realpath(__root_dir . '/private/model/search.php');

class PostsController
{
	public function handle()
	{

		require realpath(__root_dir . '/private/src/get_posts_2.php');
		$posts = get_posts();

		$page_title = 'Posts';
		$content_file = realpath(__root_dir . '/private/view/posts.php');
		require realpath(__root_dir . '/private/layout/layout.php');
	}
}
