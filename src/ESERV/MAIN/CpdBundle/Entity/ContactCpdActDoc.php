<?php

namespace ESERV\MAIN\CpdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactCpdActDoc
 */
class ContactCpdActDoc
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $cpdDocLibTitle;

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
     * @var \ESERV\MAIN\CpdBundle\Entity\ContactCpdAct
     */
    private $contactCpdAct;

    /**
     * @var \ESERV\MAIN\CpdBundle\Entity\ContactCpdDocLib
     */
    private $contactCpdDocLib;


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
     * Set cpdDocLibTitle
     *
     * @param string $cpdDocLibTitle
     * @return ContactCpdActDoc
     */
    public function setCpdDocLibTitle($cpdDocLibTitle)
    {
        $this->cpdDocLibTitle = $cpdDocLibTitle;

        return $this;
    }

    /**
     * Get cpdDocLibTitle
     *
     * @return string 
     */
    public function getCpdDocLibTitle()
    {
        return $this->cpdDocLibTitle;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ContactCpdActDoc
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
     * @return ContactCpdActDoc
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
     * @return ContactCpdActDoc
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
     * @return ContactCpdActDoc
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
     * Set contactCpdAct
     *
     * @param \ESERV\MAIN\CpdBundle\Entity\ContactCpdAct $contactCpdAct
     * @return ContactCpdActDoc
     */
    public function setContactCpdAct(\ESERV\MAIN\CpdBundle\Entity\ContactCpdAct $contactCpdAct = null)
    {
        $this->contactCpdAct = $contactCpdAct;

        return $this;
    }

    /**
     * Get contactCpdAct
     *
     * @return \ESERV\MAIN\CpdBundle\Entity\ContactCpdAct 
     */
    public function getContactCpdAct()
    {
        return $this->contactCpdAct;
    }

    /**
     * Set contactCpdDocLib
     *
     * @param \ESERV\MAIN\CpdBundle\Entity\ContactCpdDocLib $contactCpdDocLib
     * @return ContactCpdActDoc
     */
    public function setContactCpdDocLib(\ESERV\MAIN\CpdBundle\Entity\ContactCpdDocLib $contactCpdDocLib = null)
    {
        $this->contactCpdDocLib = $contactCpdDocLib;

        return $this;
    }

    /**
     * Get contactCpdDocLib
     *
     * @return \ESERV\MAIN\CpdBundle\Entity\ContactCpdDocLib 
     */
    public function getContactCpdDocLib()
    {
        return $this->contactCpdDocLib;
    }
}
