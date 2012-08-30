<?php

namespace FTR\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTR\AdminBundle\Entity\Ads_Control
 *
 * @ORM\Table(name="ads_control")
 * @ORM\Entity(repositoryClass="FTR\AdminBundle\Entity\Ads_ControlRepository")
 */
class Ads_Control
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
     * @var integer $zone
     *
     * @ORM\Column(name="zone", type="integer")
     */
    private $zone;

    /**
     * @var text $codes
     *
     * @ORM\Column(name="codes", type="text")
     */
    private $codes;

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
     * Set zone
     *
     * @param integer $zone
     */
    public function setZone($zone)
    {
        $this->zone = $zone;
    }

    /**
     * Get zone
     *
     * @return integer 
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * Set codes
     *
     * @param text $codes
     */
    public function setCodes($codes)
    {
        $this->codes = $codes;
    }

    /**
     * Get codes
     *
     * @return text 
     */
    public function getCodes()
    {
        return $this->codes;
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