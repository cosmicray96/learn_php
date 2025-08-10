<?php
if (!isset($content_view)) {
	throw new AppVarNotProvidedExp('content_view');
}
if (!isset(Renderer::global_state()['title'])) {
	throw new AppVarNotProvidedExp('Renderer::global_state()[\'title\']');
}

require_once __root_dir . '/private/src/render.php';
?>
<!DOCTYPE html>
<html>

<head>
	<title><?= Renderer::global_state()['title'] ?></title>
	<?php foreach (Renderer::get_css() as $css): ?>
		<link rel="stylesheet" href="<?= $css ?>">
	<?php endforeach; ?>
</head>

<body>
	<div id="root">
		<?php Renderer::render_view('nav'); ?>
		<?php Renderer::render_view('msgs'); ?>

		<?php Renderer::render_view("$content_view"); ?>

		<?php Renderer::render_view('foot'); ?>
	</div>

</body>

</html>
