<?php

namespace FTR\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTR\WebBundle\Entity\Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="FTR\WebBundle\Repository\ImageRepository")
 */
class Image
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
     * @var integer $building_site_id
     *
     * @ORM\Column(name="building_site_id", type="integer", nullable="true")
     */
    private $building_site_id;

    /**
     * @var integer $roomtype2site_id
     *
     * @ORM\Column(name="roomtype2site_id", type="integer", nullable="true")
     */
    private $roomtype2site_id;

    /**
     * @var string $photo_name
     *
     * @ORM\Column(name="photo_name", type="string", length=127)
     */
    private $photo_name;

    /**
     * @var string $photo_type
     *
     * @ORM\Column(name="photo_type", type="string", length=127)
     */
    private $photo_type;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var integer $sequence
     *
     * @ORM\Column(name="sequence", type="integer", nullable="true")
     */
    private $sequence;

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
     * Set roomtype2site_id
     *
     * @param integer $roomtype2siteId
     */
    public function setRoomtype2siteId($roomtype2siteId)
    {
        $this->roomtype2site_id = $roomtype2siteId;
    }

    /**
     * Get roomtype2site_id
     *
     * @return integer 
     */
    public function getRoomtype2siteId()
    {
        return $this->roomtype2site_id;
    }

    /**
     * Set photo_name
     *
     * @param string $photoName
     */
    public function setPhotoName($photoName)
    {
        $this->photo_name = $photoName;
    }

    /**
     * Get photo_name
     *
     * @return string 
     */
    public function getPhotoName()
    {
        return $this->photo_name;
    }

    /**
     * Set photo_type
     *
     * @param string $photoType
     */
    public function setPhotoType($photoType)
    {
        $this->photo_type = $photoType;
    }

    /**
     * Get photo_type
     *
     * @return string 
     */
    public function getPhotoType()
    {
        return $this->photo_type;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set sequence
     *
     * @param integer $sequence
     */
    public function setSequence($sequence)
    {
        $this->sequence = $sequence;
    }

    /**
     * Get sequence
     *
     * @return integer 
     */
    public function getSequence()
    {
        return $this->sequence;
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