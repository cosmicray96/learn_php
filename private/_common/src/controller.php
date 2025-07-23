<?php

class View
{
	public ?string $Name;
	public ?string $Path;
	public ?array $Vars;
}

class PageContext
{
	private ?string $_title = null;
	private array $_css = [];
	private array $_js = [];
	private array $_views = [];

	public function set_title(string $title): void
	{
		$this->_title = $title;
	}
	public function get_title(): string
	{
		return $this->_title;
	}

	public function add_css(string $path): void
	{
		$this->_css[] = $path;
	}
	public function get_css(): array
	{
		return $this->_css;
	}

	public function add_js(string $path): void
	{
		$this->_js[] = $path;
	}
	public function get_js(): array
	{
		return $this->_js;
	}

	public function add_view(View $view)
	{
		$this->_views[] = $view;
	}
	public function get_views()
	{
		return $this->_views;
	}
}

interface Controller
{
	public function handle(PageContext &$ctx): void;
}
