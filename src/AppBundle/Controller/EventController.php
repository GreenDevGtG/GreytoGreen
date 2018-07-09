<?php


namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventController extends Controller
{
        /**
         * @Route("/events", name="event")
         * @return \Symfony\Component\HttpFoundation\Response
         */
        public function indexAction()
    {
                return $this->render('@App/Event/index.html.twig');
    }
}