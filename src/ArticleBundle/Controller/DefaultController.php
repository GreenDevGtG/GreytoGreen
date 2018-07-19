<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
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
        $cats = $repo->findAll();

        return $this->render('default/index.html.twig',[
            'articles' => $astuces,
            'categories' => $cats

        ]);
    }

    
}
