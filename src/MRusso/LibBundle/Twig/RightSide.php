<?php

namespace MRusso\LibBundle\Twig;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\HttpFoundation\RequestStack;

class RightSide extends \Twig_Extension {

    protected $router;
    protected $em;
    protected $request_stack;
    protected $request;
    protected $active_id;

    public function __construct($router, $container) {
        $this->router = $router;
        $this->container = $container;
        $this->translator = $container->get('translator');
        $this->active_id = null;
    }

    public function setRequest(RequestStack $request_stack) {
        $this->request_stack = $request_stack;
        $this->request = $request_stack->getCurrentRequest();
        return $this;
    }

    protected function getRequest() {
        $this->request = $this->request_stack->getCurrentRequest();
        return $this->request;
    }

    public function getName() {
        return 'right_side';
    }

    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('right_side', array($this, 'right')),
            new \Twig_SimpleFunction('left_side', array($this, 'left')),
        );
    }

    public function right() {
        $category = $this->container->get('category')->getCategoryCloud();
        if (!$category) {
            return;
        }
        $this->active_id = $this->getRequest()->get('id');

        $html = '';
        $html .= '<div class="well well-sm">
        <h3 class="">
' . $this->translator->trans('Categorías') . '
        </h3>
    ';

        $html .= '<div class="eldiv">';
        $max = $category[0]['score'];
        $min = $category[count($category) - 1]['score'];
        foreach ($category as $tag) {
            if ($max < $tag['score']) {
                $max = $tag['score'];
            }
            if ($min > $tag['score']) {
                $min = $tag['score'];
            }
        }
        if ($max > $min) {
            $total = $max - $min;
        } else {
            $total = $max;
        }
        $min = $max * 0.755;
        $valor = 20;
        foreach ($category as $tag) {
            $peso = round((($tag['score'] - $min) * $valor) / $total);
            $html .='<a href="' . $this->container->get('router')->generate('category_' . $tag['id']) . '" class="tag' . $peso . ' ' . (($tag['id'] == $this->active_id) ? 'label label-primary' : '') . '">' . $this->translator->trans($tag['cate_description']) . '</a> ';
        }

        $html .= '</div>';
        $html .= '</div>';

        echo $html;
        //print_r($paginator);
        // Array ( [limit] => 10 [max_page] => 4 [page] => 1 ) nada
//echo ;
        /*
         * 
         * 
          <a href="#" class="list-group-item active">Link</a>
          <a href="#" class="list-group-item">Link</a>

          <a href="#" class="list-group-item">Link</a>
          <a href="#" class="list-group-item">Link</a>
          <a href="#" class="list-group-item">Link</a>
          <a href="#" class="list-group-item">Link</a>
          <a href="#" class="list-group-item">Link</a>
          <a href="#" class="list-group-item">Link</a>
          <a href="#" class="list-group-item">Link</a>
          </div>
         * 
         * 
         */
    }

    public function left($texto = 'vacio') {
        $html = '<div class="list-group">';

        $html .='<a href="#" class="list-group-item active">' . $texto . '</a>';
        $html .='<a href="#" class="list-group-item">Link</a>';
        $html .='<a href="#" class="list-group-item">Link</a>';
        $html .= '</div>';
        echo $html;
        //print_r($paginator);
        // Array ( [limit] => 10 [max_page] => 4 [page] => 1 ) nada
//echo ;
        /*
         * 
         * 
          <a href="#" class="list-group-item active">Link</a>
          <a href="#" class="list-group-item">Link</a>

          <a href="#" class="list-group-item">Link</a>
          <a href="#" class="list-group-item">Link</a>
          <a href="#" class="list-group-item">Link</a>
          <a href="#" class="list-group-item">Link</a>
          <a href="#" class="list-group-item">Link</a>
          <a href="#" class="list-group-item">Link</a>
          <a href="#" class="list-group-item">Link</a>
          </div>
         * 
         * 
         */
    }

}
