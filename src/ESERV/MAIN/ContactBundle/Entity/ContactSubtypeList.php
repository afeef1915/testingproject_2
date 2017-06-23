<?php

namespace ESERV\MAIN\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactSubtypeList
 */
class ContactSubtypeList
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
     * @var string
     */
    private $inUse;

    /**
     * @var string
     */
    private $userRestrict;

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
     * @return ContactSubtypeList
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
     * @return ContactSubtypeList
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
     * Set inUse
     *
     * @param string $inUse
     * @return ContactSubtypeList
     */
    public function setInUse($inUse)
    {
        $this->inUse = $inUse;

        return $this;
    }

    /**
     * Get inUse
     *
     * @return string 
     */
    public function getInUse()
    {
        return $this->inUse;
    }

    /**
     * Set userRestrict
     *
     * @param string $userRestrict
     * @return ContactSubtypeList
     */
    public function setUserRestrict($userRestrict)
    {
        $this->userRestrict = $userRestrict;

        return $this;
    }

    /**
     * Get userRestrict
     *
     * @return string 
     */
    public function getUserRestrict()
    {
        return $this->userRestrict;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ContactSubtypeList
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
     * @return ContactSubtypeList
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
     * @return ContactSubtypeList
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
     * @return ContactSubtypeList
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
     * @return ContactSubtypeList
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
    
    public function __toString()
    {
        return (string)$this->id;
    }
}
