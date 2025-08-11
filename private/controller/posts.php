<?php
require_once __root_dir . '/private/src/controller.php';
require_once __root_dir . '/private/model/posts.php';

require_once __DIR__ . '/posts/id.php';

class PostsController implements Controller
{
	private function handle_get()
	{
		$page = isset($_GET['page']) ? $_GET['page'] : 0;

		$item_per_page = 10;
		$posts = paginated_post($page, $item_per_page);
		$page_count = get_page_count($item_per_page);

		Renderer::add_view_2('posts_page_view', __view_dir . '/partial/posts_page.php', ['posts' => $posts, 'page_count' => $page_count], null);
		Renderer::set_var_on_view('root', 'content_view', 'posts_page_view');
		Renderer::global_state_insert('title', 'Posts');
	}

	public function handle(SegmentedPath &$segmented_path): void
	{
		$segmented_path->consume_cur_segment();

		if ($segmented_path->peek_cur_segment() !== null) {

			(new Posts_IdController())->handle($segmented_path);
			return;
		}
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			throw new AppNotImplExp();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
