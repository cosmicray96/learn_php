<?php
require_once __root_dir . '/private/src/controller.php';
require_once __root_dir . '/private/src/render.php';

class MainController implements Controller
{
	public function handle(): void
	{
		$routes = require __root_dir . '/private/config/routes.php';
		$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

		$path = rtrim($path, '/');
		if ($path === '') {
			$path = '/';
		}

		if (!isset($routes[$path])) {
			http_response_code(404);
			require __view_dir . '/page/e404.php';
			return;
		}

		Renderer::add_main_view(new View(
			'root',
			__view_dir . '/page/layout.php',
			['/assets/css/core.css', '/assets/css/form.css']
		));
		Renderer::add_view(new View(
			'nav',
			__view_dir . '/component/layout/nav.php',
			['/assets/css/nav_container.css']
		));
		Renderer::add_view(new View(
			'msgs',
			__view_dir . '/component/layout/msgs.php',
			['/assets/css/msgs_container.css']
		));
		Renderer::add_view(new View(
			'foot',
			__view_dir . '/component/layout/foot.php',
			['/assets/css/foot_container.css']
		));

		$controller = $routes[$path]();
		$controller->handle();

		// Add Layout render stuff


		Renderer::render();
	}
}
