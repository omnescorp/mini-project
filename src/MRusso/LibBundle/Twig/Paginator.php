<?php

namespace MRusso\LibBundle\Twig;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\HttpFoundation\RequestStack;

class Paginator extends \Twig_Extension {

    protected $router;
    protected $paginator;

    public function __construct($router, RequestStack $request_stack, $container) {
        $this->router = $router;
        $this->request_stack = $request_stack;
        $this->request = $request_stack->getCurrentRequest();
        $this->container = $container;
    }

    public function setPaginator($paginator) {
        $this->paginator = $paginator;
    }

    protected function getRequest() {
        $this->request = $this->request_stack->getCurrentRequest();
        return $this->request;
    }

    public function getName() {
        return 'paginator';
    }

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('paginator', array($this, 'pagi')),
        );
    }

    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('paginator', array($this, 'pagi')),
        );
    }

    public function pagi($paginator = null, $route = null, $params = array()) {

        $paginator = $this->paginator;
        //print_r($paginator);
        // Array ( [limit] => 10 [max_page] => 4 [page] => 1 ) nada
//echo ;
        if (!$route) {
            $route = $this->getRequest()->get('_route');
        }
        if (is_array($this->getRequest()->get('_route_params'))) {
            $params = array_merge($params, $this->getRequest()->get('_route_params'));
        }
        $page = $paginator['current_page_number'];
        $max_page = $paginator['count_page'];
        $lower_range = $paginator['lower_range'];
        $upper_range = $paginator['upper_range'];
        if ($max_page < 2) {
            return;
        }
        $query_string = '';
        if ($query_string = $this->getRequest()->getQueryString()) {
            $query_string = '?' . $this->getRequest()->getQueryString();
        }
        $html = '<div class="hidden-md hidden-lg">';
        $html .= '<ul  class="pagination">';
        $html .= '<li ' . ($page == 1 ? 'class="disabled"' : '') . '>';
        $html .='<a href="' . $this->router->generate($route, array_merge($params, array('page' => ($page - 1 < 1 ? 1 : $page - 1)))) . $query_string . '">' . $this->container->get('translator')->trans('Anterior') . '</a>';
        $html .= '</li>';
        $html .= '<li ' . ($page == $max_page ? 'class="disabled"' : '') . '>';
        $html .='<a href="' . $this->router->generate($route, array_merge($params, array('page' => ($page + 1 <= $max_page ? $page + 1 : $page)))) . $query_string . '">' . $this->container->get('translator')->trans('Siguiente') . '</a>';
        $html .= '</li>';
        $html .= '</ul>';
        $html .= '</div>';
        $html .= '<div class="hidden-sm hidden-xs">';
        $html .= '<ul  class="pagination">';
        $html .= '<li ' . ($page == 1 ? 'class="disabled"' : '') . '>';

        $html .='<a href="' . $this->router->generate($route, array_merge($params, array('page' => 1))) . $query_string . '">&laquo;</a>';
        $html .='<a href="' . $this->router->generate($route, array_merge($params, array('page' => ($page - 1 < 1 ? 1 : $page - 1)))) . $query_string . '"><</a>';
        $html .= '</li>';

        for ($i = $lower_range; $i <= $upper_range; $i++) {
            $html .= '<li ' . ($page == $i ? 'class="active"' : '') . '>';
            $html .='<a href="' . $this->router->generate($route, array_merge($params, array('page' => $i))) . $query_string . '">' . $i . '</a>';
            $html .= '</li>';
        }
        /*
          {% for i in 1..blogs.view.max_page %}
          <li {{ blogs.view.page == i ? 'class="active"' }}>
          <a href="{{ path('_welcome', {page: i}) }}">{{ i }}</a>
          </li>
          {% endfor %}
         */
        $html .= '<li ' . ($page == $max_page ? 'class="disabled"' : '') . '>';
        $html .='<a href="' . $this->router->generate($route, array_merge($params, array('page' => ($page + 1 <= $max_page ? $page + 1 : $page)))) . $query_string . '">></a>';
        $html .='<a href="' . $this->router->generate($route, array_merge($params, array('page' => $max_page))) . $query_string . '">&raquo;</a>';

        $html .= '</li>';
        $html .= '</ul>';
        $html .= '</div>';
        echo $html;
    }

}
