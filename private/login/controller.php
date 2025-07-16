<?php
require_once realpath(__root_dir . '/private/_common/model/users.php');

require_once realpath(__root_dir . '/private/_common/src/exception.php');
require_once realpath(__root_dir . '/private/_common/src/render.php');

class LoginController
{

	private function handle_get()
	{
		Renderer::set_content_file(realpath(__root_dir . '/private/login/view.php'));
		Renderer::set_title('Login');
	}

	private function handle_post()
	{
		Renderer::set_content_file(realpath(__root_dir . '/private/login/view.php'));
		Renderer::set_title('Login');

		try {
			$result = login_user($_POST['username'], $_POST['password']);
		} catch (AuthInvalidUsernameExp $e) {
		} catch (AuthInvalidPasswordExp $e) {
		} catch (AuthWrongPasswordExp $e) {
		} catch (DBNotFoundExp $e) {
		}

		$_SESSION['username'] = $_POST['username'];
		$_SESSION['user_id'] = $result->value();
		$_SESSION['password_hash'] = $_POST['password_hash'];
		$_SESSION['msgs'][] = 'Logged in!';
	}


	public function handle()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			return  $this->handle_post();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			return $this->handle_get();
		}
	}
}
