<?php
require_once  __root_dir . '/private/src/controller.php';
require_once  __root_dir . '/private/src/render.php';

class IndexController implements Controller
{
	private function handle_get(): void
	{
		if (isset($_SESSION['username'])) {
			Renderer::add_view_2('index_page_view', __view_dir . '/partial/index_page.php', null, null);
		} else {
			Renderer::add_view_2('index_page_view', __view_dir . '/component/need_to_login.php', null, null);
		}
		Renderer::set_var_on_view('root', 'content_view', 'index_page_view');
		Renderer::global_state_insert('title', 'Index');
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
