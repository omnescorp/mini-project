<?php

namespace MRusso\LibBundle\Service;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 *
 */
class ExceptionListener {

    private $templating;
    private $container;

    public function __construct(EngineInterface $templating, $container) {

        $this->templating = $templating;
        $this->container = $container;
    }

    /**
     * Intercepta excepciones para mostrar las páginas de error apropiadas
     * @param \Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event) {

        if ('dev' == $this->container->getParameter('kernel.environment')) {
            return;
        }

        /**
         * Respuesta vacía por defecto
         */
        $response = new Response('Respuesta vac&iacute;a desde exceptionListener::onKernelException');
//echo $event->getException();
        if ($event->getException() instanceof NotFoundHttpException) {
            //if (file_exists($this->page404)) {
            $response = new Response($this->getErrorPageData($event, 404));
            //}
        } elseif ($event->getException() instanceof AccessDeniedHttpException) {
            $response = new Response($this->getErrorPageData($event, 403));
        } else {
            //if (file_exists($this->page500)) {
            $response = new Response($this->getErrorPageData($event, 500));
            //}
        }
        $event->setResponse($response);
        $event->stopPropagation();
    }

    private function getErrorPageData($event, $error_code) {

        return $this->templating->render(
                        'MRussoMiniProjectBundle::layouts/partials/error' . $error_code . '.html.twig',array('message'=>$event->getException()->getMessage()));
    }

}
