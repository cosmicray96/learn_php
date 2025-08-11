<?php
require_once __root_dir . '/private/src/controller.php';
require_once __root_dir . '/private/src/render.php';
require_once __root_dir . '/private/model/new_post.php';

class NewPostController implements Controller
{

	private function handle_get()
	{
		if (isset($_SESSION['user_id'])) {
			Renderer::add_view_2('new_post_page_view', __view_dir . '/partial/new_post_page.php', null, null);
		} else {
			Renderer::add_view_2('new_post_page_view', __view_dir . '/component/need_to_login.php', null, null);
		}
		Renderer::set_var_on_view('root', 'content_view', 'new_post_page_view');
		Renderer::global_state_insert('title', 'New Post');
	}
	private function handle_post()
	{
		Renderer::add_view_2('new_post_page_view', __view_dir . '/partial/new_post_page.php', null, null);
		Renderer::set_var_on_view('root', 'content_view', 'new_post_page_view');
		Renderer::global_state_insert('title', 'New Post');

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

	public function handle(SegmentedPath &$segmented_path): void
	{
		$segmented_path->consume_cur_segment();

		if ($segmented_path->peek_cur_segment() !== null) {
			(new Users_IdController())->handle($segmented_path);
			return;
		}

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->handle_post();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
