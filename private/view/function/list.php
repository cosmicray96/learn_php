<?php function render_list(array $list, callable $render_fn, int $page_count, string $base_url)
{ ?>
	<div class="list_container">
		<div class="list">
			<?php foreach ($list as $item): ?>
				<?php $render_fn($item); ?>
			<?php endforeach; ?>
		</div>

		<div class="list_nav_container">
			<?php for ($i = 0; $i < $page_count; $i++): ?>
				<a href="<?php echo "$base_url" . "page=$i" ?>"><?php echo $i; ?></a>

			<?php endfor; ?>
		</div>
	</div>
<?php } ?>
