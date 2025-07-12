<?php
require_once realpath(__DIR__ . '/../_common/src/init.php');
require_once realpath(__root_dir . '/private/new_post/model.php');

class NewPostController
{
	private function handle_post()
	{

		if (isset($_SESSION['user_id'])) {

			$result = submit_post($_SESSION['user_id'], $_POST['title'], $_POST['body']);
			if ($result->is_ok()) {
				$_SESSION['msgs'][]	= 'New post submitted';
			} else {
				$err = ErrCode_to_string($result->err);
				$_SESSION['msgs'][]	= "Failed to submit new post: $err";
			}
		}


		$page_title = 'New Post';
		$content_file = realpath(__root_dir . '/private/new_post/view.php');
		require realpath(__root_dir . '/private/_common/view/layout.php');
	}

	private function handle_get()
	{
		$page_title = 'New Post';
		$content_file = realpath(__root_dir . '/private/new_post/view.php');
		require realpath(__root_dir . '/private/_common/view/layout.php');
	}

	public function handle()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->handle_post();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
