<?php

namespace MRusso\LibBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post", indexes={@ORM\Index(name="post_user_id", columns={"post_user_id"})})
 * @ORM\Entity
 */
class Post
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
     * @ORM\Column(name="post_author", type="string", length=255, nullable=false)
     */
    private $postAuthor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="post_date", type="datetime", nullable=false)
     */
    private $postDate;

    /**
     * @var string
     *
     * @ORM\Column(name="post_title", type="text", length=65535, nullable=false)
     */
    private $postTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="post_slug", type="string", length=255, nullable=false)
     */
    private $postSlug;

    /**
     * @var string
     *
     * @ORM\Column(name="post_slug_short", type="string", length=255, nullable=false)
     */
    private $postSlugShort;

    /**
     * @var integer
     *
     * @ORM\Column(name="post_status", type="integer", nullable=false)
     */
    private $postStatus;

    /**
     * @var \MRusso\LibBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="MRusso\LibBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_user_id", referencedColumnName="id")
     * })
     */
    private $postUser;



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
     * Set postAuthor
     *
     * @param string $postAuthor
     *
     * @return Post
     */
    public function setPostAuthor($postAuthor)
    {
        $this->postAuthor = $postAuthor;

        return $this;
    }

    /**
     * Get postAuthor
     *
     * @return string
     */
    public function getPostAuthor()
    {
        return $this->postAuthor;
    }

    /**
     * Set postDate
     *
     * @param \DateTime $postDate
     *
     * @return Post
     */
    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;

        return $this;
    }

    /**
     * Get postDate
     *
     * @return \DateTime
     */
    public function getPostDate()
    {
        return $this->postDate;
    }

    /**
     * Set postTitle
     *
     * @param string $postTitle
     *
     * @return Post
     */
    public function setPostTitle($postTitle)
    {
        $this->postTitle = $postTitle;

        return $this;
    }

    /**
     * Get postTitle
     *
     * @return string
     */
    public function getPostTitle()
    {
        return $this->postTitle;
    }

    /**
     * Set postSlug
     *
     * @param string $postSlug
     *
     * @return Post
     */
    public function setPostSlug($postSlug)
    {
        $this->postSlug = $postSlug;

        return $this;
    }

    /**
     * Get postSlug
     *
     * @return string
     */
    public function getPostSlug()
    {
        return $this->postSlug;
    }

    /**
     * Set postSlugShort
     *
     * @param string $postSlugShort
     *
     * @return Post
     */
    public function setPostSlugShort($postSlugShort)
    {
        $this->postSlugShort = $postSlugShort;

        return $this;
    }

    /**
     * Get postSlugShort
     *
     * @return string
     */
    public function getPostSlugShort()
    {
        return $this->postSlugShort;
    }

    /**
     * Set postStatus
     *
     * @param integer $postStatus
     *
     * @return Post
     */
    public function setPostStatus($postStatus)
    {
        $this->postStatus = $postStatus;

        return $this;
    }

    /**
     * Get postStatus
     *
     * @return integer
     */
    public function getPostStatus()
    {
        return $this->postStatus;
    }

    /**
     * Set postUser
     *
     * @param \MRusso\LibBundle\Entity\User $postUser
     *
     * @return Post
     */
    public function setPostUser(\MRusso\LibBundle\Entity\User $postUser = null)
    {
        $this->postUser = $postUser;

        return $this;
    }

    /**
     * Get postUser
     *
     * @return \MRusso\LibBundle\Entity\User
     */
    public function getPostUser()
    {
        return $this->postUser;
    }
}
