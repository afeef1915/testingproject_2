<?php

namespace ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EservVContactEmail
 */
class EservVContactEmail
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $contactId;

    /**
     * @var string
     */
    private $contactDisplayName;

    /**
     * @var string
     */
    private $applicationCodeCode;

    /**
     * @var string
     */
    private $applicationCodeName;

    /**
     * @var integer
     */
    private $emailId;

    /**
     * @var string
     */
    private $emailAddress;

    /**
     * @var integer
     */
    private $emailTypeId;

    /**
     * @var string
     */
    private $primaryRecord;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $createdBy;


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
     * Set contactId
     *
     * @param integer $contactId
     * @return EservVContactEmail
     */
    public function setContactId($contactId)
    {
        $this->contactId = $contactId;

        return $this;
    }

    /**
     * Get contactId
     *
     * @return integer 
     */
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * Set contactDisplayName
     *
     * @param string $contactDisplayName
     * @return EservVContactEmail
     */
    public function setContactDisplayName($contactDisplayName)
    {
        $this->contactDisplayName = $contactDisplayName;

        return $this;
    }

    /**
     * Get contactDisplayName
     *
     * @return string 
     */
    public function getContactDisplayName()
    {
        return $this->contactDisplayName;
    }

    /**
     * Set applicationCodeCode
     *
     * @param string $applicationCodeCode
     * @return EservVContactEmail
     */
    public function setApplicationCodeCode($applicationCodeCode)
    {
        $this->applicationCodeCode = $applicationCodeCode;

        return $this;
    }

    /**
     * Get applicationCodeCode
     *
     * @return string 
     */
    public function getApplicationCodeCode()
    {
        return $this->applicationCodeCode;
    }

    /**
     * Set applicationCodeName
     *
     * @param string $applicationCodeName
     * @return EservVContactEmail
     */
    public function setApplicationCodeName($applicationCodeName)
    {
        $this->applicationCodeName = $applicationCodeName;

        return $this;
    }

    /**
     * Get applicationCodeName
     *
     * @return string 
     */
    public function getApplicationCodeName()
    {
        return $this->applicationCodeName;
    }

    /**
     * Set emailId
     *
     * @param integer $emailId
     * @return EservVContactEmail
     */
    public function setEmailId($emailId)
    {
        $this->emailId = $emailId;

        return $this;
    }

    /**
     * Get emailId
     *
     * @return integer 
     */
    public function getEmailId()
    {
        return $this->emailId;
    }

    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     * @return EservVContactEmail
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * Get emailAddress
     *
     * @return string 
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * Set emailTypeId
     *
     * @param integer $emailTypeId
     * @return EservVContactEmail
     */
    public function setEmailTypeId($emailTypeId)
    {
        $this->emailTypeId = $emailTypeId;

        return $this;
    }

    /**
     * Get emailTypeId
     *
     * @return integer 
     */
    public function getEmailTypeId()
    {
        return $this->emailTypeId;
    }

    /**
     * Set primaryRecord
     *
     * @param string $primaryRecord
     * @return EservVContactEmail
     */
    public function setPrimaryRecord($primaryRecord)
    {
        $this->primaryRecord = $primaryRecord;

        return $this;
    }

    /**
     * Get primaryRecord
     *
     * @return string 
     */
    public function getPrimaryRecord()
    {
        return $this->primaryRecord;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return EservVContactEmail
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
     * @param string $createdBy
     * @return EservVContactEmail
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return string 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }
    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $referenceNo;


    /**
     * Set firstName
     *
     * @param string $firstName
     * @return EservVContactEmail
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return EservVContactEmail
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set referenceNo
     *
     * @param string $referenceNo
     * @return EservVContactEmail
     */
    public function setReferenceNo($referenceNo)
    {
        $this->referenceNo = $referenceNo;

        return $this;
    }

    /**
     * Get referenceNo
     *
     * @return string 
     */
    public function getReferenceNo()
    {
        return $this->referenceNo;
    }
}
