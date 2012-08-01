<?php

namespace FTR\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTR\WebBundle\Entity\Nearly2site
 *
 * @ORM\Table(name="nearly2site")
 * @ORM\Entity(repositoryClass="FTR\WebBundle\Repository\Nearly2siteRepository")
 */
class Nearly2site
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
     * @var integer $nearly_location_id
     *
     * @ORM\Column(name="nearly_location_id", type="integer")
     */
    private $nearly_location_id;

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
     * Set nearly_location_id
     *
     * @param integer $nearlyLocationId
     */
    public function setNearlyLocationId($nearlyLocationId)
    {
        $this->nearly_location_id = $nearlyLocationId;
    }

    /**
     * Get nearly_location_id
     *
     * @return integer 
     */
    public function getNearlyLocationId()
    {
        return $this->nearly_location_id;
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