<?php
require_once  __root_dir . '/private/_common/model/users.php';

require_once __root_dir . '/private/_common/src/exception.php';
require_once __root_dir . '/private/_common/src/render.php';

class LoginController
{

	private function handle_get()
	{
		Renderer::set_content_file(__DIR__ . '/view.php');
		Renderer::set_layout_file(__root_dir . '/private/_common/view/layout.php');
		Renderer::set_title('Login');
	}

	private function handle_post()
	{
		Renderer::set_content_file(__DIR__ . '/view.php');
		Renderer::set_layout_file(__root_dir . '/private/_common/view/layout.php');
		Renderer::set_title('Login');

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

	public function handle()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->handle_post();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
