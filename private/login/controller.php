<?php
require_once __root_dir . '/private/_common/src/controller.php';
require_once __root_dir . '/private/_common/src/render.php';
require_once  __root_dir . '/private/_common/model/users.php';

require_once __root_dir . '/private/_common/src/exception.php';

class LoginController implements Controller
{

	private function handle_get()
	{
		Renderer::add_view(new View('content', __DIR__ . '/view.php', []));
		Renderer::set_var_on_view('root', 'title', 'LoginLogin');
	}

	private function handle_post()
	{
		Renderer::add_view(new View('content', __DIR__ . '/view.php', []));
		Renderer::set_var_on_view('root', 'title', 'LoginLogin');

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

	public function handle(): void
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->handle_post();
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->handle_get();
		}
	}
}
