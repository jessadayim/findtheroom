<?php

namespace FTR\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTR\WebBundle\Entity\Building_type
 *
 * @ORM\Table(name="building_type")
 * @ORM\Entity(repositoryClass="FTR\WebBundle\Repository\Building_typeRepository")
 */
class Building_type
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
     * @var string $type_name
     *
     * @ORM\Column(name="type_name", type="string", length=255)
     */
    private $type_name;

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
     * Set type_name
     *
     * @param string $typeName
     */
    public function setTypeName($typeName)
    {
        $this->type_name = $typeName;
    }

    /**
     * Get type_name
     *
     * @return string 
     */
    public function getTypeName()
    {
        return $this->type_name;
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