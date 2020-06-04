<?php

use Entity\Post;
use Entity\User;
use ludk\Persistence\ORM;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$orm = new ORM(__DIR__ . '/../Resources');
$manager = $orm->getManager();
$postRepo = $orm->getRepository(Post::class);
$userRepo = $orm->getRepository(User::class);

$action = $_GET["action"] ?? "display";
switch ($action) {

    case 'register':
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordRetype'])) {
            $isUserAvailable = $userRepo->findBy(array("nickname" => $_POST['username']));
            $errorMsg = NULL;
            if (count($isUserAvailable) > 0) {
                $errorMsg = "Nickname already used.";
            } else if ($_POST['password'] != $_POST['passwordRetype']) {
                $errorMsg = "Passwords are not the same.";
            } else if (strlen(trim($_POST['password'])) < 8) {
                $errorMsg = "Your password should have at least 8 characters.";
            } else if (strlen(trim($_POST['username'])) < 4) {
                $errorMsg = "Your nickame should have at least 4 characters.";
            }
            if ($errorMsg) {
                include "../templates/registerForm.php";
            } else {
                $newUser = new User();
                $newUser->nickname = $_POST['username'];
                $newUser->password = md5($_POST['password']);
                $newUser->mail = '';
                $manager->persist($newUser);
                $manager->flush();
                $_SESSION['userId'] = $userId;
                header('Location: ?action=display');
            }
        } else {
            include "../templates/registerForm.php";
        }
        break;

    case 'logout':
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        header('Location: ?action=display');
        break;

    case 'login':
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $usersWithThisLogin = $userRepo->findBy(array("nickname" => $_POST['username']));
            if (count($usersWithThisLogin) == 1) {
                $firstUserWithThisLogin = $usersWithThisLogin[0];
                if ($firstUserWithThisLogin->password != md5($_POST['password'])) {
                    $errorMsg = "Wrong password.";
                    include "../templates/loginForm.php";
                } else {
                    $_SESSION['user'] = $usersWithThisLogin[0];
                    header('Location:/?action=display');
                }
            } else {
                $errorMsg = "Nickname doesn't exist.";
                include "../templates/loginForm.php";
            }
        } else {
            include "../templates/loginForm.php";
        }

        break;

    case 'new':
        if (isset($_POST['title']) && isset($_POST['category']) && isset($_POST['url_image'])) {
            $errorMsg = NULL;
            if (empty($_POST['title'])) {
                $errorMsg = "Title is empty !";
            } else if (empty($_POST['category'])) {
                $errorMsg = "Category is empty !";
            } else if (empty($_POST['url_image'])) {
                $errorMsg = "Image field is empty !";
            }
            if ($errorMsg) {
                include "../templates/addForm.php";
            } else {
                $newPost = new Post();
                $newPost->title = $_POST['title'];
                $newPost->category = $_POST['category'];
                $newPost->url_image = $_POST['url_image'];
                $newPost->user = $_SESSION['user'];
                $manager->persist($newPost);
                $manager->flush();
                // $_SESSION['userId'] = $userId;
                header('Location: ?action=display');
            }
        } else {
            include "../templates/addForm.php";
        }
        break;

    case 'display':
    default:

        $items = array();
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            if (strpos($search, "@") === 0) {
                $nickname = substr($search, 1); // récupère le nickname en enlevant le premier caractère (ici le @)
                $users = $userRepo->findBy(array("nickname" => $nickname));
                if (count($users) == 1) {
                    $user = $users[0];
                    $items = $postRepo->findBy(array("user" => $user->id));
                }
            } else {
                $items = $postRepo->findBy(array("category" => $search));
            }
        } else {
            $items = $postRepo->findAll();
        }

        include "../templates/display.php";
        break;
}
