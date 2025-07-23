<?php
require_once __root_dir . '/private/_common/src/controller.php';

function render_nav(PageContext $ctx)
{
	$ctx->add_css('/assets/css/nav_container.css');

	$ctx->set_render_fn(function () {
?>


		<div id="nav_container">
			<nav id="nav">
				<ul id="nav_ul">
					<li class="nav_item"><a class="no_style" href="/index">Index</a></li>
					<li class="nav_item"><a class="no_style" href="/login">Login</a></li>
					<li class="nav_item"><a class="no_style" href="/register">Register</a></li>
					<li class="nav_item"><a class="no_style" href="/new_post">New Post</a></li>
					<li class="nav_item"><a class="no_style" href="/posts">Posts</a></li>
					<li class="nav_item"><a class="no_style" href="/search">Search</a></li>
					<li class="nav_item"><a class="no_style" href="/users">Users</a></li>
				</ul>
			</nav>
		</div>

<?php });
} ?>
