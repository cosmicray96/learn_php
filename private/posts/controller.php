<?php
require_once __root_dir . '/private/_common/model/posts.php';
require_once __DIR__ . '/model.php';

require_once __DIR__ . '/id/controller.php';

class PostsController
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

		Renderer::set_title('Posts');
		Renderer::set_layout_file(__root_dir . '/private/_common/view/layout.php');
		Renderer::set_content_file(__DIR__ . '/view.php');
		Renderer::add_var('posts', $posts);
		Renderer::add_var('page_count', $page_count);
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
