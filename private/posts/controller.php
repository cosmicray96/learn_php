<?php
require_once realpath(__DIR__ . '/../_common/src/init.php');

require_once realpath(__DIR__ . '/model.php');

class PostsController
{
	public function handle_get()
	{
		if (isset($_GET['post_id'])) {
		} else {
			$result = latest_posts(5);
			if ($result->is_ok()) {
				$posts = $result->value;
			}
		}

		$page_title = 'Posts';
		$content_file = realpath(__DIR__ . '/view.php');
		require realpath(__root_dir . '/private/_common/view/layout.php');
	}

	public function handle()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			throw new RuntimeException("no post on users");
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
