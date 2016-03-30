<?php

namespace MRusso\LibBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Route
 *
 * @ORM\Table(name="route")
 * @ORM\Entity
 */
class Route
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
     * @ORM\Column(name="rout_controller", type="string", length=255, nullable=false)
     */
    private $routController;

    /**
     * @var string
     *
     * @ORM\Column(name="rout_path", type="string", length=255, nullable=false)
     */
    private $routPath;

    /**
     * @var integer
     *
     * @ORM\Column(name="rout_father", type="integer", nullable=false)
     */
    private $routFather;

    /**
     * @var integer
     *
     * @ORM\Column(name="rout_visible", type="integer", nullable=false)
     */
    private $routVisible;

    /**
     * @var integer
     *
     * @ORM\Column(name="rout_order", type="integer", nullable=false)
     */
    private $routOrder;

    /**
     * @var string
     *
     * @ORM\Column(name="rout_label", type="string", length=255, nullable=false)
     */
    private $routLabel;

    /**
     * @var string
     *
     * @ORM\Column(name="rout_title", type="string", length=255, nullable=false)
     */
    private $routTitle;



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
     * Set routController
     *
     * @param string $routController
     *
     * @return Route
     */
    public function setRoutController($routController)
    {
        $this->routController = $routController;

        return $this;
    }

    /**
     * Get routController
     *
     * @return string
     */
    public function getRoutController()
    {
        return $this->routController;
    }

    /**
     * Set routPath
     *
     * @param string $routPath
     *
     * @return Route
     */
    public function setRoutPath($routPath)
    {
        $this->routPath = $routPath;

        return $this;
    }

    /**
     * Get routPath
     *
     * @return string
     */
    public function getRoutPath()
    {
        return $this->routPath;
    }

    /**
     * Set routFather
     *
     * @param integer $routFather
     *
     * @return Route
     */
    public function setRoutFather($routFather)
    {
        $this->routFather = $routFather;

        return $this;
    }

    /**
     * Get routFather
     *
     * @return integer
     */
    public function getRoutFather()
    {
        return $this->routFather;
    }

    /**
     * Set routVisible
     *
     * @param integer $routVisible
     *
     * @return Route
     */
    public function setRoutVisible($routVisible)
    {
        $this->routVisible = $routVisible;

        return $this;
    }

    /**
     * Get routVisible
     *
     * @return integer
     */
    public function getRoutVisible()
    {
        return $this->routVisible;
    }

    /**
     * Set routOrder
     *
     * @param integer $routOrder
     *
     * @return Route
     */
    public function setRoutOrder($routOrder)
    {
        $this->routOrder = $routOrder;

        return $this;
    }

    /**
     * Get routOrder
     *
     * @return integer
     */
    public function getRoutOrder()
    {
        return $this->routOrder;
    }

    /**
     * Set routLabel
     *
     * @param string $routLabel
     *
     * @return Route
     */
    public function setRoutLabel($routLabel)
    {
        $this->routLabel = $routLabel;

        return $this;
    }

    /**
     * Get routLabel
     *
     * @return string
     */
    public function getRoutLabel()
    {
        return $this->routLabel;
    }

    /**
     * Set routTitle
     *
     * @param string $routTitle
     *
     * @return Route
     */
    public function setRoutTitle($routTitle)
    {
        $this->routTitle = $routTitle;

        return $this;
    }

    /**
     * Get routTitle
     *
     * @return string
     */
    public function getRoutTitle()
    {
        return $this->routTitle;
    }
}
