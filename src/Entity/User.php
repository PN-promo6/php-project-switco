<?php

namespace Entity;

use ludk\Utils\Serializer;

class User
{
    public $id;
    public $nickname;
    public $mail;
    public $password;

    use Serializer;
}
