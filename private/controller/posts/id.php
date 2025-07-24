<?php
require_once  __root_dir . '/private/src/controller.php';
require_once __root_dir . '/private/model/posts.php';
require_once __root_dir . '/private/model/posts/id.php';

class Posts_IdController implements Controller
{
	private function handle_get()
	{
		$post = get_post($_GET['id']);
		if ($post === false) {
			$_SESSION['msgs'][] = "post(id:{$_GET['id']} is not found.)";
			return;
		}

		$comments =	get_comments($_GET['id']);
		Renderer::add_view(new View('content', __view_dir . '/posts/id.php', [], ['post' => $post, 'comments' => $comments]));
		Renderer::set_var_on_view('root', 'title', 'Posts');
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
