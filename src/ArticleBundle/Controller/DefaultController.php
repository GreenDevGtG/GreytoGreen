<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ArticleBundle\Entity\Article;
use ArticleBundle\Entity\Categorie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="article_homepage")
     */
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getRepository('ArticleBundle:Categorie');
        $categorie = $repo->find(16);
        $astuces = $categorie->getArticles();

        return $this->render('default/index.html.twig',[
            'astuces' => $astuces,
        ]);
    }

    
}
