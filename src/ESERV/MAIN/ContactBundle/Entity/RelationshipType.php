<?php

namespace ESERV\MAIN\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RelationshipType
 */
class RelationshipType
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nameAB;

    /**
     * @var string
     */
    private $nameBA;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $maxAllowed;

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
     * @var \ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList
     */
    private $contactSubtypeA;

    /**
     * @var \ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList
     */
    private $contactSubtypeB;

    /**
     * @var \ESERV\MAIN\ContactBundle\Entity\ContactType
     */
    private $contactTypeA;

    /**
     * @var \ESERV\MAIN\ContactBundle\Entity\ContactType
     */
    private $contactTypeB;


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
     * Set nameAB
     *
     * @param string $nameAB
     * @return RelationshipType
     */
    public function setNameAB($nameAB)
    {
        $this->nameAB = $nameAB;

        return $this;
    }

    /**
     * Get nameAB
     *
     * @return string 
     */
    public function getNameAB()
    {
        return $this->nameAB;
    }

    /**
     * Set nameBA
     *
     * @param string $nameBA
     * @return RelationshipType
     */
    public function setNameBA($nameBA)
    {
        $this->nameBA = $nameBA;

        return $this;
    }

    /**
     * Get nameBA
     *
     * @return string 
     */
    public function getNameBA()
    {
        return $this->nameBA;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return RelationshipType
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set maxAllowed
     *
     * @param integer $maxAllowed
     * @return RelationshipType
     */
    public function setMaxAllowed($maxAllowed)
    {
        $this->maxAllowed = $maxAllowed;

        return $this;
    }

    /**
     * Get maxAllowed
     *
     * @return integer 
     */
    public function getMaxAllowed()
    {
        return $this->maxAllowed;
    }

    /**
     * Set inUse
     *
     * @param string $inUse
     * @return RelationshipType
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
     * @return RelationshipType
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
     * @return RelationshipType
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
     * @return RelationshipType
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
     * @return RelationshipType
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
     * @return RelationshipType
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
     * Set contactSubtypeA
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList $contactSubtypeA
     * @return RelationshipType
     */
    public function setContactSubtypeA(\ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList $contactSubtypeA = null)
    {
        $this->contactSubtypeA = $contactSubtypeA;

        return $this;
    }

    /**
     * Get contactSubtypeA
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList 
     */
    public function getContactSubtypeA()
    {
        return $this->contactSubtypeA;
    }

    /**
     * Set contactSubtypeB
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList $contactSubtypeB
     * @return RelationshipType
     */
    public function setContactSubtypeB(\ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList $contactSubtypeB = null)
    {
        $this->contactSubtypeB = $contactSubtypeB;

        return $this;
    }

    /**
     * Get contactSubtypeB
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList 
     */
    public function getContactSubtypeB()
    {
        return $this->contactSubtypeB;
    }

    /**
     * Set contactTypeA
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactType $contactTypeA
     * @return RelationshipType
     */
    public function setContactTypeA(\ESERV\MAIN\ContactBundle\Entity\ContactType $contactTypeA = null)
    {
        $this->contactTypeA = $contactTypeA;

        return $this;
    }

    /**
     * Get contactTypeA
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\ContactType 
     */
    public function getContactTypeA()
    {
        return $this->contactTypeA;
    }

    /**
     * Set contactTypeB
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactType $contactTypeB
     * @return RelationshipType
     */
    public function setContactTypeB(\ESERV\MAIN\ContactBundle\Entity\ContactType $contactTypeB = null)
    {
        $this->contactTypeB = $contactTypeB;

        return $this;
    }

    /**
     * Get contactTypeB
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\ContactType 
     */
    public function getContactTypeB()
    {
        return $this->contactTypeB;
    }
    /**
     * @var \ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList
     */
    private $contactSubtypeListA;

    /**
     * @var \ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList
     */
    private $contactSubtypeListB;


    /**
     * Set contactSubtypeListA
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList $contactSubtypeListA
     * @return RelationshipType
     */
    public function setContactSubtypeListA(\ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList $contactSubtypeListA = null)
    {
        $this->contactSubtypeListA = $contactSubtypeListA;

        return $this;
    }

    /**
     * Get contactSubtypeListA
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList 
     */
    public function getContactSubtypeListA()
    {
        return $this->contactSubtypeListA;
    }

    /**
     * Set contactSubtypeListB
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList $contactSubtypeListB
     * @return RelationshipType
     */
    public function setContactSubtypeListB(\ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList $contactSubtypeListB = null)
    {
        $this->contactSubtypeListB = $contactSubtypeListB;

        return $this;
    }

    /**
     * Get contactSubtypeListB
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList 
     */
    public function getContactSubtypeListB()
    {
        return $this->contactSubtypeListB;
    }
    /**
     * @var string
     */
    private $contactBEUser;


    /**
     * Set contactBEUser
     *
     * @param string $contactBEUser
     * @return RelationshipType
     */
    public function setContactBEUser($contactBEUser)
    {
        $this->contactBEUser = $contactBEUser;

        return $this;
    }

    /**
     * Get contactBEUser
     *
     * @return string 
     */
    public function getContactBEUser()
    {
        return $this->contactBEUser;
    }
    /**
     * @var \ESERV\MAIN\SecurityBundle\Entity\Group
     */
    private $fosGroup;


    /**
     * Set fosGroup
     *
     * @param \ESERV\MAIN\SecurityBundle\Entity\Group $fosGroup
     * @return RelationshipType
     */
    public function setFosGroup(\ESERV\MAIN\SecurityBundle\Entity\Group $fosGroup = null)
    {
        $this->fosGroup = $fosGroup;

        return $this;
    }

    /**
     * Get fosGroup
     *
     * @return \ESERV\MAIN\SecurityBundle\Entity\Group 
     */
    public function getFosGroup()
    {
        return $this->fosGroup;
    }
}
