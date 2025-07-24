<?php
$msgs = $_SESSION['msgs'];
unset($_SESSION['msgs']);
?>
<div id="msgs_container">
	<?php foreach ($msgs as $msg): ?>
		<div class="msg">
			<h4>Message from server: </h4>
			<p><?php echo $msg; ?></p>
		</div>
	<?php endforeach; ?>
</div>
