<?php

namespace MRusso\LibBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use MRusso\LibBundle\Service\DB;

class Route extends DB {

    protected $entity = 'MRusso\LibBundle\Entity\Route';

    public function getAllRoute($father = 0) {
        //return $this->findBy(array('routFather'=>0));
        $query = $this->em->createQueryBuilder();

        $query
                ->select('route')
                ->from($this->entity, 'route')
                ->where('route.routFather = ' . $father)
//                ->andWhere('route.routVisible = 1')
                ->orderBy('route.routOrder', 'ASC')

        //->where('user.userAdmin = 0')

        ;
        //$this->crearTest();
        $route = $query->getQuery()->getResult();
        foreach ($route as $rou) {
            $rou->hijo = $this->getAllRoute($rou->getId());
        }
        return $this->OrmPaginator($query);
    }

    public function update() {
        $route = $this->find($this->request->get('id'));
        $route
                ->setRoutController($this->request->get('controller'))
                ->setRoutPath($this->container->get('translate_ddbb')->toDDBB($this->request->get('path')))
                ->setRoutVisible($this->request->get('visible'))
                ->setRoutLabel($this->container->get('translate_ddbb')->toDDBB($this->request->get('label')))
                ->setRoutTitle($this->container->get('translate_ddbb')->toDDBB($this->request->get('title')))
                ->setRoutOrder($this->request->get('order'))
        ;
        $this->em->persist($route);
        $this->em->flush();
        return true;
    }

}
