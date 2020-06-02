<?php

namespace Entity;

use Entity\User;
use ludk\Utils\Serializer;

class Post
{
    public int $id;
    public string $title;
    public string $category;
    public string $url_image;
    public User $user;

    use Serializer;
}
