<?php

namespace ESERV\MAIN\CpdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactCpdActDet
 */
class ContactCpdActDet
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $conCpdActText;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set conCpdActText
     *
     * @param string $conCpdActText
     * @return ContactCpdActDet
     */
    public function setConCpdActText($conCpdActText)
    {
        $this->conCpdActText = $conCpdActText;

        return $this;
    }

    /**
     * Get conCpdActText
     *
     * @return string 
     */
    public function getConCpdActText()
    {
        return $this->conCpdActText;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ContactCpdActDet
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
     * @return ContactCpdActDet
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
     * @return ContactCpdActDet
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
     * @return ContactCpdActDet
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
     * @return ContactCpdActDet
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
     * @var \ESERV\MAIN\CpdBundle\Entity\CpdActTypeDetail
     */
    private $cpdActTypeDetail;


    /**
     * Set cpdActTypeDetail
     *
     * @param \ESERV\MAIN\CpdBundle\Entity\CpdActTypeDetail $cpdActTypeDetail
     * @return ContactCpdActDet
     */
    public function setCpdActTypeDetail(\ESERV\MAIN\CpdBundle\Entity\CpdActTypeDetail $cpdActTypeDetail = null)
    {
        $this->cpdActTypeDetail = $cpdActTypeDetail;

        return $this;
    }

    /**
     * Get cpdActTypeDetail
     *
     * @return \ESERV\MAIN\CpdBundle\Entity\CpdActTypeDetail 
     */
    public function getCpdActTypeDetail()
    {
        return $this->cpdActTypeDetail;
    }
}
