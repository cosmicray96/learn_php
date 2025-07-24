<?php
require_once __root_dir . '/private/src/controller.php';
require_once __root_dir . '/private/model/posts.php';
require_once __root_dir . '/private/model/posts.php';

require_once __DIR__ . '/posts/id.php';

class PostsController implements Controller
{
	private function handle_get()
	{
		if (isset($_GET['id'])) {
			$controller = new Posts_IdController();
			$controller->handle();
			return;
		}

		$page = isset($_GET['page']) ? $_GET['page'] : 0;

		$item_per_page = 10;
		$posts = paginated_post($page, $item_per_page);
		$page_count = get_page_count($item_per_page);

		Renderer::add_view(new View('content', __view_dir . '/posts.php', [], ['posts' => $posts, 'page_count' => $page_count]));
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
