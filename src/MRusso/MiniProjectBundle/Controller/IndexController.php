<?php

namespace MRusso\MiniProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IndexController extends Controller {

    public function indexAction(Request $request) {
        if ($request->getMethod() == 'POST' && $request->files->get('media_file')) {
            if ($this->get('post')->create()) {
                $this->addFlash('success', 'Post Created');
            } else {
                $this->addFlash('error', 'An error occurred');
            }
            return $this->redirectToRoute('_homepage');
        }

        return $this->render('MRussoMiniProjectBundle:index:index.html.twig', array(
                    'posts' => $this->get('post')->getAllFront(),
        ));
    }

    public function viewAction() {
        if (!$post = $this->get('post')->findAndUpdate()) {
            throw new NotFoundHttpException('No post');
        }
        return $this->render('MRussoMiniProjectBundle:index:view.html.twig', array(
                    'post' => $post
        ));
    }

}
