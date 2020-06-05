<?php

use Entity\Post;
use Entity\User;
use ludk\Persistence\ORM;
use Controller\AuthController;
use Controller\HomeController;
use Controller\PostController;
use Controller\RegisterController;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$orm = new ORM(__DIR__ . '/../Resources');
$manager = $orm->getManager();
$postRepo = $orm->getRepository(Post::class);
$userRepo = $orm->getRepository(User::class);

$action = substr(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), 1); // URI : voir cours php 4
switch ($action) {

    case 'register':
        $controller = new RegisterController();
        $controller->register();
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;

    case 'new':
        $controller = new PostController();
        $controller->create();
        break;

    case 'display':
    default:
        $controller = new HomeController();
        $controller->display();
        break;
}
