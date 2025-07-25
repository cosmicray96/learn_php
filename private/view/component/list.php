<?php
if (!isset($list)) {
	throw new AppVarNotProvidedExp('list');
}
if (!isset($item_name)) {
	throw new AppVarNotProvidedExp('item_name');
}
if (!isset($render_file)) {
	throw new AppVarNotProvidedExp('render_file');
}
if (!isset($page_count)) {
	throw new AppVarNotProvidedExp('page_count');
}
if (!isset($base_url)) {
	throw new AppVarNotProvidedExp('base_url');
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
