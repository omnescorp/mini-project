<?php

namespace MRusso\LibBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use MRusso\LibBundle\Service\DB;

class Post extends DB {

    protected $entity = 'MRusso\LibBundle\Entity\Post';
    
    public function getAllFront() {
        $query = $this->em->createQueryBuilder();

        $query
                ->select('post')
                ->from($this->entity, 'post')
                ->where('post.postStatus = 0')
                ->orderBy('post.postDate', 'desc')
        ;
//        echo $query->getQuery()->getSql();die;
//	return $this->getOne($query);
        return $this->OrmPaginator($query);
    }

}
