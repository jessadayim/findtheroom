<?php

namespace FTR\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTR\AdminBundle\Entity\Building_view_count
 *
 * @ORM\Table(name="building_view_count")
 * @ORM\Entity(repositoryClass="FTR\AdminBundle\Entity\Building_view_countRepository")
 */
class Building_view_count
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
     * @var integer $building_id
     *
     * @ORM\Column(name="building_id", type="integer")
     */
    private $building_id;

    /**
     * @var integer $count
     *
     * @ORM\Column(name="count", type="integer")
     */
    private $count;


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
     * Set building_id
     *
     * @param integer $buildingId
     */
    public function setBuildingId($buildingId)
    {
        $this->building_id = $buildingId;
    }

    /**
     * Get building_id
     *
     * @return integer 
     */
    public function getBuildingId()
    {
        return $this->building_id;
    }

    /**
     * Set count
     *
     * @param integer $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * Get count
     *
     * @return integer 
     */
    public function getCount()
    {
        return $this->count;
    }
}