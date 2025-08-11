<?php
require_once __root_dir . '/private/src/controller.php';
require_once __root_dir . '/private/src/render.php';
require_once  __root_dir . '/private/model/users.php';


class E404Controller implements Controller
{

	private function handle_get()
	{
		Renderer::add_view_2('e404_page_view', __view_dir . '/partial/e404_page.php', ['url' => parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)], null);
		Renderer::set_var_on_view('root', 'content_view', 'e404_page_view');
		Renderer::global_state_insert('title', '404');
	}

	public function handle(SegmentedPath &$segmented_path): void
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			throw new AppNotImplExp();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
