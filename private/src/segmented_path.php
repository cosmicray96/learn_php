<?php

class SegmentedPath
{
	private array $_path;

	public function __construct()
	{
		$this->_path = get_path_segmented();
	}

	public function peek_cur_segment(): ?string
	{
		if (count($this->_path) === 0) {
			return null;
		}
		return $this->_path[0];
	}

	public function consume_cur_segment(): ?string
	{
		return array_shift($this->_path);
	}
}

function get_path_segmented(): array
{
	$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$segments = explode('/', trim($uri, '/'));
	return array_values(array_filter($segments, 'strlen'));
}
