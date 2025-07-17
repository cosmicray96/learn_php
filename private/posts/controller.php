<?php
require_once __root_dir . '/private/_common/model/posts.php';
require_once __DIR__ . '/model.php';

class PostsController
{
	private function handle_get()
	{
		Renderer::set_layout_file(__root_dir . '/private/_common/view/layout.php');
		Renderer::set_content_file(__root_dir . '/private/_common/view/posts_container.php');
		Renderer::set_title('New Post');

		if (isset($_GET['id'])) {
			$post = get_post($_GET['id']);
			if ($post === false) {
				$_SESSION['msgs'][] = "post(id:{$_GET['id']} is not found.)";
				return;
			}
			$vars['post'] = $post;
			Renderer::set_content_file(__DIR__ . '/view.php');
			Renderer::set_vars($vars);
			return;
		}

		$posts = latest_posts(5);
		$vars['posts'] = $posts;
		Renderer::set_vars($vars);
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
