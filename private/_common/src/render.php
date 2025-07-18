<?php

class Renderer
{
	private static ?string $s_title = null;
	private static ?array $s_vars = null;
	private static ?string $s_content_file = null;
	private static ?string $s_layout_file = null;

	//--- Static ---//

	static public function set_title(string $title): void
	{
		Renderer::$s_title = $title;
	}

	static public function add_var(string $name, mixed $value): void
	{
		Renderer::$s_vars[$name] = $value;
	}

	static public function set_content_file(string $content_file): void
	{
		Renderer::$s_content_file = $content_file;
	}

	static public function set_layout_file(string $layout_file): void
	{
		Renderer::$s_layout_file = $layout_file;
	}

	static public function render(): void
	{
		$page_title = Renderer::$s_title;
		$content_file = Renderer::$s_content_file;
		if (Renderer::$s_vars) {
			extract(Renderer::$s_vars);
		}
		require Renderer::$s_layout_file;
	}
}
