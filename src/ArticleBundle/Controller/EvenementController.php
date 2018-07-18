<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;


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
        $repo = $this->getDoctrine()->getRepository('ArticleBundle:Categorie');
        $categorie = $repo->find(15);
        $event = $categorie->getArticles();
<<<<<<< HEAD
      

=======
       
>>>>>>> 54c3931adf2d8c2205c30ae5ca277dcaeba609fe
        return $this->render('@Article/Default/evenement.html.twig',[
            'evenements' => $event,
        ]);
    }
}