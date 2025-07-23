<?php
try {
	require_once __DIR__ . '/../private/_common/src/init.php';

	require_once __root_dir . '/private/_common/src/render.php';
	require_once __root_dir . '/private/_common/src/destroy.php';
	require_once __root_dir . '/private/_common/src/controller.php';
	require_once __root_dir . '/private/_common/view/layout/layout.php';

	$routes = require __DIR__ . '/routes.php';
	$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

	$path = rtrim($path, '/');
	if ($path === '') {
		$path = '/';
	}

	if (!isset($routes[$path])) {
		http_response_code(404);
		echo "404 Not Found";
		exit;
	}

	$controller = $routes[$path]();
	$page_context = new PageContext();
	$controller->handle($page_context);
	render_layout($page_context);
	Renderer::render($page_context);

	destroy_on_success();
} catch (Throwable $e) {
	http_response_code(500);
	require __DIR__ . '/../private/_common/view/exception_container.php';
	destroy_on_failure();
}
