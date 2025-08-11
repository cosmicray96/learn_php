<?php
require_once __root_dir . '/private/src/controller.php';
require_once __root_dir . '/private/src/render.php';
require_once  __root_dir . '/private/model/users.php';

class RegisterController implements Controller
{
	private function handle_get()
	{
		Renderer::add_view_2('register_page_view', __view_dir . '/partial/register_page.php', null, null);
		Renderer::set_var_on_view('root', 'content_view', 'register_page_view');
		Renderer::global_state_insert('title', 'Register');
	}

	private function handle_post()
	{
		Renderer::add_view_2('register_page_view', __view_dir . '/partial/register_page.php', null, null);
		Renderer::set_var_on_view('root', 'content_view', 'register_page_view');
		Renderer::global_state_insert('title', 'Register');

		try {
			$user_id = register_user($_POST['username'], $_POST['password']);
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['user_id'] = $user_id;
			$_SESSION['password_hash'] = $_POST['password_hash'];
			$_SESSION['msgs'][] = 'Registered!';
		} catch (AuthInvalidPasswordExp $e) {
			$_SESSION['msgs'][] = 'Invalid Password!';
		} catch (AuthInvalidUsernameExp $e) {
			$_SESSION['msgs'][] = 'Invalid Username!';
		} catch (AuthNameTakenExp $e) {
			$_SESSION['msgs'][] = 'Username is taken';
		}
	}


	public function handle(SegmentedPath &$segmented_path): void
	{
		$segmented_path->consume_cur_segment();

		if ($segmented_path->peek_cur_segment() !== null) {
			(new E404Controller())->handle($segmented_path);
			return;
		}

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->handle_post();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
