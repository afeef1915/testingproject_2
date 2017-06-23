<?php

namespace ESERV\MAIN\DocumentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactDocHist
 */
class ContactDocHist
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $version;

    /**
     * @var integer
     */
    private $orderBy;

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
     * @var \ESERV\MAIN\DocumentBundle\Entity\ContactDocStore
     */
    private $contactDocStore;

    /**
     * @var \ESERV\MAIN\DocumentBundle\Entity\ContactDocumentSubscription
     */
    private $conDocSub;

    /**
     * @var \ESERV\MAIN\DocumentBundle\Entity\DocumentMasterVersion
     */
    private $documentMasterVersion;


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
     * Set version
     *
     * @param integer $version
     * @return ContactDocHist
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set orderBy
     *
     * @param integer $orderBy
     * @return ContactDocHist
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;

        return $this;
    }

    /**
     * Get orderBy
     *
     * @return integer 
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ContactDocHist
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
     * @return ContactDocHist
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
     * @return ContactDocHist
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
     * @return ContactDocHist
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
     * Set contactDocStore
     *
     * @param \ESERV\MAIN\DocumentBundle\Entity\ContactDocStore $contactDocStore
     * @return ContactDocHist
     */
    public function setContactDocStore(\ESERV\MAIN\DocumentBundle\Entity\ContactDocStore $contactDocStore = null)
    {
        $this->contactDocStore = $contactDocStore;

        return $this;
    }

    /**
     * Get contactDocStore
     *
     * @return \ESERV\MAIN\DocumentBundle\Entity\ContactDocStore 
     */
    public function getContactDocStore()
    {
        return $this->contactDocStore;
    }

    /**
     * Set conDocSub
     *
     * @param \ESERV\MAIN\DocumentBundle\Entity\ContactDocumentSubscription $conDocSub
     * @return ContactDocHist
     */
    public function setConDocSub(\ESERV\MAIN\DocumentBundle\Entity\ContactDocumentSubscription $conDocSub = null)
    {
        $this->conDocSub = $conDocSub;

        return $this;
    }

    /**
     * Get conDocSub
     *
     * @return \ESERV\MAIN\DocumentBundle\Entity\ContactDocumentSubscription 
     */
    public function getConDocSub()
    {
        return $this->conDocSub;
    }

    /**
     * Set documentMasterVersion
     *
     * @param \ESERV\MAIN\DocumentBundle\Entity\DocumentMasterVersion $documentMasterVersion
     * @return ContactDocHist
     */
    public function setDocumentMasterVersion(\ESERV\MAIN\DocumentBundle\Entity\DocumentMasterVersion $documentMasterVersion = null)
    {
        $this->documentMasterVersion = $documentMasterVersion;

        return $this;
    }

    /**
     * Get documentMasterVersion
     *
     * @return \ESERV\MAIN\DocumentBundle\Entity\DocumentMasterVersion 
     */
    public function getDocumentMasterVersion()
    {
        return $this->documentMasterVersion;
    }
    /**
     * @var \ESERV\MAIN\DocumentBundle\Entity\ContactDoc
     */
    private $contactDoc;


    /**
     * Set contactDoc
     *
     * @param \ESERV\MAIN\DocumentBundle\Entity\ContactDoc $contactDoc
     * @return ContactDocHist
     */
    public function setContactDoc(\ESERV\MAIN\DocumentBundle\Entity\ContactDoc $contactDoc = null)
    {
        $this->contactDoc = $contactDoc;

        return $this;
    }

    /**
     * Get contactDoc
     *
     * @return \ESERV\MAIN\DocumentBundle\Entity\ContactDoc 
     */
    public function getContactDoc()
    {
        return $this->contactDoc;
    }
}
