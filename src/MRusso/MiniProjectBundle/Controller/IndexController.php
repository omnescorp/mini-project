<?php

namespace MRusso\MiniProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller {

    public function indexAction(Request $request) {
        if ($request->getMethod() == 'POST' && $request->files->get('media_file')) {
            $this->get('post')->create();
            $this->addFlash('success', 'Post Created');
//            return $this->redirectToRoute('MRussoGalerieBundle:Index:index');
        }
        
        return $this->render('MRussoMiniProjectBundle:index:index.html.twig', array(
                    'posts' => $this->get('post')->getAllFront(),
        ));
    }

}
