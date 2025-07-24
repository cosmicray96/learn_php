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
			echo "404 Not Found";
			return;
		}
		$controller = $routes[$path]();
		$controller->handle();

		// Add Layout render stuff


		Renderer::render();
	}
}
