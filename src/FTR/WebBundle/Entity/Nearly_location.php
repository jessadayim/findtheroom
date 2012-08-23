<?php

namespace FTR\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTR\WebBundle\Entity\Nearly_location
 *
 * @ORM\Table(name="nearly_location")
 * @ORM\Entity(repositoryClass="FTR\WebBundle\Repository\Nearly_locationRepository")
 */
class Nearly_location
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
     * @var integer $nearly_type_id
     *
     * @ORM\Column(name="nearly_type_id", type="integer")
     */
    private $nearly_type_id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var text $address
     *
     * @ORM\Column(name="address", type="text", nullable="true")
     */
    private $address;

    /**
     * @var string $latitude
     *
     * @ORM\Column(name="latitude", type="string", length=127, nullable="true")
     */
    private $latitude;

    /**
     * @var string $longitude
     *
     * @ORM\Column(name="longitude", type="string", length=127, nullable="true")
     */
    private $longitude;

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
     * Set nearly_type_id
     *
     * @param integer $nearlyTypeId
     */
    public function setNearlyTypeId($nearlyTypeId)
    {
        $this->nearly_type_id = $nearlyTypeId;
    }

    /**
     * Get nearly_type_id
     *
     * @return integer 
     */
    public function getNearlyTypeId()
    {
        return $this->nearly_type_id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param text $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return text 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
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