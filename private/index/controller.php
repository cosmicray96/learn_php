<?php
require_once realpath(__root_dir . '/private/_common/src/exception.php');
require_once realpath(__root_dir . '/private/_common/src/render.php');

class IndexController
{
	private function handle_get()
	{
		Renderer::set_content_file(__DIR__ . '/view.php');
		Renderer::set_layout_file(realpath(__root_dir . '/private/_common/view/layout.php'));
		Renderer::set_title('Login');
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
