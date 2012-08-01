<?php

namespace FTR\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTR\WebBundle\Entity\Roomtype
 *
 * @ORM\Table(name="roomtype")
 * @ORM\Entity(repositoryClass="FTR\WebBundle\Repository\RoomtypeRepository")
 */
class Roomtype
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
     * @var string $room_typename
     *
     * @ORM\Column(name="room_typename", type="string", length=255)
     */
    private $room_typename;

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
     * Set room_typename
     *
     * @param string $roomTypename
     */
    public function setRoomTypename($roomTypename)
    {
        $this->room_typename = $roomTypename;
    }

    /**
     * Get room_typename
     *
     * @return string 
     */
    public function getRoomTypename()
    {
        return $this->room_typename;
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