<?php

namespace FTR\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTR\WebBundle\Entity\Facilitylist
 *
 * @ORM\Table(name="facilitylist")
 * @ORM\Entity(repositoryClass="FTR\AdminBundle\Repository\FacilitylistRepository")
 */
class Facilitylist
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
     * @var string $facility_name
     *
     * @ORM\Column(name="facility_name", type="string", length=255)
     */
    private $facility_name;

    /**
     * @var string $facility_type
     *
     * @ORM\Column(name="facility_type", type="string", length=255)
     */
    private $facility_type;

    /**
     * @var boolean $display
     *
     * @ORM\Column(name="display", type="boolean", nullable="true")
     */
    private $display;

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
     * Set facility_name
     *
     * @param string $facilityName
     */
    public function setFacilityName($facilityName)
    {
        $this->facility_name = $facilityName;
    }

    /**
     * Get facility_name
     *
     * @return string 
     */
    public function getFacilityName()
    {
        return $this->facility_name;
    }

    /**
     * Set facility_type
     *
     * @param string $facilityType
     */
    public function setFacilityType($facilityType)
    {
        $this->facility_type = $facilityType;
    }

    /**
     * Get facility_type
     *
     * @return string 
     */
    public function getFacilityType()
    {
        return $this->facility_type;
    }

    /**
     * Set display
     *
     * @param boolean $display
     */
    public function setDisplay($display)
    {
        $this->display = $display;
    }

    /**
     * Get display
     *
     * @return boolean 
     */
    public function getDisplay()
    {
        return $this->display;
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