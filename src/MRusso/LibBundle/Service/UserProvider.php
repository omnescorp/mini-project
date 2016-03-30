<?php

namespace MRusso\LibBundle\Service;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;

class UserProvider implements UserProviderInterface {

    protected $container;

    public function setContainer($service_container) {
        $this->service_container = $this->container = $service_container;
        return $this;
    }

    public function loadUserByUsername($username) {
        if ($user = $this->container->get('mrusso.user')->getUser()) {

            return new \MRusso\LibBundle\Service\UserInterface($user->getName().' '.$user->getSurname(), $user->getPassword(), null, $user->getRole());
        }
        //if ($username=='abc') {
//        $roles = array('ROLE_ADMIN', 'ROLE_USER');
//        $user = new \MRusso\LibBundle\Model\User($username, $password, $salt, $roles);
        //}

        throw new UsernameNotFoundException(
        sprintf('Usuario "%s" does not exist aquí ni allá.', $username)
        );
    }

    public function refreshUser(UserInterface $user) {
        if (!$user instanceof \MRusso\LibBundle\Service\UserInterface) {
            throw new UnsupportedUserException(
            sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class) {
        return $class === 'MRusso\LibBundle\Service\UserInterface';
    }

}
