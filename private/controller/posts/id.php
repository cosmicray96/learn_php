<?php
require_once  __root_dir . '/private/src/controller.php';
require_once  __root_dir . '/private/controller/index.php';
require_once __root_dir . '/private/model/posts.php';
require_once __root_dir . '/private/model/posts/id.php';

class Posts_IdController implements Controller
{
	private mixed $_post_id;
	private SegmentedPath $_segmented_path;

	private function handle_get()
	{
		try {
			$post = get_post($this->_post_id);
		} catch (DBNotFoundExp $e) {
			$_SESSION['msgs'][] = "post(id:{$_GET['id']}) is not found)";
			(new E404Controller())->handle($this->_segmented_path);
			return;
		}
		$comments =	get_comments($_GET['id']);

		Renderer::add_view_2('posts_id_page_view', __view_dir . '/partial/posts/id_page.php', ['post' => $post, 'comments' => $comments], null);
		Renderer::set_var_on_view('root', 'content_view', 'posts_id_page_view');
		Renderer::global_state_insert('title', 'Post Id');
	}

	public function handle(SegmentedPath &$segmented_path): void
	{
		$this->_post_id = $segmented_path->consume_cur_segment();
		$this->_segmented_path = $segmented_path;
		if ($segmented_path->peek_cur_segment() !== null) {
			(new E404Controller())->handle($segmented_path);
			return;
		}
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			throw new AppNotImplExp();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
