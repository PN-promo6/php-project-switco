<?php

namespace Controller;

use Entity\Post;
use Entity\User;
use ludk\Http\Request;
use ludk\Http\Response;
use ludk\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function display(Request $request): Response
    {
        $postRepo = $this->getOrm()->getRepository(Post::class);
        $userRepo = $this->getOrm()->getRepository(User::class);

        $items = array();
        if ($request->query->has('search')) {
            $search = $request->query->get('search');
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
        $data = array(
            'items' => $items
        );
        return $this->render('display.php', $data);
    }
}
