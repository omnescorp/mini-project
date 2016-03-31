<?php

namespace MRusso\MiniProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller {

    public function indexAction(Request $request) {
        if ($request->getMethod() == 'POST' && $request->files->get('media_file')) {
            if ($this->get('post')->create()) {
                $this->addFlash('success', 'Post Created');
            } else {
                $this->addFlash('error', 'An error occurred');
            }
//            return $this->redirectToRoute('_homepage');
//            return new RedirectResponse($this->generateUrl('_homepage'));
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

    public function exportCsvAction() {
        $filename = 'post.csv';

        $response = new Response();
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
        $response->headers->set('Accept-Ranges', 'bytes');

        $fh = @fopen('php://output', 'w');

        $delimiter = ';';
        $csv_headers = array();
        $array_fields = array();
        $csv_headers[] = "Id";
        $csv_headers[] = "Title";
        $csv_headers[] = "Image";

        fputcsv($fh, $csv_headers, $delimiter);

        foreach ($this->get('post')->findBy(array(), array('postDate' => 'DESC')) as $post) {
//            print_R($post);die;
            $data = array();
            $data[] = $post->getId();
            $data[] = utf8_decode($post->getPostTitle());
            $data[] = utf8_decode($post->getPostImage());

            fputcsv($fh, $data, $delimiter);
        }

        fclose($fh);

        return $response;
    }

}
