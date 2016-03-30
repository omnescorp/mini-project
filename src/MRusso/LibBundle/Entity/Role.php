<?php

namespace MRusso\LibBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="role")
 * @ORM\Entity
 */
class Role
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="role_title", type="string", length=255, nullable=false)
     */
    private $roleTitle;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="MRusso\LibBundle\Entity\User", mappedBy="role")
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set roleTitle
     *
     * @param string $roleTitle
     *
     * @return Role
     */
    public function setRoleTitle($roleTitle)
    {
        $this->roleTitle = $roleTitle;

        return $this;
    }

    /**
     * Get roleTitle
     *
     * @return string
     */
    public function getRoleTitle()
    {
        return $this->roleTitle;
    }

    /**
     * Add user
     *
     * @param \MRusso\LibBundle\Entity\User $user
     *
     * @return Role
     */
    public function addUser(\MRusso\LibBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \MRusso\LibBundle\Entity\User $user
     */
    public function removeUser(\MRusso\LibBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }
}
