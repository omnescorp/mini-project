<?php

namespace MRusso\LibBundle\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Acl\Model\DomainObjectInterface;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Common\Cache\MemcachedCache;

class DB implements DomainObjectInterface {

    protected $em;
    protected $entity;
    protected $repository;
    protected $paginator;
    protected $request_stack;
    protected $request;
    protected $service_container;
    protected $container;
    protected $noPaginator = false;
    protected $cache_time = 3600;
    protected $no_cache = false;

    public function __construct() {

        if (!$this->entity) {
            echo "error";
            die;
        }
    }

    public function setEntityManager(EntityManager $entityManager) {
        $this->em = $entityManager;
        $this->repository = $this->em->getRepository($this->entity);
        return $this;
    }

    public function setMongoEntityManager(ManagerRegistry $entityManager) {
        $this->mongo = $entityManager->getManager();
        return $this;
    }

    public function setRequest(RequestStack $request_stack) {
        $this->request_stack = $request_stack;
        $this->request = $request_stack->getCurrentRequest();
        return $this;
    }

    public function setContainer($service_container) {
        $this->service_container = $this->container = $service_container;
        return $this;
    }

    public function getParameter($param) {
        return $this->container->getParameter($param);
    }

    public function getConf($param) {
        return $this->getParameter($param);
    }

    public function getOne($query) {
        return $query->getQuery()->getResult() ? $query->getQuery()->getResult()[0] : null;
    }

    public function noPaginator() {
        $this->noPaginator = true;
        return $this;
    }

    public function noCache($val = true) {
        $this->no_cache = $val;
        return $this;
    }

    public function OrmPaginator($query) {

        if ($this->noPaginator) {
            return $query->getQuery()->useResultCache(true, $this->cache_time)->getResult();
        }
        $max = $this->getParameter('page.max');
        $page = $this->request->attributes->get('page', 1);
        $range = $this->getParameter('page.range');

        $this->paginator = new Paginator($query);
        $this->paginator
                ->getQuery()
                ->useResultCache(true, $this->cache_time)
                ->setFirstResult($max * ($page - 1))
                ->setMaxResults($max)
        ;
        // Calcular rango de páginas en el paginador
        $count_page = ceil($this->paginator->count() / $max);
        if ($range > $count_page) {
            $range = $count_page;
        }
        $delta = ceil($range / 2);

        if ($page - $delta > $count_page - $range) {
            $lower_bound = $count_page - $range + 1;
            $upper_bound = $count_page;
        } else {
            if ($page - $delta < 0) {
                $delta = $page;
            }
            $offset = $page - $delta;
            $lower_bound = $offset + 1;
            $upper_bound = $offset + $range;
        }

        $this->paginator->view = array(
            'lower_range' => $lower_bound,
            'upper_range' => $upper_bound,
            'count_page' => $count_page,
            'current_page_number' => $page,
        );
        //Seteamos el paginador en el twig.
        $this->container->get('paginator')->setPaginator($this->paginator->view);
        $this->container->get('seo')->setPagination($this->paginator->view);
        return $this->paginator;
    }

    public function getOrmPaginator() {

        return $this->paginator;
    }

    //Comunes
    public function findAll() {
        return $this->repository->findAll();
    }

    public function find($id) {
        return $this->repository->find($id);
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null) {
        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function findOneBy(array $criteria, array $orderBy = null) {
        return $this->repository->findOneBy($criteria, $orderBy);
    }

    public function getObjectIdentifier() {
        return get_class($this);
    }

    protected function execute($query) {
        $memcached = $this->container->get('memcached');

        $cacheDriver = new MemcachedCache();
        $cacheDriver->setMemcached($memcached);

        $cache_id = md5($query);
        if (!$this->no_cache && $result = $cacheDriver->fetch($cache_id)) {
            return $result;
        }

        $stmt = $this->em->getConnection()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $cacheDriver->save($cache_id, $result, $this->cache_time);
        $this->em->getConnection()->close();

        return $result;
    }

    protected function getDateNow($format = 'Y-m-d H:i:s') {
        return date($format);
    }

}
