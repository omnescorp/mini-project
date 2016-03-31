<?php

namespace MRusso\LibBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use MRusso\LibBundle\Service\DB;

class RoPostle extends DB {

    protected $entity = 'MRusso\LibBundle\Entity\Post';

}
