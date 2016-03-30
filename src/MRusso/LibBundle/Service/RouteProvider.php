<?php

// src/Own/CoreBundle/Service/RouteProvider.php

namespace MRusso\LibBundle\Service;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route as SymfonyRoute;
use Symfony\Component\Routing\RouterInterface;
use Doctrine\Common\Cache\MemcachedCache;

class RouteProvider extends Loader {

    private $loaded = false;
    private $container;
    private $translator;
    private $routes;
    private $locale;

    public function __construct() {

        $this->routes = new RouteCollection();
    }

    public function load($resource, $type = null) {
        if (true === $this->loaded) {
            throw new \RuntimeException('Do not add the "extra" loader twice');
        }

        $memcached = $this->container->get('memcached');

        $cacheDriver = new MemcachedCache();
        $cacheDriver->setMemcached($memcached);


        if ($result = $cacheDriver->fetch('prueba1234')) {
            $this->loaded = true;
            return $result;
        }
        $this
                ->routeRoute()
                //->blogRoute()
                ->categoryRoute()
        ;

//        $cacheDriver->save('prueba123', $this->routes);
        $this->loaded = true;
        return $this->routes;
    }

    public function supports($resource, $type = null) {
        return 'from_db' === $type;
    }

    private function blogRoute() {
        $blogs = $this->container->get('blog')->getBlogForRoute();
        $locale = $this->getLocale();
        foreach ($blogs as $blog) {
            foreach ($locale as $local) {
                $this->translator->setLocale($local);
                //$path = '/' . $this->translator->trans('entrada') . '/' . \Own\CoreBundle\Model\Functions::sanitizeText($this->translator->trans($blog->getBlogTitle())) . '.html';
                $path = '/' . $this->translator->trans('entrada') . '/' . \Own\CoreBundle\Model\Functions::sanitizeText($blog['blog_title']) . '.html';

                $defaults = array(
                    '_controller' => 'OwnIndexBundle:Blog:post',
                    'slug' => $blog['id'],
                    '_locale' => $local,
                );
                $requirements = array(
                    'parameter' => '\d+',
                );
                $route = new SymfonyRoute($path, $defaults, $requirements);

                // add the new route to the route collection
                $routeName = 'post' . $blog['id'] . '.' . $local;
                $this->routes->add($routeName, $route);
            }
        }
        return $this;
    }

    private function categoryRoute() {
        $blogs = $this->container->get('category')->findAll();
        //TODO: Locale vars has to be getted from conf, or session, or something, but not like this.
        $locale = array('es', 'en');
        foreach ($blogs as $blog) {
            foreach ($locale as $local) {
                $this->translator->setLocale($local);
                $path = '/' . $this->translator->trans('categoria') . '/' . \MRusso\LibBundle\Model\Functions::sanitizeText($this->translator->trans($blog->getCateDescription())) . '/{page}';

                $defaults = array(
                    '_controller' => 'MRussoCmsBundle:Front:category',
                    'id' => $blog->getId(),
                    '_locale' => $local,
                    'page' => 1,
                );
                $requirements = array(
                    'parameter' => '\d+',
                );
                $route = new SymfonyRoute($path, $defaults, $requirements);

                // add the new route to the route collection
                $routeName = 'category_' . $blog->getId() . '.' . $local;
                $this->routes->add($routeName, $route);
            }
        }
        return $this;
    }

    private function routeRoute() {
        $routes = $this->container->get('routes')->findAll();
        $locale = $this->container->get('translate_ddbb')->getLocale();

        foreach ($locale as $local) {
            foreach ($routes as $route) {
                $this->translator->setLocale($local);
                //$path = '/' .  \Own\CoreBundle\Model\Functions::sanitizeText($this->translator->trans($route->getRoutPath()));
                $text = $route->getRoutPath();
                $path = '/' . $this->container->get('translate_ddbb')->translate($text, $local) . '/{page}';
                $defaults = array(
                    '_controller' => $route->getRoutController(),
                    '_locale' => $local,
                    'page' => 1,
                );
                $requirements = array(
                );
                $route_sy = new SymfonyRoute($path, $defaults, $requirements);

                // add the new route to the route collection
                $routeName = $route->getRoutController() . '.' . $local;
                $this->routes->add($routeName, $route_sy);
            }
        }
        return $this;
    }

    public function setContainer($container) {
        $this->container = $container;
    }

    public function setTranslator($translatorss) {
        $this->translator = $translatorss;
    }

}
