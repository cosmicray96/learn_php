<?php
require_once __root_dir . '/private/src/controller.php';
require_once __root_dir . '/private/src/render.php';
require_once  __root_dir . '/private/model/users.php';


class LoginController implements Controller
{

	private function handle_get()
	{
		Renderer::add_view_2('login_page_view', __view_dir . '/partial/login_page.php', null, null);
		Renderer::set_var_on_view('root', 'content_view', 'login_page_view');
		Renderer::global_state_insert('title', 'Login');
	}

	private function handle_post()
	{
		Renderer::add_view_2('login_page_view', __view_dir . '/partial/login_page.php', null, null);
		Renderer::set_var_on_view('root', 'content_view', 'login_page_view');
		Renderer::global_state_insert('title', 'Login');

		try {
			$user_id = login_user($_POST['username'], $_POST['password']);
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['user_id'] = $user_id;
			$_SESSION['password_hash'] = $_POST['password_hash'];
			$_SESSION['msgs'][] = 'Logged in!';
		} catch (AuthInvalidUsernameExp $e) {
			$_SESSION['msgs'][] = 'Invalid Username';
		} catch (AuthInvalidPasswordExp $e) {
			$_SESSION['msgs'][] = 'Invalid Password';
		} catch (AuthWrongPasswordExp $e) {
			$_SESSION['msgs'][] = 'Wrong Password';
		} catch (DBNotFoundExp $e) {
			$_SESSION['msgs'][] = 'Username Not Found';
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
