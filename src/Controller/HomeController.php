<?php

namespace Controller;

class HomeController
{
    public function display()
    {
        global $postRepo;
        global $userRepo;

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
    }
}
