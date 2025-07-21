<?php
require_once __root_dir . '/private/_common/src/exception.php';

require_once __root_dir . '/private/_common/src/scripts/scripts.php';

class ScriptsController
{
	private function handle_get()
	{
		Renderer::set_content_file(__DIR__ . '/view.php');
		Renderer::set_layout_file(__root_dir . '/private/_common/view/layout.php');
		Renderer::set_title('Scripts');
		Scripts::add_bot_users(0, 20);
		Renderer::add_var('script_name', 'add_bot_users');
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
