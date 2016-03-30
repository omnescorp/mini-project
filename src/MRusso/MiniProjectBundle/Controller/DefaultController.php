<?php

namespace MRusso\MiniProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MRussoMiniProjectBundle:Default:index.html.twig');
    }
}
