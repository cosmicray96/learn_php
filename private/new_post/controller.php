<?php
require_once __root_dir . '/private/_common/src/exception.php';
require_once __DIR__ . '/model.php';

class NewPostController
{

	private function handle_get()
	{
		if (isset($_SESSION['user_id'])) {

			Renderer::set_content_file(__DIR__ . '/view.php');
		} else {
			Renderer::set_content_file(__root_dir . '/private/_common/view/need_to_login_container.php');
		}
		Renderer::set_layout_file(__root_dir . '/private/_common/view/layout.php');
		Renderer::set_title('New Post');
	}
	private function handle_post()
	{
		Renderer::set_content_file(__DIR__ . '/view.php');
		Renderer::set_layout_file(__root_dir . '/private/_common/view/layout.php');
		Renderer::set_title('New Post');

		if (!isset($_SESSION['user_id'])) {
			throw new AppNotReachableExp();
		}

		$post_id = submit_post($_SESSION['user_id'], $_POST['title'], $_POST['body']);
		if (!$post_id) {

			$_SESSION['msgs'][]	= 'Failed to submit new post.';
			return;
		}

		$_SESSION['msgs'][]	= 'New post submitted';
	}

	public function handle()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->handle_post();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
