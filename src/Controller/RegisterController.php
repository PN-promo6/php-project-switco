<?php

namespace Controller;

use Entity\User;
use ludk\Http\Request;
use ludk\Http\Response;
use ludk\Controller\AbstractController;

class RegisterController extends AbstractController
{

    public function register(Request $request): Response
    {

        $userRepo = $this->getOrm()->getRepository(User::class);
        $manager = $this->getOrm()->getManager();

        if ($request->request->has('username') && $request->request->has('password') && $request->request->has('passwordRetype')) {
            $isUserAvailable = $userRepo->findBy(array("nickname" => $request->request->get('username')));
            $errorMsg = NULL;
            if (count($isUserAvailable) > 0) {
                $errorMsg = "Nickname already used.";
            } else if ($request->request->get('password') != $request->request->get('passwordRetype')) {
                $errorMsg = "Passwords are not the same.";
            } else if (strlen(trim($request->request->get('password'))) < 8) {
                $errorMsg = "Your password should have at least 8 characters.";
            } else if (strlen(trim($request->request->get('username'))) < 4) {
                $errorMsg = "Your nickame should have at least 4 characters.";
            }
            if ($errorMsg) {
                $data = array(
                    'errorMsg' => $errorMsg
                );
                return $this->render('registerForm.php', $data);
            } else {
                $newUser = new User();
                $newUser->nickname = $request->request->get('username');
                $newUser->password = md5($request->request->get('password'));
                $newUser->mail = '';
                $manager->persist($newUser);
                $manager->flush();
                $request->getSession()->set('userId', $newUser);
                return $this->redirectToRoute('login');
            }
        } else {
            return $this->render('registerForm.php');
        }
    }
}
