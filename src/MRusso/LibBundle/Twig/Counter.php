<?php

namespace MRusso\LibBundle\Twig;

use Symfony\Component\Templating\Helper\Helper;

class Counter extends \Twig_Extension {

    protected $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function getName() {
        return 'counter';
    }

    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('count', array($this, 'count')),
            new \Twig_SimpleFunction('view', array($this, 'view')),
        );
    }

    public function count() {
        echo ( $this->container->get('post')->getCountAll()[0]['total']);
        return;
    }

    public function view($post_id = null) {
        echo ( $this->container->get('post')->getCountView($post_id)[0]['total']);
        return;
    }

}
