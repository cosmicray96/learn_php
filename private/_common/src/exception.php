<?php

class AppException extends Exception
{
	static public function get_class_hierarchy(AppException &$e): string
	{
		$current = get_class($e);
		$output = $current . ' => ';
		while ($parent = get_parent_class($current)) {
			$current = $parent;
			$output = $output . ' => ' . $current;
		}
		return $output;
	}
}
