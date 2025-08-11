<?php
require_once __root_dir . '/private/src/controller.php';
require_once __root_dir . '/private/src/render.php';

require_once __root_dir . '/private/config/routes.php';

class MainController
{
	public function handle(): void
	{
		$segmented_path = new SegmentedPath();
		$segment = $segmented_path->peek_cur_segment();

		$controller = null;
		switch ($segment) {
			case null:
			case 'index':
				$controller = new IndexController($segmented_path);
				break;
			case 'login':
				$controller = new LoginController($segmented_path);
				break;
			case 'register':
				$controller = new RegisterController($segmented_path);
				break;
			case 'users':
				$controller = new UsersController($segmented_path);
				break;
			case 'posts':
				$controller = new PostsController($segmented_path);
				break;
			case 'new_post':
				$controller = new NewPostController($segmented_path);
				break;
			case 'search':
				$controller = new SearchController($segmented_path);
				break;
			default:
				$controller = new E404Controller($segmented_path);
				break;
		}

		$this->add_default_layout();
		$controller->handle($segmented_path);
		Renderer::render();
	}

	private function add_default_layout(): void
	{

		Renderer::add_main_view(new View(
			'root',
			__view_dir . '/page/layout.php',
			null,
			['/assets/css/core.css', '/assets/css/form.css']
		));
		Renderer::add_view(new View(
			'nav',
			__view_dir . '/component/layout/nav.php',
			null,
			['/assets/css/nav_container.css']
		));
		Renderer::add_view(new View(
			'msgs',
			__view_dir . '/component/layout/msgs.php',
			null,
			['/assets/css/msgs_container.css']
		));
		Renderer::add_view(new View(
			'foot',
			__view_dir . '/component/layout/foot.php',
			null,
			['/assets/css/foot_container.css']
		));
	}
}
