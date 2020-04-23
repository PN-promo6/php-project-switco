<?php

namespace Entity;

use Entity\User;

class Post
{
    public $id;
    public $title;
    public $category;
    public $url_image;
    public User $user;

    // public function __construct($id, $title, $category, $url_image, User $user)
    // {
    //     $this->id = $id;
    //     $this->title = $title;
    //     $this->category = $category;
    //     $this->url_image = $url_image;
    //     $this->user = $user;
    // }
}
