<?php
require_once __root_dir . '/private/_common/src/controller.php';

function render_msgs(PageContext $ctx)
{
	$ctx->add_css('/assets/css/msgs_container.css');
	$msgs = $_SESSION['msgs'];
	unset($_SESSION['msgs']);

	$ctx->set_render_fn(function () use ($msgs) {
?>
		<div id="msgs_container">
			<?php foreach ($msgs as $msg): ?>
				<div class="msg">
					<h4>Message from server: </h4>
					<p><?php echo $msg; ?></p>
				</div>
			<?php endforeach; ?>
		</div>

<?php
	});
}
?>
