<?php

namespace ESERV\MAIN\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserAlertFosGroup
 */
class UserAlertFosGroup
{
    
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $createdBy;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $updatedBy;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \ESERV\MAIN\SecurityBundle\Entity\Group
     */
    private $fosGroup;

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
     * Set createdBy
     *
     * @param integer $createdBy
     * @return UserAlertFosGroup
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return UserAlertFosGroup
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
     * Set updatedBy
     *
     * @param integer $updatedBy
     * @return UserAlertFosGroup
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return UserAlertFosGroup
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
     * Set fosGroup
     *
     * @param \ESERV\MAIN\SecurityBundle\Entity\Group $fosGroup
     * @return UserAlertFosGroup
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

    /**
     * Set contactType
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactType $contactType
     * @return UserAlertFosGroup
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
}
