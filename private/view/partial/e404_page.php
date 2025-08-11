<?php
if (!isset($url)) {
	throw new AppVarNotProvidedExp('url');
}
?>
<h2>404!</h2>
<p>url: <?= $url ?></p>
