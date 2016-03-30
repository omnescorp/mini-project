<?php

namespace MRusso\LibBundle\Twig;

use Symfony\Component\Templating\Helper\Helper;

class Params extends \Twig_Extension implements \Twig_Extension_GlobalsInterface {

    public function __construct($container) {
        $this->container = $container;
    }

    public function getName() {
        return 'params';
    }

    public function getGlobals() {
        return array(
            'language' => $this->container->getParameter('language')
        );
    }

}
