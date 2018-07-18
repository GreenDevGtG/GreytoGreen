<?php

namespace ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
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
        $repo = $this->getDoctrine()->getRepository('ArticleBundle:Categorie');
        $categorie = $repo->find(16);
        $astuces = $categorie->getArticles();

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
            $article = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);

            $em->flush();

            $this->addFlash('success', 'Astuce ajoutée');
            return $this->redirectToRoute('astuce_homepage');
        }

        return $this->render('@Article/Astuce/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/update/{id}", name="astuce_update", requirements={"id"="\d+"})
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

            return $this->redirectToRoute('astuce_homepage');
        }
        //\Symfony\Component\VarDumper\VarDumper::dump($form->getData());
        //echo $form->getErrors();
        return $this->render('@Article/Astuce/update.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
