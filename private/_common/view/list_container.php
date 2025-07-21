<div class="list_container">
	<?php foreach ($list as $item): ?>
	<?php endforeach; ?>

	<div class="list_nav_container">
		<?php for ($i = 0; $i < $list_count; $i++): ?>
			<a href="<?php echo "$url?page=$i" ?>"><?php echo $i; ?></a>

		<?php endfor; ?>

	</div>
</div>
