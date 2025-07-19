<?php
require_once __root_dir . '/private/_common/model/posts.php';

class Posts_IdController
{
	private function handle_get()
	{
		Renderer::set_layout_file(__root_dir . '/private/_common/view/layout.php');
		Renderer::set_title('Post');
		Renderer::set_content_file(__DIR__ . '/view.php');

		$post = get_post($_GET['id']);
		if ($post === false) {
			$_SESSION['msgs'][] = "post(id:{$_GET['id']} is not found.)";
			return;
		}
		Renderer::set_content_file(__DIR__ . '/view.php');
		Renderer::add_var('post', $post);
		// todo coments
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
