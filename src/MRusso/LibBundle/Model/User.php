<?php

namespace MRusso\LibBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use MRusso\LibBundle\Service\DB;

class User extends DB {

    protected $entity = 'MRusso\LibBundle\Entity\User';
    private $username;
    private $password;
    private $salt;
    private $roles;

    public function login() {
        if ($user = $this->findOneBy(array('email' => $this->request->get('_username'), 'password' => md5($this->request->get('_password'))))) {
            return $this->getUser($user->getEmail());
        }
    }

    public function getUser($email = null) {
        $session = new Session();

        if ($email) {
            $user = $this->findOneBy(array('email' => $email));
            $session->set('id', $user->getId());
            $session->set('time', time());
        }

        // Tiempo
        if ((time() - $session->get('time')) > (60 * 5)) {
            //Esto no borra la sesión.
//               $session->invalidate();
        } else {
            $session->set('time', time());
        }

        if (!$id = $session->get('id')) {

            return $this->login();
//            $user = $this->findOneBy(array('userEmail' => 'invitado'));
//
//
//            $session->set('id', $user->getId());
//            $session->set('time', time());
            //$token = new UsernamePasswordToken('admin', null, 'test_area');
            //$this->request->get('security.context')->setToken($token);
        }
        $user = $this->find($id);

        return $user;
    }

    public function update() {
        $user = $this->find($this->request->get('id'));
        $user
                ->setName($this->request->get('name'))
                ->setSurname($this->request->get('surname'))
                ->setActive($this->request->get('is_active'))

        ;
        $this->em->persist($user);
        $this->em->flush();
        return true;
    }

}
