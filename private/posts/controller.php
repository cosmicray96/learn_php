<?php
require_once __root_dir . '/private/_common/model/posts.php';
require_once __DIR__ . '/model.php';

require_once __DIR__ . '/id/controller.php';

class PostsController
{
	private function handle_get()
	{
		Renderer::set_layout_file(__root_dir . '/private/_common/view/layout.php');
		Renderer::set_content_file(__root_dir . '/private/_common/view/posts_container.php');
		Renderer::set_title('Posts');

		if (isset($_GET['id'])) {
			$controller = new Posts_IdController();
			$controller->handle();
			return;
		}

		$posts = latest_posts(5);
		Renderer::add_var('posts', $posts);
		return;
	}

	public function handle()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			throw new AppNotImplExp();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
