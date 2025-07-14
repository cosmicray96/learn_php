<?php
class IndexController
{
	private $view_file = null;
	private $title = null;
	private $vars = [];


	private function handle_get()
	{
		$this->title = 'Index';
		$this->view_file = realpath(__DIR__ . '/view.php');
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
