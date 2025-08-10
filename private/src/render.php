<?php

class View
{
	public string $Name;
	public string $Path;
	public ?array $Vars;
	public ?array $Css;

	public function __construct(string $name, string $path, ?array $vars, ?array $css)
	{
		$this->Name = $name;
		$this->Path = $path;
		$this->Vars = $vars;
		$this->Css = $css;
	}
}

class Renderer
{
	private static array $_views = [];
	private static array $_global_state = [];

	public static function render()
	{
		if (!isset(self::$_views[0])) {
			throw new AppException();
		}
		self::render_view(self::$_views[0]->Name);
	}

	public static function render_view(string $name): void
	{
		$view = self::get_view($name);
		if (!$view) {
			throw new AppException();
		}
		if ($view->Vars) {
			extract($view->Vars);
		}
		require $view->Path;
	}

	public static function render_file(string $path, array $vars = []): void
	{
		extract($vars);
		require $path;
	}

	public static function add_main_view(View $view)
	{
		if (self::get_view($view->Name)) {
			throw new AppException();
		}
		array_splice(self::$_views, 0, 0, [$view]);
	}

	public static function add_view(View $view)
	{
		if (!self::get_view($view->Name)) {
			self::$_views[] = $view;
		}
	}

	public static function add_view_2(string $name, string $path, ?array $vars, ?array $css)
	{
		self::$_views[] = new View($name, $path, $vars, $css);
	}

	public static function global_state_insert(string $name, mixed $value): void
	{
		self::$_global_state["$name"] = $value;
	}
	public static function &global_state(): array
	{
		return self::$_global_state;
	}

	public static function get_css(): array
	{
		$css = [];
		foreach (self::$_views as $view) {
			if ($view->Css) {
				foreach ($view->Css as $c) {
					$css[] = $c;
				}
			}
		}
		return $css;
	}

	public static function set_var_on_view(string $view_name, string $var_name, mixed $var_value): void
	{
		$view = self::get_view($view_name);

		if (!$view) {
			throw new AppException();
		}
		$view->Vars["$var_name"] = $var_value;
	}

	//--- Private ---//

	private static function get_view(string $name): ?View
	{
		foreach (self::$_views as &$view) {
			if ($view->Name === $name) {
				return $view;
			}
		}
		return null;
	}
}
