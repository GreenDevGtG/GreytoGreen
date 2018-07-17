<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Route("/user", name="myProfil")
     */
    public function userAction()
    {
        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('UserBundle:Utilisateur');
        $utilisateur = $userRepository->findAll();
        $session = $this->get('session');

        return $this->render('@User/User/user.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    /**
     * @Route("/login", name="signIn")
     */
    public function loginAction()
    {
        $utilisateur = $this->getUtilisateur();

        return $this->render('@User/User/login.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    /**
     * @Route("/registration", name="signUp")
     */
    public function registrationAction(Request $request)
    {
        $form = $this->createForm('UserBundle\Form\Type\RegistrationType');
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateur = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush();

            $this->addFlash('success', 'Vous êtes enregistré');
            return $this->redirectToRoute('signIn');
        }

        return $this->render('@User/User/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
