<?php
if (
	!isset($list) ||
	!isset($item_name) ||
	!isset($render_file) ||
	!isset($page_count) ||
	!isset($base_url)
) {
	throw new AppException();
}

?>
<div class="list_container">
	<div class="list">
		<?php foreach ($list as $item): ?>
			<?php
			${$item_name} = $item;
			require $render_file;
			?>
		<?php endforeach; ?>
	</div>

	<div class="list_nav_container">
		<?php for ($i = 0; $i < $page_count; $i++): ?>
			<a href="<?php echo "$base_url" . "page=$i" ?>"><?php echo $i; ?></a>

		<?php endfor; ?>
	</div>
</div>
