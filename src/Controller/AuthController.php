<?php

namespace Controller;

class AuthController
{
    public function login()
    {

        global $userRepo;

        if (isset($_POST['username']) && isset($_POST['password'])) {
            $usersWithThisLogin = $userRepo->findBy(array("nickname" => $_POST['username']));
            if (count($usersWithThisLogin) == 1) {
                $firstUserWithThisLogin = $usersWithThisLogin[0];
                if ($firstUserWithThisLogin->password != md5($_POST['password'])) {
                    $errorMsg = "Wrong password.";
                    include "../templates/loginForm.php";
                } else {
                    $_SESSION['user'] = $usersWithThisLogin[0];
                    header('Location:/display');
                }
            } else {
                $errorMsg = "Nickname doesn't exist.";
                include "../templates/loginForm.php";
            }
        } else {
            include "../templates/loginForm.php";
        }
    }

    public function logout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        header('Location:/display');
    }
}
