<?php function render_comment($comment)
{ ?>
	<div class="comment_full">
		<div class="comment_parent_full">
			<p>Username: <?php echo $comment['username']; ?></p>
			<p>Created At: <?php echo $comment['created_at']; ?></p>
			<p>Body: <?php echo $comment['body']; ?></p>
		</div>

		<div class="comment_children_full">
			<?php foreach ($comment['children'] as $child): ?>
				<?php render_comment($child); ?>
			<?php endforeach; ?>
		</div>
	</div>
<?php } ?>

<?php
foreach ($comments as $comment) {
	render_comment($comment);
}
?>
