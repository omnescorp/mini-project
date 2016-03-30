<?php

namespace MRusso\LibBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostTemplate
 *
 * @ORM\Table(name="post_template")
 * @ORM\Entity
 */
class PostTemplate
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
     * @ORM\Column(name="post_template_name", type="string", length=255, nullable=false)
     */
    private $postTemplateName;

    /**
     * @var string
     *
     * @ORM\Column(name="post_template_file", type="string", length=255, nullable=false)
     */
    private $postTemplateFile;



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
     * Set postTemplateName
     *
     * @param string $postTemplateName
     *
     * @return PostTemplate
     */
    public function setPostTemplateName($postTemplateName)
    {
        $this->postTemplateName = $postTemplateName;

        return $this;
    }

    /**
     * Get postTemplateName
     *
     * @return string
     */
    public function getPostTemplateName()
    {
        return $this->postTemplateName;
    }

    /**
     * Set postTemplateFile
     *
     * @param string $postTemplateFile
     *
     * @return PostTemplate
     */
    public function setPostTemplateFile($postTemplateFile)
    {
        $this->postTemplateFile = $postTemplateFile;

        return $this;
    }

    /**
     * Get postTemplateFile
     *
     * @return string
     */
    public function getPostTemplateFile()
    {
        return $this->postTemplateFile;
    }
}
