<?php

namespace MRusso\LibBundle\Service;

use Symfony\Component\Security\Acl\Dbal\AclProvider as acl;
use Symfony\Component\Security\Acl\Model\ObjectIdentityInterface;

class AclProvider extends acl {

    public function findAcl(ObjectIdentityInterface $oid, array $sids = array()) {
        return $this->findAcls(array($oid), $sids)->offsetGet($oid);
    }

}
