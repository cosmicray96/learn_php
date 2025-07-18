<?php
require_once __DIR__ . '/../private/index/controller.php';
require_once __DIR__ . '/../private/login/controller.php';
require_once __DIR__ . '/../private/register/controller.php';
require_once __DIR__ . '/../private/new_post/controller.php';
require_once __DIR__ . '/../private/posts/controller.php';
require_once __DIR__ . '/../private/users/controller.php';
/*
require_once __DIR__ . '/../private/search/controller.php';
*/

return [
	'/' => fn() => new IndexController(),
	'/index' => fn() => new IndexController(),
	'/login' => fn() => new LoginController(),
	'/register' => fn() => new RegisterController(),
	'/new_post' => fn() => new NewPostController(),
	'/posts' => fn() => new PostsController(),
	'/users' => fn() => new UsersController(),
	'/search' => fn() => new SearchController(),
];
