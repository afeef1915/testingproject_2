<?php

namespace ESERV\MAIN\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 */
class Contact
{    
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $displayName;

    /**
     * @var \DateTime
     */
    private $statusDate;

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
     * @var \ESERV\MAIN\ContactBundle\Entity\ContactStatus
     */
    private $contactStatus;

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
     * Set displayName
     *
     * @param string $displayName
     * @return Contact
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get displayName
     *
     * @return string 
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set statusDate
     *
     * @param \DateTime $statusDate
     * @return Contact
     */
    public function setStatusDate($statusDate)
    {
        $this->statusDate = $statusDate;

        return $this;
    }

    /**
     * Get statusDate
     *
     * @return \DateTime 
     */
    public function getStatusDate()
    {
        return $this->statusDate;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Contact
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
     * @return Contact
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
     * @return Contact
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
     * @return Contact
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
     * Set contactStatus
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactStatus $contactStatus
     * @return Contact
     */
    public function setContactStatus(\ESERV\MAIN\ContactBundle\Entity\ContactStatus $contactStatus = null)
    {
        $this->contactStatus = $contactStatus;

        return $this;
    }

    /**
     * Get contactStatus
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\ContactStatus 
     */
    public function getContactStatus()
    {
        return $this->contactStatus;
    }

    /**
     * Set contactType
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactType $contactType
     * @return Contact
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
