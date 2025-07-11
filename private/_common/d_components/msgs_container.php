<div id="msgs_container">
	<?php foreach ($_SESSION['msgs'] as $msg): ?>
		<div class="msg">
			<h4>Message from server: </h4>
			<p><?php echo $msg; ?></p>
		</div>
	<?php endforeach; ?>
</div>
<?php unset($_SESSION['msgs']); ?>
