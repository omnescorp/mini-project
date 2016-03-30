<?php

namespace MRusso\LibBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Galerie
 *
 * @ORM\Table(name="galerie")
 * @ORM\Entity
 */
class Galerie
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
     * @ORM\Column(name="galerie_file", type="string", length=255, nullable=false)
     */
    private $galerieFile;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="MRusso\LibBundle\Entity\Post", mappedBy="idGalerie")
     */
    private $idPost;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idPost = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set galerieFile
     *
     * @param string $galerieFile
     *
     * @return Galerie
     */
    public function setGalerieFile($galerieFile)
    {
        $this->galerieFile = $galerieFile;

        return $this;
    }

    /**
     * Get galerieFile
     *
     * @return string
     */
    public function getGalerieFile()
    {
        return $this->galerieFile;
    }

    /**
     * Add idPost
     *
     * @param \MRusso\LibBundle\Entity\Post $idPost
     *
     * @return Galerie
     */
    public function addIdPost(\MRusso\LibBundle\Entity\Post $idPost)
    {
        $this->idPost[] = $idPost;

        return $this;
    }

    /**
     * Remove idPost
     *
     * @param \MRusso\LibBundle\Entity\Post $idPost
     */
    public function removeIdPost(\MRusso\LibBundle\Entity\Post $idPost)
    {
        $this->idPost->removeElement($idPost);
    }

    /**
     * Get idPost
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdPost()
    {
        return $this->idPost;
    }
}
