<?php

namespace MRusso\MiniProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller {

    public function indexAction() {
        return $this->render('MRussoMiniProjectBundle:index:index.html.twig',array(
            'posts'=>$this->get('post')->findAll(),
        ));
    }

}
