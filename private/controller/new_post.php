<?php
require_once __root_dir . '/private/src/controller.php';
require_once __root_dir . '/private/src/render.php';
require_once __root_dir . '/private/model/new_post.php';

class NewPostController implements Controller
{

	private function handle_get()
	{
		Renderer::set_var_on_view('root', 'title', 'New Post');
		if (isset($_SESSION['user_id'])) {

			Renderer::add_view(new View('content', __view_dir . '/register.php', []));
		} else {
			Renderer::add_view(new View('content', __view_dir . '/need_to_login.php', []));
		}
	}
	private function handle_post()
	{
		Renderer::add_view(new View('content', __view_dir . '/register.php', []));
		Renderer::set_var_on_view('root', 'title', 'New Post');

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

	public function handle(): void
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->handle_post();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
