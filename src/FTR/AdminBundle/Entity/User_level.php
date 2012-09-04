<?php

namespace FTR\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FTR\AdminBundle\Entity\User_level
 *
 * @ORM\Table(name="user_level")
 * @ORM\Entity(repositoryClass="FTR\AdminBundle\Entity\User_levelRepository")
 */
class User_level
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
     * @var string $level_name
     *
     * @ORM\Column(name="level_name", type="string", length=255)
     */
    private $level_name;

    /**
     * @var string $level_type
     *
     * @ORM\Column(name="level_type", type="string", length=255)
     */
    private $level_type;

    /**
     * @var boolean $is_enabled
     *
     * @ORM\Column(name="is_enabled", type="boolean", nullable="true")
     */
    private $is_enabled;


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
     * Set level_name
     *
     * @param string $levelName
     */
    public function setLevelName($levelName)
    {
        $this->level_name = $levelName;
    }

    /**
     * Get level_name
     *
     * @return string 
     */
    public function getLevelName()
    {
        return $this->level_name;
    }

    /**
     * Set level_type
     *
     * @param string $levelType
     */
    public function setLevelType($levelType)
    {
        $this->level_type = $levelType;
    }

    /**
     * Get level_type
     *
     * @return string 
     */
    public function getLevelType()
    {
        return $this->level_type;
    }

    /**
     * Set is_enabled
     *
     * @param boolean $isEnabled
     */
    public function setIsEnabled($isEnabled)
    {
        $this->is_enabled = $isEnabled;
    }

    /**
     * Get is_enabled
     *
     * @return boolean 
     */
    public function getIsEnabled()
    {
        return $this->is_enabled;
    }
}