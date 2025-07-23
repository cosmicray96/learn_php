<?php
require_once __root_dir . '/private/_common/src/controller.php';

function render_foot(PageContext $ctx)
{
	$ctx->add_css('/assets/css/foot_container.css');
	$ctx->set_render_fn(function () {
?>
		<div id="foot_container">
			<?php echo date('Y'); ?>
		</div>

<?php
	});
}
?>
