<?php

namespace MapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/map", name="map_homepage")
     */
    public function indexAction()
    {
        return $this->render('@Map/Default/map.html.twig');
    }
}
