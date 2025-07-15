<?php

require_once __root_dir . '/private/_common/src/page.php';

function render()
{
	$page_title = Page::$title;
	$content_file = Page::$layout_file;
	extract($vars);
	require Page::$layout_file;
}
