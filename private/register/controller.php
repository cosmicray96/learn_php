<?php
require_once __root_dir . '/private/_common/src/exception.php';
require_once __root_dir . '/private/_common/model/users.php';

class RegisterController
{
	private function handle_post()
	{
		Renderer::set_content_file(__DIR__ . '/view.php');
		Renderer::set_layout_file(__root_dir . '/private/_common/view/layout.php');
		Renderer::set_title('Register');

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

	private function handle_get()
	{
		Renderer::set_content_file(__DIR__ . '/view.php');
		Renderer::set_layout_file(__root_dir . '/private/_common/view/layout.php');
		Renderer::set_title('Register');
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
