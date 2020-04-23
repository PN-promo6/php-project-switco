<?php

use Entity\User;
use Entity\Post;

require __DIR__ . '/../vendor/autoload.php';

$userToup = new User();
$userToup->id = 1;
$userToup->nickname = "Toupi";
$userToup->password = "touplegroschat";

$newPost = new Post();
$newPost->id = 1;
$newPost->title = "Créations Pastel Goth";
$newPost->category = "Bijoux";
$newPost->url_image = "https://scontent-cdg2-1.xx.fbcdn.net/v/t1.0-9/60343475_2194603813919786_4834139786484645888_o.jpg?_nc_cat=111&_nc_sid=8024bb&_nc_ohc=HIdb_qIKitkAX-Gg5BP&_nc_ht=scontent-cdg2-1.xx&oh=3a33aaf34ce10168552314e24bdb64cd&oe=5EC58970";
$newPost->user = $userToup;

$userNep = new User();
$userNep->id = 2;
$userNep->nickname = "Nep";
$userNep->password = "peplepetitchat";

$newPost2 = new Post();
$newPost2->id = 2;
$newPost2->title = "Noeuds Pastel Goth";
$newPost2->category = "Noeuds";
$newPost2->url_image = "https://scontent-cdg2-1.xx.fbcdn.net/v/t1.0-9/58420436_2173625492684285_4126845508482236416_n.jpg?_nc_cat=110&_nc_sid=8024bb&_nc_ohc=k-2OYqbBylUAX9t-nGf&_nc_ht=scontent-cdg2-1.xx&oh=28e6333f64af8e6242abaf88b110c8e9&oe=5EC7321C";
$newPost2->user = $userNep;

$items = array($newPost, $newPost2);

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

    <title>Site name</title>
</head>

<body>

    <!-- NAVBAR -->
    <div class="sticky-top bg-white shadow-sm">
        <div class="container p-0">
            <nav class="navbar navbar-expand-lg py-4 pr-0">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="row">
                        <div class="col-lg-6"></div>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold pl-0" href="#">CREEPY CUTE</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 mr-auto"></div>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">LOG IN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-dark btn-custom" href="#">SIGN UP</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="">
        <!-- HEADER -->
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="title-font text-lilac">Enter our world of creepy cuteness</h1>
                    <p class="">Discover creations from people all around the world, sharing the same love for creepy
                        cute stuffs
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN -->
    <div class="bg-light-lilac py-5">
        <main class="container">
            <div class="row">
                <div class="col-lg-4 text-left pl-0 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="h4 font-weight-bold">
                                What's new
                            </h2>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 pr-0">
                    <?php

                    foreach ($items as $item) {
                    ?>
                        <div class="">
                            <div class="card mb-3">
                                <img src="<?php echo $item->url_image; ?>" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h3 class="card-title h5"><?php echo $item->title; ?></h3>
                                    <p class="card-text"><?php echo $item->category; ?></p>
                                    <p class="card-text"><small class="text-muted">@<?php echo $item->user->nickname; ?></small></p>
                                </div>
                            </div>
                        </div>
                    <?php
                    } ?>
                </div>

            </div>
        </main>
    </div>

    <!-- FOOTER -->

    <div class="sticky-top">
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