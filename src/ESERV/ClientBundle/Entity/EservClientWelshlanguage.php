<?php

namespace ESERV\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EservClientWelshlanguage
 */
class EservClientWelshlanguage
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
     * @return EservClientWelshlanguage
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
    private $welshspeaker;


    /**
     * Set welshspeaker
     *
     * @param string $welshspeaker
     * @return EservClientWelshlanguage
     */
    public function setWelshspeaker($welshspeaker)
    {
        $this->welshspeaker = $welshspeaker;

        return $this;
    }

    /**
     * Get welshspeaker
     *
     * @return string 
     */
    public function getWelshspeaker()
    {
        return $this->welshspeaker;
    }
    /**
     * @var string
     */
    private $welshmediumteacher;


    /**
     * Set welshmediumteacher
     *
     * @param string $welshmediumteacher
     * @return EservClientWelshlanguage
     */
    public function setWelshmediumteacher($welshmediumteacher)
    {
        $this->welshmediumteacher = $welshmediumteacher;

        return $this;
    }

    /**
     * Get welshmediumteacher
     *
     * @return string 
     */
    public function getWelshmediumteacher()
    {
        return $this->welshmediumteacher;
    }
    /**
     * @var string
     */
    private $welsh2ndlanguage;


    /**
     * Set welsh2ndlanguage
     *
     * @param string $welsh2ndlanguage
     * @return EservClientWelshlanguage
     */
    public function setWelsh2ndlanguage($welsh2ndlanguage)
    {
        $this->welsh2ndlanguage = $welsh2ndlanguage;

        return $this;
    }

    /**
     * Get welsh2ndlanguage
     *
     * @return string 
     */
    public function getWelsh2ndlanguage()
    {
        return $this->welsh2ndlanguage;
    }
}
