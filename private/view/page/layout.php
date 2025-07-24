<?php
require_once __root_dir . '/private/src/render.php';

if (!isset($title)) {
	throw new AppException();
}
?>
<!DOCTYPE html>
<html>

<head>
	<title><?= $title ?></title>
	<?php foreach (Renderer::get_css() as $css): ?>
		<link rel="stylesheet" href="<?= $css ?>">
	<?php endforeach; ?>
</head>

<body>
	<div id="root">
		<?php Renderer::render_view('nav'); ?>
		<?php Renderer::render_view('msgs'); ?>

		<?php Renderer::render_view('content'); ?>

		<?php Renderer::render_view('foot'); ?>
	</div>

</body>

</html>
