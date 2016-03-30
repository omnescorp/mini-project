<?php

namespace MRusso\LibBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post", indexes={@ORM\Index(name="post_user_id", columns={"post_user_id"}), @ORM\Index(name="post_template_id", columns={"post_template_id"})})
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
     * @var \DateTime
     *
     * @ORM\Column(name="post_modified", type="datetime", nullable=false)
     */
    private $postModified = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="post_pretitle", type="text", length=65535, nullable=false)
     */
    private $postPretitle;

    /**
     * @var string
     *
     * @ORM\Column(name="post_title", type="text", length=65535, nullable=false)
     */
    private $postTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="post_subtitle", type="text", length=65535, nullable=false)
     */
    private $postSubtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="post_content", type="text", nullable=false)
     */
    private $postContent;

    /**
     * @var string
     *
     * @ORM\Column(name="post_excerpt", type="text", nullable=false)
     */
    private $postExcerpt;

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
     * @var \MRusso\LibBundle\Entity\PostTemplate
     *
     * @ORM\ManyToOne(targetEntity="MRusso\LibBundle\Entity\PostTemplate")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_template_id", referencedColumnName="id")
     * })
     */
    private $postTemplate;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="MRusso\LibBundle\Entity\Category", inversedBy="post")
     * @ORM\JoinTable(name="post_category",
     *   joinColumns={
     *     @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="cate_id", referencedColumnName="id")
     *   }
     * )
     */
    private $cate;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="MRusso\LibBundle\Entity\Galerie", inversedBy="idPost")
     * @ORM\JoinTable(name="post_galerie",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_post", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_galerie", referencedColumnName="id")
     *   }
     * )
     */
    private $idGalerie;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cate = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idGalerie = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set postModified
     *
     * @param \DateTime $postModified
     *
     * @return Post
     */
    public function setPostModified($postModified)
    {
        $this->postModified = $postModified;

        return $this;
    }

    /**
     * Get postModified
     *
     * @return \DateTime
     */
    public function getPostModified()
    {
        return $this->postModified;
    }

    /**
     * Set postPretitle
     *
     * @param string $postPretitle
     *
     * @return Post
     */
    public function setPostPretitle($postPretitle)
    {
        $this->postPretitle = $postPretitle;

        return $this;
    }

    /**
     * Get postPretitle
     *
     * @return string
     */
    public function getPostPretitle()
    {
        return $this->postPretitle;
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
     * Set postSubtitle
     *
     * @param string $postSubtitle
     *
     * @return Post
     */
    public function setPostSubtitle($postSubtitle)
    {
        $this->postSubtitle = $postSubtitle;

        return $this;
    }

    /**
     * Get postSubtitle
     *
     * @return string
     */
    public function getPostSubtitle()
    {
        return $this->postSubtitle;
    }

    /**
     * Set postContent
     *
     * @param string $postContent
     *
     * @return Post
     */
    public function setPostContent($postContent)
    {
        $this->postContent = $postContent;

        return $this;
    }

    /**
     * Get postContent
     *
     * @return string
     */
    public function getPostContent()
    {
        return $this->postContent;
    }

    /**
     * Set postExcerpt
     *
     * @param string $postExcerpt
     *
     * @return Post
     */
    public function setPostExcerpt($postExcerpt)
    {
        $this->postExcerpt = $postExcerpt;

        return $this;
    }

    /**
     * Get postExcerpt
     *
     * @return string
     */
    public function getPostExcerpt()
    {
        return $this->postExcerpt;
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

    /**
     * Set postTemplate
     *
     * @param \MRusso\LibBundle\Entity\PostTemplate $postTemplate
     *
     * @return Post
     */
    public function setPostTemplate(\MRusso\LibBundle\Entity\PostTemplate $postTemplate = null)
    {
        $this->postTemplate = $postTemplate;

        return $this;
    }

    /**
     * Get postTemplate
     *
     * @return \MRusso\LibBundle\Entity\PostTemplate
     */
    public function getPostTemplate()
    {
        return $this->postTemplate;
    }

    /**
     * Add cate
     *
     * @param \MRusso\LibBundle\Entity\Category $cate
     *
     * @return Post
     */
    public function addCate(\MRusso\LibBundle\Entity\Category $cate)
    {
        $this->cate[] = $cate;

        return $this;
    }

    /**
     * Remove cate
     *
     * @param \MRusso\LibBundle\Entity\Category $cate
     */
    public function removeCate(\MRusso\LibBundle\Entity\Category $cate)
    {
        $this->cate->removeElement($cate);
    }

    /**
     * Get cate
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCate()
    {
        return $this->cate;
    }

    /**
     * Add idGalerie
     *
     * @param \MRusso\LibBundle\Entity\Galerie $idGalerie
     *
     * @return Post
     */
    public function addIdGalerie(\MRusso\LibBundle\Entity\Galerie $idGalerie)
    {
        $this->idGalerie[] = $idGalerie;

        return $this;
    }

    /**
     * Remove idGalerie
     *
     * @param \MRusso\LibBundle\Entity\Galerie $idGalerie
     */
    public function removeIdGalerie(\MRusso\LibBundle\Entity\Galerie $idGalerie)
    {
        $this->idGalerie->removeElement($idGalerie);
    }

    /**
     * Get idGalerie
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdGalerie()
    {
        return $this->idGalerie;
    }
}
