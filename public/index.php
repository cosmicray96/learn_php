<?php
try {
	require_once __DIR__ . '/../private/_common/src/init.php';

	require_once __root_dir . '/private/_common/src/render.php';
	require_once __root_dir . '/private/_common/src/destroy.php';
	require_once __root_dir . '/private/_common/src/controller.php';

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

	Renderer::add_view(new View('nav', __root_dir . '/private/_common/view/layout/nav.php', ['/assets/css/nav_container.css']));
	Renderer::add_view(new View('msgs', __root_dir . '/private/_common/view/layout/msgs.php', ['/assets/css/msgs_container.css']));
	Renderer::add_view(new View('foot', __root_dir . '/private/_common/view/layout/foot.php', ['/assets/css/foot_container.css']));
	Renderer::add_main_view(new View('root', __root_dir . '/private/_common/view/layout/layout.php', ['/assets/css/core.css', '/assets/css/form.css']));
	$controller = $routes[$path]();
	$controller->handle();

	Renderer::render();

	destroy_on_success();
} catch (Throwable $e) {
	http_response_code(500);
	require __DIR__ . '/../private/_common/view/exception_container.php';
	destroy_on_failure();
}
