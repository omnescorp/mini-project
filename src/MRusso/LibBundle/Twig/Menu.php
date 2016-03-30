<?php

namespace MRusso\LibBundle\Twig;

use Symfony\Component\HttpFoundation\RequestStack;

class Menu extends \Twig_Extension {

    private $container;

    public function __construct($container, RequestStack $request_stack) {
        $this->container = $container;
        $this->routes = $container->get('routes');
        $this->route = $this->routes->noPaginator()->getAllRoute();
        $this->request_stack = $request_stack;
        $this->request = $request_stack->getCurrentRequest();
    }

    protected function getRequest() {
        $this->request = $this->request_stack->getCurrentRequest();
        return $this->request;
    }

    public function menu() {
//        echo '<ul class="nav navbar-nav">';

        echo $this->menu_recursive($this->route);
//        echo '</ul>';
        //echo $this->container->get('twig.extension.routing')->path('OwnCoreBundle:Blog:ahora');
        //die;
    }

    private function isActive($menu) {
        $route = $this->getRequest()->get('_route');
        if ($route == $menu->getRoutController()) {
            return true;
        }
        foreach ($menu->hijo as $page) {
            if ($route == $page->getRoutController()) {
                return true;
            }
        }
        return false;
    }

    private function menu_recursive($menu) {
        $route = $this->getRequest()->get('_route');
        $html = '';
        $active = ' active ';
        $in = ' in ';
        ?>
        <div id="accordion" class="panel-group " role="tablist" aria-multiselectable="true">
            <?php
            foreach ($menu as $item):
                if ($this->container->get('security.authorization_checker')->isGranted('EDIT', $item) && $item->getRoutVisible() == 1) :
                    if ($this->isActive($item)) {
                        $active = ' active ';
                        $in = ' in ';
                    } else {
                        $active = ' ';
                        $in = ' ';
                    }
                    if (count($item->hijo) == 0) {
                        ?>
                        <div class="panel panel-default <?php echo $in; ?>">
                            <div class="panel-heading" role="tab" id="heading_<?php echo ($item->getId()); ?>">
                                <a href='<?php echo $this->container->get('router')->generate($item->getRoutController()); ?>' title='<?php echo $this->container->get('translate_ddbb')->translate($item->getRoutLabel()); ?>'><?php echo $this->container->get('translate_ddbb')->translate($item->getRoutLabel()); ?></a>
                            </div>
                        </div>
                    <?php } else {
                        ?>

                        <div class="panel panel-default <?php echo $in; ?>">
                            <div id="heading_<?php echo ($item->getId()); ?>" class="panel-heading" role="tab">
                                <a href="#collapse_<?php echo ($item->getId()); ?>" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapse_<?php echo ($item->getId()); ?>" title='<?php echo $this->container->get('translate_ddbb')->translate($item->getRoutLabel()); ?>'><?php echo $this->container->get('translate_ddbb')->translate($item->getRoutLabel()); ?></a>
                            </div>
                            <div id="collapse_<?php echo ($item->getId()); ?>" class="panel-collapse collapse <?php echo $in; ?>" role="tabpanel" aria-labelledby="heading_<?php echo ($item->getId()); ?>">
                                <div class="panel-body">
                                    <ul role="menu">
                                        <li class="<?php echo $active; ?>" title='<?php echo $this->container->get('translate_ddbb')->translate($item->getRoutLabel()); ?>'>
                                            <a href='<?php echo $this->container->get('router')->generate($item->getRoutController()); ?>' title='<?php echo $this->container->get('translate_ddbb')->translate($item->getRoutLabel()); ?>'><?php echo $this->container->get('translate_ddbb')->translate($item->getRoutLabel()); ?></a>
                                        </li>
                                        <?php
                                        foreach ($item->hijo as $page):

                                            if ($this->isActive($page)) {
                                                $active = ' active ';
                                            } else {
                                                $active = ' ';
                                            }
                                            if ($this->container->get('security.authorization_checker')->isGranted('EDIT', $page) && $page->getRoutVisible()):
                                                ?>
                                                <li class="<?php echo $active; ?>" title='<?php echo $this->container->get('translate_ddbb')->translate($page->getRoutLabel()); ?>'>
                                                    <a href='<?php echo $this->container->get('router')->generate($page->getRoutController()); ?>' title='<?php echo $this->container->get('translate_ddbb')->translate($page->getRoutLabel()); ?>'><?php echo $this->container->get('translate_ddbb')->translate($page->getRoutLabel()); ?></a>
                                                </li>
                                                <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    $active = '';
                endif;
            endforeach;
            ?>
            <div class="panel panel-default ">
                <div class="panel-heading" role="tab" id="heading_last">
                    <a href='<?php echo $this->container->get('router')->generate('logout'); ?>' title='<?php echo $this->container->get('translator')->trans('Salir'); ?>'><?php echo $this->container->get('translator')->trans('Salir'); ?></a>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('menu', array($this, 'menu')),
        );
    }

    public function getName() {
        return 'menu';
    }

}
