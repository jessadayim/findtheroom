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
     * @var integer $publish
     *
     * @ORM\Column(name="publish", type="integer", nullable="true")
     */
    private $publish;

    /**
     * @var datetime $datetimestamp
     *
     * @ORM\Column(name="datetimestamp", type="datetime", nullable="true")
     */
    private $datetimestamp;

    /**
     * @var datetime $lastupdate
     *
     * @ORM\Column(name="lastupdate", type="datetime", nullable="true")
     */
    private $lastupdate;

    /**
     * @var string $userupdate
     *
     * @ORM\Column(name="userupdate", type="string", length=127, nullable="true")
     */
    private $userupdate;

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
     * @var boolean $recommend
     *
     * @ORM\Column(name="recommend", type="boolean", nullable="true")
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
     * @ORM\Column(name="zone_id", type="integer", nullable="true")
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
     * @var text $detail
     *
     * @ORM\Column(name="detail", type="text", nullable="true")
     */
    private $detail;

    /**
     * @var string $contact_name
     *
     * @ORM\Column(name="contact_name", type="string", length=127)
     */
    private $contact_name;

    /**
     * @var string $contact_email
     *
     * @ORM\Column(name="contact_email", type="string", length=127)
     */
    private $contact_email;

    /**
     * @var string $website
     *
     * @ORM\Column(name="website", type="string", length=127, nullable="true")
     */
    private $website;

    /**
     * @var string $month_stay
     *
     * @ORM\Column(name="month_stay", type="string", length=127)
     */
    private $month_stay;

    /**
     * @var float $water_unit
     *
     * @ORM\Column(name="water_unit", type="float")
     */
    private $water_unit;

    /**
     * @var float $electricity_unit
     *
     * @ORM\Column(name="electricity_unit", type="float")
     */
    private $electricity_unit;

    /**
     * @var integer $internet_price
     *
     * @ORM\Column(name="internet_price", type="integer", nullable="true")
     */
    private $internet_price;

    /**
     * @var string $googlemap_url
     *
     * @ORM\Column(name="googlemap_url", type="string", length=255, nullable="true")
     */
    private $googlemap_url;

    /**
     * @var boolean $internet_ready
     *
     * @ORM\Column(name="internet_ready", type="boolean", nullable="true")
     */
    private $internet_ready;

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
     * @param integer $publish
     */
    public function setPublish($publish)
    {
        $this->publish = $publish;
    }

    /**
     * Get publish
     *
     * @return integer 
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
     * Set detail
     *
     * @param text $detail
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
    }

    /**
     * Get detail
     *
     * @return text 
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Set contact_name
     *
     * @param string $contact_name
     */
    public function setContactName($contact_name)
    {
        $this->contact_name = $contact_name;
    }

    /**
     * Get contact_name
     *
     * @return string 
     */
    public function getContactName()
    {
        return $this->contact_name;
    }

    /**
     * Set contact_email
     *
     * @param string $contact_email
     */
    public function setContactEmail($contact_email)
    {
        $this->contact_email = $contact_email;
    }

    /**
     * Get contact_email
     *
     * @return string 
     */
    public function getContactEmail()
    {
        return $this->contact_email;
    }

    /**
     * Set website
     *
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set month_stay
     *
     * @param string $month_stay
     */
    public function setMonthStay($month_stay)
    {
        $this->month_stay = $month_stay;
    }

    /**
     * Get month_stay
     *
     * @return string 
     */
    public function getMonthStay()
    {
        return $this->month_stay;
    }

    /**
     * Set water_unit
     *
     * @param float $water_unit
     */
    public function setWaterUnit($waterUnit)
    {
        $this->water_unit = $waterUnit;
    }

    /**
     * Get water_unit
     *
     * @return float 
     */
    public function getWaterUnit()
    {
        return $this->water_unit;
    }

    /**
     * Set electricity_unit
     *
     * @param float $electricity_unit
     */
    public function setElectricityUnit($electricityUnit)
    {
        $this->electricity_unit = $electricityUnit;
    }

    /**
     * Get electricity_unit
     *
     * @return float 
     */
    public function getElectricityUnit()
    {
        return $this->electricity_unit;
    }

    /**
     * Set internet_price
     *
     * @param integer $internet_price
     */
    public function setInternetPrice($internetPrice)
    {
        $this->internet_price = $internetPrice;
    }

    /**
     * Get internet_price
     *
     * @return integer 
     */
    public function getInternetPrice()
    {
        return $this->internet_price;
    }

    /**
     * Set googlemap_url
     *
     * @param integer $googlemap_url
     */
    public function setGoogleMapUrl($googlemapUrl)
    {
        $this->googlemap_url = $googlemapUrl;
    }

    /**
     * Get googlemap_url
     *
     * @return integer 
     */
    public function getGoogleMapUrl()
    {
        return $this->googlemap_url;
    }

    /**
     * Set internet_ready
     *
     * @param boolean $internet_ready
     */
    public function setInternetReady($internet_ready)
    {
        $this->internet_ready = $internet_ready;
    }

    /**
     * Get internet_ready
     *
     * @return boolean 
     */
    public function getInternetReady()
    {
        return $this->internet_ready;
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