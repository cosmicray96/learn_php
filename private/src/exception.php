<?php

class AppException extends Exception
{
	static public function get_class_hierarchy(AppException &$e): string
	{
		$current = get_class($e);
		$output = $current;
		while ($parent = get_parent_class($current)) {
			$current = $parent;
			$output = $output . ' => ' . $current;
		}
		return $output;
	}
}

class AppNotImplExp extends AppException {}
class AppNotReachableExp extends AppException {}
class AppVarNotProvidedExp extends AppException
{
	public function __construct(string $var_name)
	{
		parent::__construct("variable `$var_name` not provided");
	}
}
