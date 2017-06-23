<?php

namespace ESERV\MAIN\CpdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactCpdStatusHist
 */
class ContactCpdStatusHist
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $createdBy;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $updatedBy;

    /**
     * @var \ESERV\MAIN\ContactBundle\Entity\Contact
     */
    private $contact;

    /**
     * @var \ESERV\MAIN\CpdBundle\Entity\CpdStatus
     */
    private $cpdStatus;

    /**
     * @var \ESERV\MAIN\ContactBundle\Entity\ContactCpdStatus
     */
    private $contactCpdStatus;


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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ContactCpdStatusHist
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
     * Set createdBy
     *
     * @param integer $createdBy
     * @return ContactCpdStatusHist
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return ContactCpdStatusHist
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
     * Set updatedBy
     *
     * @param integer $updatedBy
     * @return ContactCpdStatusHist
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
     * Set contact
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\Contact $contact
     * @return ContactCpdStatusHist
     */
    public function setContact(\ESERV\MAIN\ContactBundle\Entity\Contact $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\Contact 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set cpdStatus
     *
     * @param \ESERV\MAIN\CpdBundle\Entity\CpdStatus $cpdStatus
     * @return ContactCpdStatusHist
     */
    public function setCpdStatus(\ESERV\MAIN\CpdBundle\Entity\CpdStatus $cpdStatus = null)
    {
        $this->cpdStatus = $cpdStatus;

        return $this;
    }

    /**
     * Get cpdStatus
     *
     * @return \ESERV\MAIN\CpdBundle\Entity\CpdStatus 
     */
    public function getCpdStatus()
    {
        return $this->cpdStatus;
    }

    /**
     * Set contactCpdStatus
     *
     * @param \ESERV\MAIN\CpdBundle\Entity\ContactCpdStatus $contactCpdStatus
     * @return ContactCpdStatusHist
     */
    public function setContactCpdStatus(\ESERV\MAIN\CpdBundle\Entity\ContactCpdStatus $contactCpdStatus = null)
    {
        $this->contactCpdStatus = $contactCpdStatus;

        return $this;
    }

    /**
     * Get contactCpdStatus
     *
     * @return \ESERV\MAIN\CpdBundle\Entity\ContactCpdStatus 
     */
    public function getContactCpdStatus()
    {
        return $this->contactCpdStatus;
    }
}
