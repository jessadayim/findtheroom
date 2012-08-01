<?php

namespace FTR\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTR\WebBundle\Entity\Building_site
 *
 * @ORM\Table(name="building_site")
 * @ORM\Entity(repositoryClass="FTR\WebBundle\Repository\Building_siteRepository")
 */
class Building_site
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
     * @var string $building_name
     *
     * @ORM\Column(name="building_name", type="string", length=255)
     */
    private $building_name;

    /**
     * @var text $building_address
     *
     * @ORM\Column(name="building_address", type="text")
     */
    private $building_address;

    /**
     * @var integer $start_price
     *
     * @ORM\Column(name="start_price", type="integer")
     */
    private $start_price;

    /**
     * @var integer $end_price
     *
     * @ORM\Column(name="end_price", type="integer")
     */
    private $end_price;

    /**
     * @var string $phone_number
     *
     * @ORM\Column(name="phone_number", type="string", length=127)
     */
    private $phone_number;

    /**
     * @var boolean $publish
     *
     * @ORM\Column(name="publish", type="boolean")
     */
    private $publish;

    /**
     * @var datetime $datetimestamp
     *
     * @ORM\Column(name="datetimestamp", type="datetime")
     */
    private $datetimestamp;

    /**
     * @var datetime $lastupdate
     *
     * @ORM\Column(name="lastupdate", type="datetime")
     */
    private $lastupdate;

    /**
     * @var string $userupdate
     *
     * @ORM\Column(name="userupdate", type="string", length=127)
     */
    private $userupdate;

    /**
     * @var string $latitude
     *
     * @ORM\Column(name="latitude", type="string", length=127)
     */
    private $latitude;

    /**
     * @var string $longitude
     *
     * @ORM\Column(name="longitude", type="string", length=127)
     */
    private $longitude;

    /**
     * @var boolean $recommend
     *
     * @ORM\Column(name="recommend", type="boolean")
     */
    private $recommend;
	
	/**
     * @var integer $building_type_id
     *
     * @ORM\Column(name="building_type_id", type="integer")
     */
    private $building_type_id;
	
	/**
     * @var integer $zone_id
     *
     * @ORM\Column(name="zone_id", type="integer")
     */
    private $zone_id;
	
	/**
     * @var integer $pay_type_id
     *
     * @ORM\Column(name="pay_type_id", type="integer")
     */
    private $pay_type_id;
	
	/**
     * @var integer $user_owner_id
     *
     * @ORM\Column(name="user_owner_id", type="integer")
     */
    private $user_owner_id;

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
     * Set building_name
     *
     * @param string $buildingName
     */
    public function setBuildingName($buildingName)
    {
        $this->building_name = $buildingName;
    }

    /**
     * Get building_name
     *
     * @return string 
     */
    public function getBuildingName()
    {
        return $this->building_name;
    }

    /**
     * Set building_address
     *
     * @param text $buildingAddress
     */
    public function setBuildingAddress($buildingAddress)
    {
        $this->building_address = $buildingAddress;
    }

    /**
     * Get building_address
     *
     * @return text 
     */
    public function getBuildingAddress()
    {
        return $this->building_address;
    }

    /**
     * Set start_price
     *
     * @param integer $startPrice
     */
    public function setStartPrice($startPrice)
    {
        $this->start_price = $startPrice;
    }

    /**
     * Get start_price
     *
     * @return integer 
     */
    public function getStartPrice()
    {
        return $this->start_price;
    }

    /**
     * Set end_price
     *
     * @param integer $endPrice
     */
    public function setEndPrice($endPrice)
    {
        $this->end_price = $endPrice;
    }

    /**
     * Get end_price
     *
     * @return integer 
     */
    public function getEndPrice()
    {
        return $this->end_price;
    }

    /**
     * Set phone_number
     *
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phone_number = $phoneNumber;
    }

    /**
     * Get phone_number
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
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
     * Set datetimestamp
     *
     * @param datetime $datetimestamp
     */
    public function setDatetimestamp($datetimestamp)
    {
        $this->datetimestamp = $datetimestamp;
    }

    /**
     * Get datetimestamp
     *
     * @return datetime 
     */
    public function getDatetimestamp()
    {
        return $this->datetimestamp;
    }

    /**
     * Set lastupdate
     *
     * @param datetime $lastupdate
     */
    public function setLastupdate($lastupdate)
    {
        $this->lastupdate = $lastupdate;
    }

    /**
     * Get lastupdate
     *
     * @return datetime 
     */
    public function getLastupdate()
    {
        return $this->lastupdate;
    }

    /**
     * Set userupdate
     *
     * @param string $userupdate
     */
    public function setUserupdate($userupdate)
    {
        $this->userupdate = $userupdate;
    }

    /**
     * Get userupdate
     *
     * @return string 
     */
    public function getUserupdate()
    {
        return $this->userupdate;
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
     * Set recommend
     *
     * @param boolean $recommend
     */
    public function setRecommend($recommend)
    {
        $this->recommend = $recommend;
    }

    /**
     * Get recommend
     *
     * @return boolean 
     */
    public function getRecommend()
    {
        return $this->recommend;
    }

    /**
     * Set building_type_id
     *
     * @param integer $building_type_id
     */
    public function setBuildingTypeId($buildingTypeId)
    {
        $this->building_type_id = $buildingTypeId;
    }

    /**
     * Get building_type_id
     *
     * @return integer 
     */
    public function getBuildingTypeId()
    {
        return $this->building_type_id;
    }

    /**
     * Set zone_id
     *
     * @param integer $zone_id
     */
    public function setZoneId($zoneId)
    {
        $this->zone_id = $zoneId;
    }

    /**
     * Get zone_id
     *
     * @return integer 
     */
    public function getZoneId()
    {
        return $this->zone_id;
    }

    /**
     * Set pay_type_id
     *
     * @param integer $pay_type_id
     */
    public function setPayTypeId($payTypeId)
    {
        $this->pay_type_id = $payTypeId;
    }

    /**
     * Get pay_type_id
     *
     * @return integer 
     */
    public function getPayTypeId()
    {
        return $this->pay_type_id;
    }

    /**
     * Set user_owner_id
     *
     * @param integer $user_owner_id
     */
    public function setUserOwnerId($userOwnerId)
    {
        $this->user_owner_id = $userOwnerId;
    }

    /**
     * Get user_owner_id
     *
     * @return integer 
     */
    public function getUserOwnerId()
    {
        return $this->user_owner_id;
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