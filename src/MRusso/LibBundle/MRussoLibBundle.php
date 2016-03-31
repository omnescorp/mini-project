<?php

namespace MRusso\LibBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use MRusso\LibBundle\DependencyInjection\Compiler\OverrideRoutingCompilerPass;

class MRussoLibBundle extends Bundle {

    public function build(ContainerBuilder $container) {
        parent::build($container);
    }

}
