<?php

namespace MRusso\LibBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Alias;

class OverrideRoutingCompilerPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) {
        //$definition = $container->getDefinition('routing.loader');
        //$definition->setClass('Own\CoreBundle\Routing\Router');


        if (!$container->hasDefinition('route')) {
            return;
        }

        if ($container->hasAlias('router')) {
            // router is an alias.
            // Register a private alias for this service to inject it as the parent
            $container->setAlias('own.router.parent', new Alias((string) $container->getAlias('router'), false));
        } else {
            // router is a definition.
            // Register it again as a private service to inject it as the parent

            $definition = $container->getDefinition('router');
            $definition->setPublic(false);
            $definition->setClass('own.router.parent');
            //$container->setDefinition('own.router', $definition);
        }

        //No caché para las rutas
        $definition = $container->getDefinition('router.default');
        $argument = $definition->getArgument(2);
        $argument['cache_dir'] = null;
        $definition->replaceArgument(2, $argument);

        $container->setAlias('router', 'route');
    }

}
