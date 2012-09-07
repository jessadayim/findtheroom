<?php

namespace FTR\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTR\AdminBundle\Entity\Banner_count
 *
 * @ORM\Table(name="banner_count")
 * @ORM\Entity(repositoryClass="FTR\AdminBundle\Repository\Banner_countRepository")
 */
class Banner_count
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
     * @var string $refname
     *
     * @ORM\Column(name="refname", type="string", length=64)
     */
    private $refname;

    /**
     * @var string $refurl
     *
     * @ORM\Column(name="refurl", type="string", length=255)
     */
    private $refurl;

    /**
     * @var string $ipaddr
     *
     * @ORM\Column(name="ipaddr", type="string", length=32)
     */
    private $ipaddr;

    /**
     * @var datetime $datetimestamp
     *
     * @ORM\Column(name="datetimestamp", type="datetime")
     */
    private $datetimestamp;


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
     * Set refname
     *
     * @param string $refname
     */
    public function setRefname($refname)
    {
        $this->refname = $refname;
    }

    /**
     * Get refname
     *
     * @return string 
     */
    public function getRefname()
    {
        return $this->refname;
    }

    /**
     * Set refurl
     *
     * @param string $refurl
     */
    public function setRefurl($refurl)
    {
        $this->refurl = $refurl;
    }

    /**
     * Get refurl
     *
     * @return string 
     */
    public function getRefurl()
    {
        return $this->refurl;
    }

    /**
     * Set ipaddr
     *
     * @param string $ipaddr
     */
    public function setIpaddr($ipaddr)
    {
        $this->ipaddr = $ipaddr;
    }

    /**
     * Get ipaddr
     *
     * @return string 
     */
    public function getIpaddr()
    {
        return $this->ipaddr;
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
}