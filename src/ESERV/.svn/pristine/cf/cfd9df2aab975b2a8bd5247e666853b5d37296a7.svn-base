<?php

namespace ESERV\MAIN\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactStatus
 */
class ContactStatus
{ 
    
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $createdBy;

    /**
     * @var integer
     */
    private $updatedBy;

    /**
     * @var \ESERV\MAIN\ContactBundle\Entity\ContactType
     */
    private $contactType;

    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode
     */
    private $statusType;

    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\MtlColour
     */
    private $mtlColour;


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
     * Set code
     *
     * @param string $code
     * @return ContactStatus
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ContactStatus
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ContactStatus
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return ContactStatus
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return ContactStatus
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return integer 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param integer $updatedBy
     * @return ContactStatus
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return integer 
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set contactType
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactType $contactType
     * @return ContactStatus
     */
    public function setContactType(\ESERV\MAIN\ContactBundle\Entity\ContactType $contactType = null)
    {
        $this->contactType = $contactType;

        return $this;
    }

    /**
     * Get contactType
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\ContactType 
     */
    public function getContactType()
    {
        return $this->contactType;
    }

    /**
     * Set statusType
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $statusType
     * @return ContactStatus
     */
    public function setStatusType(\ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $statusType = null)
    {
        $this->statusType = $statusType;

        return $this;
    }

    /**
     * Get statusType
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode 
     */
    public function getStatusType()
    {
        return $this->statusType;
    }

    /**
     * Set mtlColour
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\MtlColour $mtlColour
     * @return ContactStatus
     */
    public function setMtlColour(\ESERV\MAIN\SystemConfigBundle\Entity\MtlColour $mtlColour = null)
    {
        $this->mtlColour = $mtlColour;

        return $this;
    }

    /**
     * Get mtlColour
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\MtlColour 
     */
    public function getMtlColour()
    {
        return $this->mtlColour;
    }
    
    public function __toString()
    {
        return $this->code;
    }
}
