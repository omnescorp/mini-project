<?php

namespace MRusso\LibBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use MRusso\LibBundle\Service\DB;

class Plan extends DB {

    protected $entity = 'MRusso\LibBundle\Entity\Plan';

    public function startPlan() {
        $plan = new $this->entity;
        $plan
                ->setTime(new \DateTime("now"))
                ->setDuration(0)
                ->setName('principal')
                ->setDescription('principal')
                ->setFather(0)
                ->setChild(0)
        ;
        $this->em->persist($plan);
        $this->em->flush();
        return $plan;
    }

    protected function setChild($father) {
        $plan = new $this->entity;
        $plan
                ->setTime(new \DateTime("now"))
                ->setDuration(0)
                ->setName('principal')
                ->setDescription('principal')
                ->setFather($father->getId())
                ->setChild(0)
        ;
        $this->em->persist($plan);
        $this->em->flush();
        return $plan;
    }

    public function create() {
        $plan = $this->getPlan();
        $hijo = $this->setChild($plan);
        $plan->setChild($hijo->getId());
        $this->em->persist($plan);
        $this->em->flush();
        return $hijo;
    }

    public function update() {

        if (!$plan = $this->find($this->request->get('id'))) {
            return false;
        }
        $plan->setName($this->request->get('name'));
        $this->em->persist($plan);
        $this->em->flush();
        return $plan;
        
    }

    public function getPlan() {
        $query = $this->em->createQueryBuilder();

        $query
                ->select('plan')
                ->from($this->entity, 'plan')
//                ->where('plan.id = 1')
//                ->where('route.routVisible = 1')
                ->orderBy('plan.id', 'desc')


        //->where('user.userAdmin = 0')

        ;
        //$this->crearTest();

        if (!$plan = $this->getOne($query)) {
            $plan = $this->startPlan();
        }


        return $plan;
    }

}
