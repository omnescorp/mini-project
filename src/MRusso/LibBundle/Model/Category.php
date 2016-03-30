<?php

namespace MRusso\LibBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use MRusso\LibBundle\Service\DB;

class Category extends DB {

    protected $entity = 'MRusso\LibBundle\Entity\Category';

    public function getAllAndBlog() {
        if ($this->request->get('id')) {
            $query = 'SELECT * FROM category left JOIN post_category on category.id = post_category.cate_id and post_category.post_id = ' . $this->request->get('id') . ';';
        } else {
            $query = 'SELECT * FROM category ;';
        }
        return $this->execute($query);
    }

    public function getCategoryCloud() {
        $query = "select count(*) as score, category.id, category.cate_description "
                . "from post_category "
                . "inner join category on post_category.cate_id = category.id "
                . "group by post_category.cate_id order by cate_description ";
        return $this->execute($query);
    }

}
