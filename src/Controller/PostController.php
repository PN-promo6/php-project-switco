<?php

namespace Controller;

use Entity\Post;

class PostController
{

    public function create()
    {
        global $manager;

        if (isset($_SESSION['user']) && isset($_POST['title']) && isset($_POST['category']) && isset($_POST['url_image'])) {
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
                header('Location: ?action=display');
            }
        } else {
            include "../templates/addForm.php";
        }
    }
}
