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
        // $repo = $this->getDoctrine()->getRepository('AppBundle:Categorie');
        // $categorie = $repo->find(15);
        // $event = $categorie->getArticle();
        $em = $this->getDoctrine()->getManager();
        $event=$em->createQueryBuilder()
                    ->select('a')
                    ->from('AppBundle:Evenement', 'e')
                    ->join('e.article','a')
                    ->where('a.categorie = :id')
                    ->setParameters('id',15)
                    ->getQuery()
                    ->getResult();

        return $this->render('@Article/Default/evenement.html.twig',[
            'evenements' => $event,
        ]);
    }
}