<?php

namespace ESERV\MAIN\CpdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactCpdAct
 */
class ContactCpdAct
{  
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $cpdActTitle;

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
     * @var \ESERV\MAIN\CpdBundle\Entity\CpdActType
     */
    private $cpdActType;

    /**
     * @var \ESERV\MAIN\CpdBundle\Entity\CpdActCategory
     */
    private $cpdActCategory;


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
     * Set cpdActTitle
     *
     * @param string $cpdActTitle
     * @return ContactCpdAct
     */
    public function setCpdActTitle($cpdActTitle)
    {
        $this->cpdActTitle = $cpdActTitle;

        return $this;
    }

    /**
     * Get cpdActTitle
     *
     * @return string 
     */
    public function getCpdActTitle()
    {
        return $this->cpdActTitle;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ContactCpdAct
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
     * @return ContactCpdAct
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
     * @return ContactCpdAct
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
     * @return ContactCpdAct
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
     * @return ContactCpdAct
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
     * Set cpdActType
     *
     * @param \ESERV\MAIN\CpdBundle\Entity\CpdActType $cpdActType
     * @return ContactCpdAct
     */
    public function setCpdActType(\ESERV\MAIN\CpdBundle\Entity\CpdActType $cpdActType = null)
    {
        $this->cpdActType = $cpdActType;

        return $this;
    }

    /**
     * Get cpdActType
     *
     * @return \ESERV\MAIN\CpdBundle\Entity\CpdActType 
     */
    public function getCpdActType()
    {
        return $this->cpdActType;
    }

    /**
     * Set cpdActCategory
     *
     * @param \ESERV\MAIN\CpdBundle\Entity\CpdActCategory $cpdActCategory
     * @return ContactCpdAct
     */
    public function setCpdActCategory(\ESERV\MAIN\CpdBundle\Entity\CpdActCategory $cpdActCategory = null)
    {
        $this->cpdActCategory = $cpdActCategory;

        return $this;
    }

    /**
     * Get cpdActCategory
     *
     * @return \ESERV\MAIN\CpdBundle\Entity\CpdActCategory 
     */
    public function getCpdActCategory()
    {
        return $this->cpdActCategory;
    }
}
