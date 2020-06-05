<?php

namespace Controller;

use Entity\User;

class RegisterController
{

    public function register()
    {

        global $userRepo;
        global $manager;

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
                $_SESSION['userId'] = $newUser;
                header('Location:/login');
            }
        } else {
            include "../templates/registerForm.php";
        }
    }
}
