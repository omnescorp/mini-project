<?php

namespace MRusso\LibBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
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
     * @ORM\Column(name="cate_description", type="string", length=255, nullable=false)
     */
    private $cateDescription;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="MRusso\LibBundle\Entity\Post", mappedBy="cate")
     */
    private $post;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->post = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set cateDescription
     *
     * @param string $cateDescription
     *
     * @return Category
     */
    public function setCateDescription($cateDescription)
    {
        $this->cateDescription = $cateDescription;

        return $this;
    }

    /**
     * Get cateDescription
     *
     * @return string
     */
    public function getCateDescription()
    {
        return $this->cateDescription;
    }

    /**
     * Add post
     *
     * @param \MRusso\LibBundle\Entity\Post $post
     *
     * @return Category
     */
    public function addPost(\MRusso\LibBundle\Entity\Post $post)
    {
        $this->post[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \MRusso\LibBundle\Entity\Post $post
     */
    public function removePost(\MRusso\LibBundle\Entity\Post $post)
    {
        $this->post->removeElement($post);
    }

    /**
     * Get post
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPost()
    {
        return $this->post;
    }
}
