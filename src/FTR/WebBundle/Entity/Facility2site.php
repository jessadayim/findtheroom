<?php

namespace FTR\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTR\WebBundle\Entity\Facility2site
 *
 * @ORM\Table(name="facility2site")
 * @ORM\Entity(repositoryClass="FTR\WebBundle\Repository\Facility2siteRepository")
 */
class Facility2site
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
     * @ORM\Column(name="building_site_id", type="integer")
     */
    private $building_site_id;

    /**
     * @var integer $facilitylist_id
     *
     * @ORM\Column(name="facilitylist_id", type="integer")
     */
    private $facilitylist_id;

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
     * Set facilitylist_id
     *
     * @param integer $facilitylistId
     */
    public function setFacilitylistId($facilitylistId)
    {
        $this->facilitylist_id = $facilitylistId;
    }

    /**
     * Get facilitylist_id
     *
     * @return integer 
     */
    public function getFacilitylistId()
    {
        return $this->facilitylist_id;
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