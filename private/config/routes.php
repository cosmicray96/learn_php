<?php
require_once __root_dir . '/private/controller/index.php';
require_once __root_dir . '/private/controller/login.php';
require_once __root_dir . '/private/controller/register.php';
require_once __root_dir . '/private/controller/users.php';
require_once __root_dir . '/private/controller/posts.php';
require_once __root_dir . '/private/controller/search.php';
require_once __root_dir . '/private/controller/new_post.php';

return [
	'/' => fn() => new IndexController(),
	'/index' => fn() => new IndexController(),
	'/login' => fn() => new LoginController(),
	'/register' => fn() => new RegisterController(),
	'/new_post' => fn() => new NewPostController(),
	'/posts' => fn() => new PostsController(),
	'/users' => fn() => new UsersController(),
	'/search' => fn() => new SearchController(),
	'/scripts' => fn() => new ScriptsController(),
];
