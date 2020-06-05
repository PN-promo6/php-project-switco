<?php

namespace Controller;

use Entity\Post;
use ludk\Http\Request;
use ludk\Http\Response;
use ludk\Controller\AbstractController;

class PostController extends AbstractController
{

    public function create(Request $request): Response
    {
        $manager = $this->getOrm()->getManager();

        if ($request->getSession()->has('user') && $request->request->has('title') && $request->request->has('category') && $request->request->has('url_image')) {
            $errorMsg = NULL;
            if (empty($request->request->get('title'))) {
                $errorMsg = "Title is empty !";
            } else if (empty($request->request->get('category'))) {
                $errorMsg = "Category is empty !";
            } else if (empty($request->request->get('url_image'))) {
                $errorMsg = "Image field is empty !";
            }
            if ($errorMsg) {
                $data = array(
                    'errorMsg' => $errorMsg
                );
                return $this->render('addForm.php', $data);
            } else {
                $newPost = new Post();
                $newPost->title = $request->request->get('title');
                $newPost->category = $request->request->get('category');
                $newPost->url_image = $request->request->get('url_image');
                $newPost->user = $request->getSession()->get('user');
                $manager->persist($newPost);
                $manager->flush();
                return $this->redirectToRoute('display');
            }
        } else {
            return $this->render('addForm.php');
        }
    }
}
