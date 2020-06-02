<?php

use Entity\Post;
use Entity\User;
use ludk\Persistence\ORM;

require __DIR__ . '/../vendor/autoload.php';

session_start();

$orm = new ORM(__DIR__ . '/../Resources');
$postRepo = $orm->getRepository(Post::class);

//$manager = $orm->getManager();
//$item = $postRepo->find(1);
//$item->title = "Nouveau titre";
//$manager->persist($item);
//$manager->flush();

$items = array();
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    if (strpos($search, "@") === 0) {
        $userRepo = $orm->getRepository(User::class);
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

// use Entity\User;
// use Entity\Post;

// require __DIR__ . '/../vendor/autoload.php';

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

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;500&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5bb1d77498.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <title>Mon super site</title>
</head>

<body id="bootstrap-overrides-bg">

    <!-- NAVBAR -->
    <div class="sticky-top bg-white shadow-sm">
        <div class="container p-0">

            <nav class="navbar navbar-expand-lg navbar-light px-sm-0">
                <a class="navbar-brand font-weight-bold" href="?">CREEPY CUTE</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <form class="form-inline my-2 my-lg-0 d-flex justify-content-center">
                                <input class="form-control" name="search" type="search" aria-label="Search">
                                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">LOG IN<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-dark btn-custom" href="#">SIGN UP</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="bg-gradient py-5">
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="m-0 title-font text-white">Discover creepy cute creations from people all around the world</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN -->
    <div class="bg-light-lilac py-5">
        <main class="container">
            <div class="row justify-content-center">
                <?php
                $rowLimite = 0;
                foreach ($items as $item) {
                    if ($rowLimite % 3 == 0 && $rowLimite > 0) {
                        echo '</div><div class="row justify-content-center">';
                    }
                ?>
                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <img src="<?php echo $item->url_image; ?>" class="card-img-top" alt="Image du post">
                            <div class="card-body">
                                <h3 class="card-title h5"><?php echo $item->title; ?></h3>
                                <p class="card-text"><span class="badge badge-pill custom-badge-lilac"><?php echo $item->category; ?></span></p>
                                <a href="?search=@<?php echo $item->user->nickname; ?>" class="card-text"><small class="text-muted">@<?php echo $item->user->nickname; ?></small></a>
                            </div>

                        </div>
                    </div>
                <?php
                    $rowLimite++;
                } ?>
            </div>
        </main>
    </div>

    <!-- FOOTER -->

    <div class="">
        <div class="container p-0">
            <nav class="navbar navbar-expand-lg py-4">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="row">
                        <div class="col-lg-6"></div>
                        <ul class="navbar-nav">
                            <li class="nav-item footer-link-hover">
                                <a class="nav-link font-weight-bold pl-0" href="#">&copy; 2020 Switco</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 mr-auto"></div>
                    <ul class="navbar-nav">
                        <li class="nav-item footer-link-hover">
                            <a class="nav-link" href="#"></a>
                        </li>
                        <li class="nav-item footer-link-hover">
                            <a class="nav-link" href="#"></a>
                        </li>
                    </ul>
                </div>
        </div>
        </nav>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>