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
                <a class="navbar-brand font-weight-bold" href="?">🦇 CREEPY CUTE 🦇</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <form class="form-inline my-2 my-lg-0 d-flex justify-content-center">
                                <input class="form-control" name="search" type="search" placeholder="Search" aria-label="Search">
                            </form>
                        </li>
                        <?php
                        if (isset($_SESSION['user'])) {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/?action=logout" role="button">Logout</a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/?action=login" role="button">LOG IN<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-dark btn-custom" href="/?action=register" role="button">SIGN UP</a>
                            </li>
                        <?php
                        }
                        ?>
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

            <?php
            if (isset($_SESSION['user'])) {
            ?>
                <div class="row">
                    <div class="col-md-6 offset-md-3 mb-5">
                        <a href="/?action=new" class="btn btn-dark btn-block"> Add new post</a>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="row">
                    <div class="col text-center">
                        <h2>You want to add your own post ?</h2>
                        <p class="text-muted">Create an account or log in !</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 offset-md-3 mb-5">
                        <a href="/?action=login" class="btn btn-outline-secondary btn-block"> Login</a>
                    </div>
                    <div class="col-md-3 mb-5">
                        <a href="/?action=register" class="btn btn-dark btn-block">Create</a>
                    </div>
                <?php } ?>

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
                                    <a href="/?search=@<?php echo $item->user->nickname; ?>" class="card-text"><small class="text-muted">@<?php echo $item->user->nickname; ?></small></a>
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