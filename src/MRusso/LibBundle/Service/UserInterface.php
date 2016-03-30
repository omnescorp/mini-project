<?php

namespace MRusso\LibBundle\Service;

use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

class UserInterface implements SymfonyUserInterface, EquatableInterface {

    private $username;
    private $password;
    private $salt;
    private $roles;
    private $time;
    private $time_out = 30;

    public function __construct($username, $password, $salt, $roles) {
        $this->username = $username;
        $this->password = $password;
        $this->salt = $salt;
        foreach ($roles as $rol) {
            $this->roles[] = 'ROLE_' . $rol->getId();
        }
        $this->time = time();
    }

    public function getRoles() {
        return $this->roles;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getUsername() {
        return $this->username;
    }

    public function eraseCredentials() {
        
    }

    public function isEqualTo(SymfonyUserInterface $user) {
        if (!$user instanceof UserInterface) {
            return false;
        }

        if ($this->password !== $user->getPassword()) {
            return false;
        }

        if ($this->salt !== $user->getSalt()) {
//            return false;
        }

        if ($this->username !== $user->getUsername()) {
            return false;
        }

        if ($this->time + $this->time_out > time()) {
//            return false;
        }

        return true;
    }

}
