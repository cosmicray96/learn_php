<?php
if (!isset($user)) {
	throw new AppVarNotProvidedExp('user');
}
require_once __root_dir . '/private/src/render.php';
?>
<?php
Renderer::render_file(__view_dir . '/component/user/full.php', [
	'user' => $user
]);
?>
