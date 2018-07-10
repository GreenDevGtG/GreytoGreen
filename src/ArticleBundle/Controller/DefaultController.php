<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="article_homepage")
     */
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Categorie');
        $categorie = $repo->find(16);
        $astuces = $categorie->getArticle();

        return $this->render('@Article/Default/index.html.twig',[
            'astuces' => $astuces,
        ]);
    }
}
