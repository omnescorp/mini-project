<?php

namespace MRusso\LibBundle\Twig;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Templating\Helper\Helper;

class TranslateDDBB extends \Twig_Extension {

    public function setRequest(RequestStack $request_stack) {
        $this->request_stack = $request_stack;
        $this->request = $request_stack->getCurrentRequest();
        return $this;
    }

    protected function getRequest() {
        $this->request = $this->request_stack->getCurrentRequest();
        return $this->request;
    }

    public function setContainer($service_container) {
        $this->service_container = $this->container = $service_container;
        return $this;
    }

    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('translate_ddbb', array($this, 'translate')),
        );
    }

    public function translate($text, $local = NULL) {
        if (!$local) {
            $local = $this->getRequest()->getLocale();
        }
        preg_match('/\[' . $local . '\](?s:(.*))\[\/' . $local . '\]/', $text, $return);
        if (isset($return[1])) {
            $text = ($return[1]);
        }
        return $text;
    }

    public function toDDBB($content) {
        $return = "";
        if (is_array($content)) {
            foreach ($content as $key => $value) {
                $return .= '[' . $key . ']' . $value . '[/' . $key . ']';
            }
        }
        return $return;
    }

    public function date_to_mysql($date) {
        $mysql_date = str_replace("/", "-", $date);
        $mysql_date = strtotime($mysql_date);
        $mysql_date = date("Y-m-d H:i:s", $mysql_date);

        return $mysql_date;
    }

    public function getLocale() {
        return array('en', 'es');
    }

    public function getName() {
        return 'translate_ddbb';
    }

}
