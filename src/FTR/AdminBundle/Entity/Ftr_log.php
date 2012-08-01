<?php

namespace FTR\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTR\AdminBundle\Entity\Ftr_log
 *
 * @ORM\Table(name="ftr_log")
 * @ORM\Entity(repositoryClass="FTR\AdminBundle\Repository\Ftr_logRepository")
 */
class Ftr_log
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
     * @var string $tablename
     *
     * @ORM\Column(name="tablename", type="string", length=255)
     */
    private $tablename;

    /**
     * @var string $username
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string $user_type
     *
     * @ORM\Column(name="user_type", type="string", length=255)
     */
    private $user_type;

    /**
     * @var datetime $datetimestamp
     *
     * @ORM\Column(name="datetimestamp", type="datetime")
     */
    private $datetimestamp;

    /**
     * @var integer $pk_id
     *
     * @ORM\Column(name="pk_id", type="integer")
     */
    private $pk_id;


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
     * Set tablename
     *
     * @param string $tablename
     */
    public function setTablename($tablename)
    {
        $this->tablename = $tablename;
    }

    /**
     * Get tablename
     *
     * @return string 
     */
    public function getTablename()
    {
        return $this->tablename;
    }

    /**
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set user_type
     *
     * @param string $userType
     */
    public function setUserType($userType)
    {
        $this->user_type = $userType;
    }

    /**
     * Get user_type
     *
     * @return string 
     */
    public function getUserType()
    {
        return $this->user_type;
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
     * Set pk_id
     *
     * @param integer $pkId
     */
    public function setPkId($pkId)
    {
        $this->pk_id = $pkId;
    }

    /**
     * Get pk_id
     *
     * @return integer 
     */
    public function getPkId()
    {
        return $this->pk_id;
    }
}