<?php
require_once __root_dir . '/private/_common/src/controller.php';
require_once __DIR__ . '/nav.php';
require_once __DIR__ . '/msgs.php';
require_once __DIR__ . '/foot.php';


?>
<?php function render_layout(PageContext &$ctx)
{
	render_basic_layout($ctx);
	$temp = $ctx->get_render_fn();
	$ctx->set_render_fn(function () use ($temp, $ctx) {
?>
		<html>

		<head>
			<title><?= $ctx->get_title() ?></title>
			<?php foreach ($ctx->get_css() as $css): ?>

				<link rel="stylesheet" href="<?= $css ?>">
			<?php endforeach; ?>
		</head>

		<body>
			<div id="root">
				<?php $temp(); ?>
			</div>

		</body>

		</html>
<?php
	});
} ?>
<?php function render_basic_layout(PageContext &$ctx)
{
	$ctx->add_css('/assets/css/core.css');
	$temp = $ctx->get_render_fn();
	$ctx->set_render_fn(function () use ($temp, $ctx) {
		render_nav($ctx);
		render_msgs($ctx);
		$temp($ctx);
		render_foot($ctx);
	});
} ?>
<!--
<html>

<head>
<title><?php /* echo $page_title; */ ?></title>
	<link rel="stylesheet" href="/assets/css/core.css">
	<link rel="stylesheet" href="/assets/css/nav_container.css">
	<link rel="stylesheet" href="/assets/css/msgs_container.css">
	<link rel="stylesheet" href="/assets/css/form.css">
	<link rel="stylesheet" href="/assets/css/foot_container.css">
</head>

<body>
	<div id="root">
<?php /*require __root_dir . '/private/_common/view/nav_container.php';*/ ?>
<?php /*require __root_dir . '/private/_common/view/msgs_container.php';*/ ?>


<?php /*require $content_file; */ ?>

<?php /*require __root_dir . '/private/_common/view/foot_container.php';*/ ?>
	</div>

</body>

</html>
		-->
