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
     * @var float $room_size
     *
     * @ORM\Column(name="room_size", type="float")
     */
    private $room_size;

    /**
     * @var float $room_price
     *
     * @ORM\Column(name="room_price", type="float")
     */
    private $room_price;

    /**
     * @var boolean $deleted
     *
     * @ORM\Column(name="deleted", type="boolean", nullable="true")
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
     * Set room_size
     *
     * @param integer $room_size
     */
    public function setRoomsize($room_size)
    {
        $this->room_size = $room_size;
    }

    /**
     * Get room_size
     *
     * @return integer 
     */
    public function getRoomsize()
    {
        return $this->room_size;
    }

    /**
     * Set room_price
     *
     * @param float $room_price
     */
    public function setRoomprice($room_price)
    {
        $this->room_price = $room_price;
    }

    /**
     * Get room_price
     *
     * @return float 
     */
    public function getRoomprice()
    {
        return $this->room_price;
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