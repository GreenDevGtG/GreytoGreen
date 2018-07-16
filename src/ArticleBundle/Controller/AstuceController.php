<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;



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

    /**
     * @Route("/add", name="astuce_add")
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm('ArticleBundle\Form\Type\ArticleType');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);

            $em->flush();

            $this->addFlash('success', 'Astuce Ajouté');
            return $this->redirectToRoute('astuce_homepage');
        }

        return $this->render('@Article/Astuce/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
