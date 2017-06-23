<?php

namespace ESERV\MAIN\DocumentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactDocAccess
 */
class ContactDocAccess
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $signOffAccess;

    /**
     * @var string
     */
    private $updateAccess;

    /**
     * @var string
     */
    private $viewAccess;

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
     * @var \ESERV\MAIN\DocumentBundle\Entity\ContactDoc
     */
    private $contactDoc;

    /**
     * @var \ESERV\MAIN\SecurityBundle\Entity\Group
     */
    private $fosGroup;


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
     * Set signOffAccess
     *
     * @param string $signOffAccess
     * @return ContactDocAccess
     */
    public function setSignOffAccess($signOffAccess)
    {
        $this->signOffAccess = $signOffAccess;

        return $this;
    }

    /**
     * Get signOffAccess
     *
     * @return string 
     */
    public function getSignOffAccess()
    {
        return $this->signOffAccess;
    }

    /**
     * Set updateAccess
     *
     * @param string $updateAccess
     * @return ContactDocAccess
     */
    public function setUpdateAccess($updateAccess)
    {
        $this->updateAccess = $updateAccess;

        return $this;
    }

    /**
     * Get updateAccess
     *
     * @return string 
     */
    public function getUpdateAccess()
    {
        return $this->updateAccess;
    }

    /**
     * Set viewAccess
     *
     * @param string $viewAccess
     * @return ContactDocAccess
     */
    public function setViewAccess($viewAccess)
    {
        $this->viewAccess = $viewAccess;

        return $this;
    }

    /**
     * Get viewAccess
     *
     * @return string 
     */
    public function getViewAccess()
    {
        return $this->viewAccess;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ContactDocAccess
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
     * @return ContactDocAccess
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
     * @return ContactDocAccess
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
     * @return ContactDocAccess
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
     * Set contactDoc
     *
     * @param \ESERV\MAIN\DocumentBundle\Entity\ContactDoc $contactDoc
     * @return ContactDocAccess
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

    /**
     * Set fosGroup
     *
     * @param \ESERV\MAIN\SecurityBundle\Entity\Group $fosGroup
     * @return ContactDocAccess
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
     * @var \DateTime
     */
    private $signOffDate;

    /**
     * @var \ESERV\MAIN\ContactBundle\Entity\Contact
     */
    private $contact;


    /**
     * Set signOffDate
     *
     * @param \DateTime $signOffDate
     * @return ContactDocAccess
     */
    public function setSignOffDate($signOffDate)
    {
        $this->signOffDate = $signOffDate;

        return $this;
    }

    /**
     * Get signOffDate
     *
     * @return \DateTime 
     */
    public function getSignOffDate()
    {
        return $this->signOffDate;
    }    
    /**
     * @var \ESERV\MAIN\ContactBundle\Entity\Contact
     */
    private $signOffContact;


    /**
     * Set signOffContact
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\Contact $signOffContact
     * @return ContactDocAccess
     */
    public function setSignOffContact(\ESERV\MAIN\ContactBundle\Entity\Contact $signOffContact = null)
    {
        $this->signOffContact = $signOffContact;

        return $this;
    }

    /**
     * Get signOffContact
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\Contact 
     */
    public function getSignOffContact()
    {
        return $this->signOffContact;
    }
}
