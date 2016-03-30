<?php

namespace MRusso\LibBundle\Model;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Symfony\Component\HttpFoundation\RequestStack;

class Acl {

    public function setRequest(RequestStack $request_stack) {
        $this->request_stack = $request_stack;
        $this->request = $request_stack->getCurrentRequest();
        return $this;
    }

    public function setContainer($service_container) {
        $this->service_container = $this->container = $service_container;
        return $this;
    }

    public function addRoleRoute($rol, $route) {
        $this->deleteAllAces($rol);
        if ($route) {
            foreach ($route as $rout) {
                if ($ro = $this->container->get('routes')->find($rout)) {
                    $this->update($ro, $rol);
                }
            }
        }
        return;
    }

    private function deleteAllAces($group_id) {
        // Esto borra todos los aces, pero no discrimina el role, necesito hacerlo por role.
        $aclProvider = $this->container->get('security.acl.provider');

        if ($route = $this->container->get('routes')->findAll()) {
            foreach ($route as $rout) {
                $objectIdentity = ObjectIdentity::fromDomainObject($rout);
                $securityIdentity = new RoleSecurityIdentity('ROLE_' . $group_id);
                try {
                    $acl = $aclProvider->findAcl($objectIdentity, array($securityIdentity));
                } catch (\Symfony\Component\Security\Acl\Exception\AclNotFoundException $e) {
                    continue;
//                    $acl = $aclProvider->createAcl($objectIdentity);?
                }
                foreach ($acl->getObjectAces() as $index => $ace) {
                    $aceSecurityId = $ace->getSecurityIdentity();
                    if ($aceSecurityId->equals($securityIdentity)) {
                        $acl->deleteObjectAce($index);
                    }
                }
                $aclProvider->updateAcl($acl);
//                $acl->deleteObjectAce(0);
            }
        }
//        $aclProvider->updateAcl($acl);
        return true;
    }

    public function update($object, $group_id) {
        if (!$object || !$group_id) {
            return false;
        }
        $aclProvider = $this->container->get('security.acl.provider');
        $objectIdentity = ObjectIdentity::fromDomainObject($object);
        try {
            $acl = $aclProvider->findAcl($objectIdentity);
        } catch (\Symfony\Component\Security\Acl\Exception\AclNotFoundException $e) {
            $acl = $aclProvider->createAcl($objectIdentity);
        }

        $securityIdentity = new RoleSecurityIdentity('ROLE_' . $group_id);


        // grant owner access

        $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
        $aclProvider->updateAcl($acl);

        return true;
    }

    public function addPermiso() {
        $comment = $this->container->get('routes')->find(6);

        // ... setup $form, and submit data
        // creating the ACL
        $aclProvider = $this->container->get('security.acl.provider');
        $objectIdentity = ObjectIdentity::fromDomainObject($comment);
        try {
            $acl = $aclProvider->findAcl($objectIdentity);
        } catch (\Symfony\Component\Security\Acl\Exception\AclNotFoundException $e) {
            $acl = $aclProvider->createAcl($objectIdentity);
        }

        // retrieving the security identity of the currently logged-in user
//        $tokenStorage = $this->container->get('security.token_storage');
//        print_r( $tokenStorage->getToken()->getRoles());die;
//        $user = $tokenStorage->getToken()->getUser();
//        $securityIdentity = UserSecurityIdentity::fromAccount($user);
//        Esto sería para crear el permiso ACL con el grupo en lugar de con el usuario.
//        Mejor por grupos, así la tabla no crece tanto y es más fácil de manipular.

        $securityIdentity = new RoleSecurityIdentity('ROLE_2');


        // grant owner access
        $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
        $aclProvider->updateAcl($acl);
    }

}
