<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


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
        return $this->render('@Article/Default/evenement.html.twig',[
            'evenements' => $event,
        ]);
    }

    /**
     * @Route("/add", name="evenement_add")
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm('ArticleBundle\Form\Type\ArticleType');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);

            $em->flush();

            $this->addFlash('success', 'Evènement ajouté');
            return $this->redirectToRoute('evenement_homepage');
        }

        return $this->render('@Article/Evenement/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/update/{id}", name="evenement_update", requirements={"id"="\d+"})
     */
    public function updateAction($id, Request $request)
    {

        if (is_null($id)) {
            $postData = $request->get('article');
            $id = $postData['id'];
        }

        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('ArticleBundle:Article')->find($id);
        $form = $this->createForm('ArticleBundle\Form\Type\ArticleType', $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);

            $em->flush();

            return $this->redirectToRoute('evenement_homepage');
        }
        //\Symfony\Component\VarDumper\VarDumper::dump($form->getData());
        //echo $form->getErrors();
        return $this->render('@Article/Evenement/update.html.twig', array(
            'form' => $form->createView()
        ));
    }




}