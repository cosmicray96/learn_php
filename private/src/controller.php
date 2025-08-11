<?php

require_once __root_dir . '/private/src/segmented_path.php';

interface Controller
{
	public function handle(SegmentedPath &$segmented_path): void;
}
