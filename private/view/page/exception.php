<?php
if (!isset($e)) {
	echo "no exception provided";
	exit;
}
?>
<html>

<head>
	<title>404</title>
</head>

<body>
	<div id="exception_container">
		<h1>500 Internal Server Error</h1>

		<?php if ($e instanceof AppException): ?>
			<p><strong>Class Hierarchy: </strong> <?php echo AppException::get_class_hierarchy($e); ?></p>
		<?php else: ?>
			<p><strong>Class</strong>: <?php echo get_class($e); ?></p>
		<?php endif; ?>

		<p><strong>Message: </strong><?php echo $e->getMessage(); ?></p>
		<p><strong>Location: </strong><?php echo 'File: ' . $e->getFile() . ': ' . $e->getLine(); ?></p>
		<p>
			<strong>Stack Trace:</strong><br>
			<?php echo nl2br($e->getTraceAsString()); ?>
		</p>
	</div>

</body>

</html>
