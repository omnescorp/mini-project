<?php

namespace MRusso\LibBundle\Service;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AclLoader {

    public function onKernelRequest(GetResponseEvent $event) {

        $request = $event->getRequest();
        $ajaxcall = $request->isXMLHttpRequest();
//        $this->container->get('twig')->addGlobal('ajaxcall', $ajaxcall);;
        $route = $this->container->get('routes')->findOneBy(array('routController' => $request->get('_route')));
        if ($route) {
            if (false === $this->container->get('security.authorization_checker')->isGranted('EDIT', $route)) {
                throw new AccessDeniedException();
//                throw $this->createAccessDeniedException();
            }
        }
    }

    public function setContainer($container) {
        $this->container = $container;
    }

}
