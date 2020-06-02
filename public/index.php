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
        break;
    case 'logout':
        if (isset($_SESSION['userId'])) {
            unset($_SESSION['userId']);
        }
        header('Location: ?action=display');
        break;

    case 'login':
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $users = $userRepo->findBy(array("nickname" => $_POST['username'], "password" => $_POST['password']));
            if (count($users) == 1) {
                $_SESSION['userId'] = $users[0]->id;
                header('Location: ?action=display');
            } else {
                $errorMsg = "Wrong login and/or password.";
                include "../templates/LoginForm.php";
            }
        } else {
            include "../templates/LoginForm.php";
        }
        break;
    case 'new':
        break;
    case 'display':
    default:

        //$item = $postRepo->find(1);
        //$item->title = "Nouveau titre";
        //$manager->persist($item);
        //$manager->flush();

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
        // $userToup = new User();
        // $userToup->id = 1;
        // $userToup->nickname = "Toupi";
        // $userToup->password = "touplegroschat";

        // $newPost = new Post();
        // $newPost->id = 1;
        // $newPost->title = "Créations Pastel Goth";
        // $newPost->category = "Bijoux";
        // $newPost->url_image = "https://scontent-cdg2-1.xx.fbcdn.net/v/t1.0-9/60343475_2194603813919786_4834139786484645888_o.jpg?_nc_cat=111&_nc_sid=8024bb&_nc_ohc=HIdb_qIKitkAX-Gg5BP&_nc_ht=scontent-cdg2-1.xx&oh=3a33aaf34ce10168552314e24bdb64cd&oe=5EC58970";
        // $newPost->user = $userToup;

        // $userNep = new User();
        // $userNep->id = 2;
        // $userNep->nickname = "Nep";
        // $userNep->password = "peplepetitchat";

        // $newPost2 = new Post();
        // $newPost2->id = 2;
        // $newPost2->title = "Noeuds Pastel Goth";
        // $newPost2->category = "Noeuds";
        // $newPost2->url_image = "https://scontent-cdg2-1.xx.fbcdn.net/v/t1.0-9/58420436_2173625492684285_4126845508482236416_n.jpg?_nc_cat=110&_nc_sid=8024bb&_nc_ohc=k-2OYqbBylUAX9t-nGf&_nc_ht=scontent-cdg2-1.xx&oh=28e6333f64af8e6242abaf88b110c8e9&oe=5EC7321C";
        // $newPost2->user = $userNep;

        // $items = array($newPost, $newPost2);

        include "../templates/display.php";
        break;
}
