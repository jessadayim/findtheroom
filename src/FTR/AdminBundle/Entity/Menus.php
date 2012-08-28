<?php

namespace FTR\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTR\AdminBundle\Entity\Menus
 *
 * @ORM\Table(name="menus")
 * @ORM\Entity(repositoryClass="FTR\AdminBundle\Entity\MenusRepository")
 */
class Menus
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string $link
     *
     * @ORM\Column(name="link", type="string", length=255)
     */
    private $link;

    /**
     * @var integer $parents
     *
     * @ORM\Column(name="parents", type="integer")
     */
    private $parents;

    /**
     * @var integer $publish
     *
     * @ORM\Column(name="publish", type="integer")
     */
    private $publish;


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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set link
     *
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set parents
     *
     * @param integer $parents
     */
    public function setParents($parents)
    {
        $this->parents = $parents;
    }

    /**
     * Get parents
     *
     * @return integer 
     */
    public function getParents()
    {
        return $this->parents;
    }

    /**
     * Set publish
     *
     * @param integer $publish
     */
    public function setPublish($publish)
    {
        $this->publish = $publish;
    }

    /**
     * Get publish
     *
     * @return integer 
     */
    public function getPublish()
    {
        return $this->publish;
    }
}