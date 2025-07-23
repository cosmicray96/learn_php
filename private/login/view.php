<?php

function render_login_form(PageContext &$ctx)
{
	$ctx->set_render_fn(function () {
?>
		<form id="form" method="POST" action="/login">
			<label>Username: <input type="text" name="username" required></label>
			<label>Password: <input type="test" name="password" required></label>
			<button type="submit">Login!</button>
		</form>

<?php
	});
}
?>
