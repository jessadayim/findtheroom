<?php

namespace FTR\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTR\AdminBundle\Entity\Ftr_logdetail
 *
 * @ORM\Table(name="ftr_logdetail")
 * @ORM\Entity(repositoryClass="FTR\AdminBundle\Repository\Ftr_logdetailRepository")
 */
class Ftr_logdetail
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
     * @var integer $ftr_log_id
     *
     * @ORM\Column(name="ftr_log_id", type="integer")
     */
    private $ftr_log_id;

    /**
     * @var string $action
     *
     * @ORM\Column(name="action", type="string", length=255)
     */
    private $action;

    /**
     * @var string $fieldname
     *
     * @ORM\Column(name="fieldname", type="string", length=255)
     */
    private $fieldname;

    /**
     * @var text $fieldvalue
     *
     * @ORM\Column(name="fieldvalue", type="text")
     */
    private $fieldvalue;


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
     * Set ftr_log_id
     *
     * @param integer $ftrLogId
     */
    public function setFtrLogId($ftrLogId)
    {
        $this->ftr_log_id = $ftrLogId;
    }

    /**
     * Get ftr_log_id
     *
     * @return integer 
     */
    public function getFtrLogId()
    {
        return $this->ftr_log_id;
    }

    /**
     * Set action
     *
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set fieldname
     *
     * @param string $fieldname
     */
    public function setFieldname($fieldname)
    {
        $this->fieldname = $fieldname;
    }

    /**
     * Get fieldname
     *
     * @return string 
     */
    public function getFieldname()
    {
        return $this->fieldname;
    }

    /**
     * Set fieldvalue
     *
     * @param text $fieldvalue
     */
    public function setFieldvalue($fieldvalue)
    {
        $this->fieldvalue = $fieldvalue;
    }

    /**
     * Get fieldvalue
     *
     * @return text 
     */
    public function getFieldvalue()
    {
        return $this->fieldvalue;
    }
}