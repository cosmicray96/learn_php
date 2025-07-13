<?php
require_once realpath(__DIR__ . '/../_common/src/init.php');

require_once realpath(__root_dir . '/private/_common/model/posts.php');
require_once realpath(__DIR__ . '/model.php');

class PostsController
{
	private $view_file = null;
	private $title = null;
	private $vars = [];

	private function handle_get()
	{
		$this->title = 'Posts';
		$this->view_file = realpath(__DIR__ . '/view.php');
		if (isset($_GET['id'])) {
			error_log("alfjdnxi");
			$result = get_post($_GET['id']);
			if ($result->is_ok()) {
				$this->vars['post'] = $result->unwrap();
			} else {
				$err = ErrCode_to_string($result->err);
				$_SESSION['msgs'][] = "Error: $err";
			}
			return;
		}
		$result = latest_posts(5);
		if ($result->is_ok()) {
			$this->vars['posts'] = $result->unwrap();
		}
	}

	private function render()
	{
		$page_title = $this->title;
		$content_file = $this->view_file;
		extract($this->vars);
		require realpath(__root_dir . '/private/_common/view/layout.php');
	}

	public function handle()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}

		$this->render();
	}
}
