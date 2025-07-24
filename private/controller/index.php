<?php
require_once  __root_dir . '/private/src/controller.php';
require_once  __root_dir . '/private/src/render.php';

class IndexController implements Controller
{
	private function handle_get(): void
	{
		Renderer::add_view(new View('content', __view_dir . '/index.php', []));
		Renderer::set_var_on_view('root', 'title', 'Index');
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
