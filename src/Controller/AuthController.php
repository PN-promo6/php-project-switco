<?php

namespace Controller;

use Entity\User;
use ludk\Http\Request;
use ludk\Http\Response;
use ludk\Controller\AbstractController;

class AuthController extends AbstractController
{
    public function login(Request $request): Response
    {

        $userRepo = $this->getOrm()->getRepository(User::class);

        if ($request->request->has('username') && $request->request->has('password')) {
            $usersWithThisLogin = $userRepo->findBy(array("nickname" => $request->request->get('username')));

            if (count($usersWithThisLogin) == 1) {
                $firstUserWithThisLogin = $usersWithThisLogin[0];
                if ($firstUserWithThisLogin->password != md5($request->request->get('password'))) {
                    $errorMsg = "Wrong password.";
                    $data = array(
                        'errorMsg' => $errorMsg
                    );
                    return $this->render('loginForm.php', $data);
                } else {
                    $request->getSession()->set('user', $usersWithThisLogin[0]);
                    return $this->redirectToRoute('display');
                }
            } else {
                $errorMsg = "Nickname doesn't exist.";
                $data = array(
                    'errorMsg' => $errorMsg
                );
                return $this->render('loginForm.php', $data);
            }
        } else {
            return $this->render('loginForm.php');
        }
    }

    public function logout(Request $request): Response
    {
        if ($request->getSession()->has('user')) {
            $request->getSession()->remove('user');
        }
        return $this->redirectToRoute('display');
    }
}
