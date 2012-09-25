<?php

namespace FTR\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTR\AdminBundle\Entity\Ads_Control
 *
 * @ORM\Table(name="ads_control")
 * @ORM\Entity(repositoryClass="FTR\AdminBundle\Repository\Ads_ControlRepository")
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
     * @var string $zone
     *
     * @ORM\Column(name="zone", type="string", length=64)
     */
    private $zone;

    /**
     * @var text $codes
     *
     * @ORM\Column(name="codes", type="text")
     */
    private $codes;

    /**
     * @var boolean $publish
     *
     * @ORM\Column(name="publish", type="boolean")
     */
    private $publish;

    /**
     * @var datetime $date_start
     *
     * @ORM\Column(name="date_start", type="datetime")
     */
    private $date_start;

    /**
     * @var datetime $date_end
     *
     * @ORM\Column(name="date_end", type="datetime")
     */
    private $date_end;


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
     * @param string $zone
     */
    public function setZone($zone)
    {
        $this->zone = $zone;
    }

    /**
     * Get zone
     *
     * @return string
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
     * @param boolean $publish
     */
    public function setPublish($publish)
    {
        $this->publish = $publish;
    }

    /**
     * Get publish
     *
     * @return boolean
     */
    public function getPublish()
    {
        return $this->publish;
    }

    /**
     * Set date_start
     *
     * @param datetime $date_start
     */
    public function setDateStart($dateStart)
    {
        $this->date_start = $dateStart;
    }

    /**
     * Get date_start
     *
     * @return datetime
     */
    public function getDateStart()
    {
        return $this->date_start;
    }

    /**
     * Set date_end
     *
     * @param datetime $date_end
     */
    public function setDateEnd($dateEnd)
    {
        $this->date_end = $dateEnd;
    }

    /**
     * Get date_end
     *
     * @return datetime
     */
    public function getDateEnd()
    {
        return $this->date_end;
    }
}