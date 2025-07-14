<?php

try {

	require_once __DIR__ . '/../private/_common/src/init.php';

	$routes = require __DIR__ . '/routes.php';
	$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

	$path = rtrim($path, '/');
	if ($path === '') {
		$path = '/';
	}

	if (isset($routes[$path])) {
		$controller = $routes[$path]();
		$controller->handle();
	} else {
		http_response_code(404);
		echo "404 Not Found";
	}
} catch (Throwable $e) {
	http_response_code(500);
	echo "<h1>500 Internal Server Error</h1>";
	echo "<p><strong>" . get_class($e) . ": </strong>";
	echo $e->getMessage() . "</p>";
	echo "<p><strong>Stack Trace: </strong>" . $e->getTraceAsString() . "</p>";
}
