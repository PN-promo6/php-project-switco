<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;500&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/pages.css">

    <title>Inscrivez-vous gratuitement sur Creepy Cute !</title>
</head>

<body id="bootstrap-overrides-bg">

    <!-- NAVBAR -->
    <div class="mb-5 bg-white shadow-sm">
        <div class="container p-0">

            <nav class="navbar navbar-expand-lg navbar-light px-sm-0">
                <a class="navbar-brand font-weight-bold" href="/">🦇 CREEPY CUTE 🦇</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
        </div>
    </div>
    <!-- FORM-->
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto mt-5">
                <form class="form-group" method="POST" action="/register">
                    <h2 class="mt-5 mb-4"> 🦇 Registration</h2>
                    <?php
                    if (isset($errorMsg)) {
                        echo "<div class='alert alert-warning' role='alert'>$errorMsg</div>";
                    }
                    ?>
                    <input type="text" class="form-control mb-4" name="username" placeholder="Nickname (4 characters)" required="" autofocus="" />
                    <input type="password" class="form-control mb-4" name="password" placeholder="Password (8 characters)" required="" />
                    <label>Retype password:</label>
                    <input type="password" class="form-control mb-4" name="passwordRetype" placeholder="Password" required="" />
                    <button class="btn btn-dark btn-block" type="submit">Register</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>