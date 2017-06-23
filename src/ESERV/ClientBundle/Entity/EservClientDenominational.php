<?php

namespace ESERV\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EservClientDenominational
 */
class EservClientDenominational
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $entityId;


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
     * Set entityId
     *
     * @param integer $entityId
     * @return EservClientDenominational
     */
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;

        return $this;
    }

    /**
     * Get entityId
     *
     * @return integer 
     */
    public function getEntityId()
    {
        return $this->entityId;
    }
    
    /**
     * @var string
     */
    private $welshmediumschool;


    /**
     * Set welshmediumschool
     *
     * @param string $welshmediumschool
     * @return EservClientDenominational
     */
    public function setWelshmediumschool($welshmediumschool)
    {
        $this->welshmediumschool = $welshmediumschool;

        return $this;
    }

    /**
     * Get welshmediumschool
     *
     * @return string 
     */
    public function getWelshmediumschool()
    {
        return $this->welshmediumschool;
    }
}
