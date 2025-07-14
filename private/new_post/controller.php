<?php
require_once realpath(__root_dir . '/private/new_post/model.php');

class NewPostController
{

	private $view_file = null;
	private $title = null;
	private $vars = [];

	private function handle_get()
	{
		$this->view_file = realpath(__root_dir . '/private/new_post/view.php');
		$this->title = 'New Post';
	}
	private function handle_post()
	{
		$this->view_file = realpath(__root_dir . '/private/new_post/view.php');
		$this->title = 'New Post';

		if (!isset($_SESSION['user_id'])) {
			throw new RuntimeException('How?');
			return;
		}

		$result = submit_post($_SESSION['user_id'], $_POST['title'], $_POST['body']);
		if ($result->is_ok()) {
			$_SESSION['msgs'][]	= 'New post submitted';
		} else {
			$err = ErrCode_to_string($result->err);
			$_SESSION['msgs'][]	= "Failed to submit new post: $err";
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
			$this->handle_post();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}

		$this->render();
	}
}
