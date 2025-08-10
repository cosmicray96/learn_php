<?php
require_once  __root_dir . '/private/src/controller.php';
require_once  __root_dir . '/private/controller/index.php';
require_once __root_dir . '/private/model/posts.php';
require_once __root_dir . '/private/model/posts/id.php';

class Posts_IdController implements Controller
{
	private function handle_get()
	{
		try {
			$post = get_post($_GET['id']);
		} catch (DBNotFoundExp $e) {
			$_SESSION['msgs'][] = "post(id:{$_GET['id']}) is not found)";
			$controller = new IndexController();
			$controller->handle();
			return;
		}
		$comments =	get_comments($_GET['id']);

		Renderer::add_view_2('posts_id_page_view', __view_dir . '/partial/posts/id_page.php', ['post' => $post, 'comments' => $comments], null);
		Renderer::set_var_on_view('root', 'content_view', 'posts_id_page_view');
		Renderer::global_state_insert('title', 'Post Id');
	}

	public function handle(): void
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			throw new AppNotImplExp();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
