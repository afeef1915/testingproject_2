<?php

namespace ESERV\MAIN\CpdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactCpdStatusDetail
 */
class ContactCpdStatusDetail
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $conCpdStatusText;

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
     * @var \ESERV\MAIN\CpdBundle\Entity\ContactCpdStatus
     */
    private $contactCpdStatus;

    /**
     * @var \ESERV\MAIN\CpdBundle\Entity\CpdStatusDetail
     */
    private $cpdStatusDetail;


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
     * Set conCpdStatusText
     *
     * @param string $conCpdStatusText
     * @return ContactCpdStatusDetail
     */
    public function setConCpdStatusText($conCpdStatusText)
    {
        $this->conCpdStatusText = $conCpdStatusText;

        return $this;
    }

    /**
     * Get conCpdStatusText
     *
     * @return string 
     */
    public function getConCpdStatusText()
    {
        return $this->conCpdStatusText;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ContactCpdStatusDetail
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
     * @return ContactCpdStatusDetail
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
     * @return ContactCpdStatusDetail
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
     * @return ContactCpdStatusDetail
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
     * Set contactCpdStatus
     *
     * @param \ESERV\MAIN\CpdBundle\Entity\ContactCpdStatus $contactCpdStatus
     * @return ContactCpdStatusDetail
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

    /**
     * Set cpdStatusDetail
     *
     * @param \ESERV\MAIN\CpdBundle\Entity\CpdStatusDetail $cpdStatusDetail
     * @return ContactCpdStatusDetail
     */
    public function setCpdStatusDetail(\ESERV\MAIN\CpdBundle\Entity\CpdStatusDetail $cpdStatusDetail = null)
    {
        $this->cpdStatusDetail = $cpdStatusDetail;

        return $this;
    }

    /**
     * Get cpdStatusDetail
     *
     * @return \ESERV\MAIN\CpdBundle\Entity\CpdStatusDetail 
     */
    public function getCpdStatusDetail()
    {
        return $this->cpdStatusDetail;
    }
}
