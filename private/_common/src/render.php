<?php

require_once __root_dir . '/private/_common/src/controller.php';

class Renderer
{
	static public function render(PageContext &$ctx): void
	{
		$view_names = [];
		$views = $ctx->get_views();
		for ($i = 0; $i < count($views); $i++) {
			$view = $views[$i];

			$view_names[] = ["{$view->Name}" => "{$view->Path}"];
		}
	}

	private static function render_view(array &$view_names, View $view): void
	{
		extract($view_names);
		extract($view->Vars);
		require $view->Path;
	}
}
