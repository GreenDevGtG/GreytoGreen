<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * @Route("/evenement")
 */
class EvenementController extends Controller
{
    /**
     * @Route("/", name="evenement_homepage")
     */
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Categorie');
        $categorie = $repo->find(15);
        $event = $categorie->getArticle();

        return $this->render('@Article/Default/evenement.html.twig',[
            'evenements' => $event,
        ]);
    }
}