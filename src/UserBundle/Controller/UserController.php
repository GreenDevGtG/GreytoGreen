<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserController extends Controller
{
    /**
     * @Route("/user", name="myProfil")
     */
    public function userAction()
    {
        return $this->render('@User/User/user.html.twig', [

        ]);
    }

    /**
     * @Route("/login", name="signIn")
     */
    public function loginAction()
    {
        return $this->render('@User/User/login.html.twig', [

            ]);
    }

    /**
     * @Route("/registration", name="signUp")
     */
    public function registrationAction()
    {
        return $this->render('@User/User/registration.html.twig', [

            ]);
    }

}
