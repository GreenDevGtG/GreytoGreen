<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * @Route("/astuce")
 */
class AstuceController extends Controller
{
    /**
     * @Route("/", name="astuce_homepage")
     */
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Categorie');
        $categorie = $repo->find(16);
        $astuces = $categorie->getArticle();

        return $this->render('@Article/Default/astuce.html.twig',[
            'astuces' => $astuces,
        ]);
    }
}
