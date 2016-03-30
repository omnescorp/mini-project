<?php

namespace MRusso\LibBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use MRusso\LibBundle\Service\DB;

class Role extends DB {

    protected $entity = 'MRusso\LibBundle\Entity\Role';

    public function getRoleRoute($padre = 0) {

        $query = 'SELECT * FROM acl_entries
            INNER JOIN acl_security_identities on acl_entries.security_identity_id = acl_security_identities.id and acl_security_identities.identifier = "ROLE_2"
            INNER JOIN acl_object_identities on acl_entries.object_identity_id = acl_object_identities.id
            INNER JOIN route on route.id = acl_object_identities.object_identifier'
        ;

        $query = 'select route.*,
(SELECT acl_entries.id FROM acl_entries
            INNER JOIN acl_security_identities on acl_entries.security_identity_id = acl_security_identities.id
            and acl_security_identities.identifier = "ROLE_' . $this->request->get('id') . '"
            INNER JOIN acl_object_identities on acl_entries.object_identity_id = acl_object_identities.id
 where acl_object_identities.object_identifier = route.id limit 1
            ) acl

from route
where route.rout_father = ' . $padre . '
;
';
//        echo $query;die;
        $this->cache_time = 0;
        $result = $this->noCache()->execute($query);
        foreach ($result as &$row) {
            $row['child'] = $this->getRoleRoute($row['id']);
        }
        return $result;
    }

}
