<?php
try {
	require_once __DIR__ . '/../private/src/init.php';
	require_once __root_dir . '/private/src/exception.php';
	require_once __root_dir . '/private/src/destroy.php';
	require_once __root_dir . '/private/controller/main.php';

	$controller = new MainController();
	$controller->handle();

	destroy_on_success();
} catch (Throwable $e) {
	http_response_code(500);
	require __DIR__ . '/../private/_common/view/exception_container.php';
	destroy_on_failure();
}
