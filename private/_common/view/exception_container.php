<?php if (!isset($e)): ?>
	<p>exception variable $e not provided!</p>
<?php else: ?>
	<div id="exception_container">
		<h1>500 Internal Server Error</h1>
		<p><strong><?php echo get_class($e); ?>: </strong><?php echo $e->getMessage(); ?></p>;
		<p><strong>Stack Trace: </strong><?php echo $e->getTraceAsString(); ?></p>;
	</div>
<?php endif; ?>
