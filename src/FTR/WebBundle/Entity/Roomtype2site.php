<?php

namespace FTR\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTR\WebBundle\Entity\roomtype2site
 *
 * @ORM\Table(name="roomtype2site")
 * @ORM\Entity(repositoryClass="FTR\WebBundle\Repository\Roomtype2siteRepository")
 */
class Roomtype2site
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
     * @var integer $roomtype_id
     *
     * @ORM\Column(name="roomtype_id", type="integer")
     */
    private $roomtype_id;

    /**
     * @var integer $building_site_id
     *
     * @ORM\Column(name="building_site_id", type="integer")
     */
    private $building_site_id;

    /**
     * @var boolean $deleted
     *
     * @ORM\Column(name="deleted", type="boolean")
     */
    private $deleted;


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
     * Set roomtype_id
     *
     * @param integer $roomtypeId
     */
    public function setRoomtypeId($roomtypeId)
    {
        $this->roomtype_id = $roomtypeId;
    }

    /**
     * Get roomtype_id
     *
     * @return integer 
     */
    public function getRoomtypeId()
    {
        return $this->roomtype_id;
    }

    /**
     * Set building_site_id
     *
     * @param integer $buildingSiteId
     */
    public function setBuildingSiteId($buildingSiteId)
    {
        $this->building_site_id = $buildingSiteId;
    }

    /**
     * Get building_site_id
     *
     * @return integer 
     */
    public function getBuildingSiteId()
    {
        return $this->building_site_id;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }
}