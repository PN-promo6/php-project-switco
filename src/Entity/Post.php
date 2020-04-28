<?php

namespace Entity;

use Entity\User;
use ludk\Utils\Serializer;

class Post
{
    public $id;
    public $title;
    public $category;
    public $url_image;
    public User $user;

    use Serializer;
}
