<?php

namespace ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EservVEmail
 */
class EservVEmail
{
    /**
     * @var integer
     */
    private $dtindex;

    /**
     * @var integer
     */
    private $emailId;

    /**
     * @var integer
     */
    private $mtlAuditId;

    /**
     * @var integer
     */
    private $mtlDeletedRecordId;

    /**
     * @var integer
     */
    private $contactId;

    /**
     * @var string
     */
    private $contactDisplayName;

    /**
     * @var integer
     */
    private $emailTypeId;

    /**
     * @var string
     */
    private $emailTypeCode;

    /**
     * @var string
     */
    private $emailTypeName;

    /**
     * @var string
     */
    private $emailAddress;

    /**
     * @var string
     */
    private $oldEmailAddress;

    /**
     * @var string
     */
    private $newEmailAddress;

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
    private $createdByUsername;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     */
    private $updatedByUsername;

    /**
     * @var string
     */
    private $historyRecord;

    /**
     * @var string
     */
    private $deletedRecord;

    /**
     * @var \DateTime
     */
    private $deletedAt;

    /**
     * @var string
     */
    private $deletedByUsername;


    /**
     * Get dtindex
     *
     * @return integer 
     */
    public function getDtindex()
    {
        return $this->dtindex;
    }

    /**
     * Set emailId
     *
     * @param integer $emailId
     * @return EservVEmail
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
     * Set mtlAuditId
     *
     * @param integer $mtlAuditId
     * @return EservVEmail
     */
    public function setMtlAuditId($mtlAuditId)
    {
        $this->mtlAuditId = $mtlAuditId;

        return $this;
    }

    /**
     * Get mtlAuditId
     *
     * @return integer 
     */
    public function getMtlAuditId()
    {
        return $this->mtlAuditId;
    }

    /**
     * Set mtlDeletedRecordId
     *
     * @param integer $mtlDeletedRecordId
     * @return EservVEmail
     */
    public function setMtlDeletedRecordId($mtlDeletedRecordId)
    {
        $this->mtlDeletedRecordId = $mtlDeletedRecordId;

        return $this;
    }

    /**
     * Get mtlDeletedRecordId
     *
     * @return integer 
     */
    public function getMtlDeletedRecordId()
    {
        return $this->mtlDeletedRecordId;
    }

    /**
     * Set contactId
     *
     * @param integer $contactId
     * @return EservVEmail
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
     * @return EservVEmail
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
     * Set emailTypeId
     *
     * @param integer $emailTypeId
     * @return EservVEmail
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
     * Set emailTypeCode
     *
     * @param string $emailTypeCode
     * @return EservVEmail
     */
    public function setEmailTypeCode($emailTypeCode)
    {
        $this->emailTypeCode = $emailTypeCode;

        return $this;
    }

    /**
     * Get emailTypeCode
     *
     * @return string 
     */
    public function getEmailTypeCode()
    {
        return $this->emailTypeCode;
    }

    /**
     * Set emailTypeName
     *
     * @param string $emailTypeName
     * @return EservVEmail
     */
    public function setEmailTypeName($emailTypeName)
    {
        $this->emailTypeName = $emailTypeName;

        return $this;
    }

    /**
     * Get emailTypeName
     *
     * @return string 
     */
    public function getEmailTypeName()
    {
        return $this->emailTypeName;
    }

    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     * @return EservVEmail
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
     * Set oldEmailAddress
     *
     * @param string $oldEmailAddress
     * @return EservVEmail
     */
    public function setOldEmailAddress($oldEmailAddress)
    {
        $this->oldEmailAddress = $oldEmailAddress;

        return $this;
    }

    /**
     * Get oldEmailAddress
     *
     * @return string 
     */
    public function getOldEmailAddress()
    {
        return $this->oldEmailAddress;
    }

    /**
     * Set newEmailAddress
     *
     * @param string $newEmailAddress
     * @return EservVEmail
     */
    public function setNewEmailAddress($newEmailAddress)
    {
        $this->newEmailAddress = $newEmailAddress;

        return $this;
    }

    /**
     * Get newEmailAddress
     *
     * @return string 
     */
    public function getNewEmailAddress()
    {
        return $this->newEmailAddress;
    }

    /**
     * Set primaryRecord
     *
     * @param string $primaryRecord
     * @return EservVEmail
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
     * @return EservVEmail
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
     * Set createdByUsername
     *
     * @param string $createdByUsername
     * @return EservVEmail
     */
    public function setCreatedByUsername($createdByUsername)
    {
        $this->createdByUsername = $createdByUsername;

        return $this;
    }

    /**
     * Get createdByUsername
     *
     * @return string 
     */
    public function getCreatedByUsername()
    {
        return $this->createdByUsername;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return EservVEmail
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
     * Set updatedByUsername
     *
     * @param string $updatedByUsername
     * @return EservVEmail
     */
    public function setUpdatedByUsername($updatedByUsername)
    {
        $this->updatedByUsername = $updatedByUsername;

        return $this;
    }

    /**
     * Get updatedByUsername
     *
     * @return string 
     */
    public function getUpdatedByUsername()
    {
        return $this->updatedByUsername;
    }

    /**
     * Set historyRecord
     *
     * @param string $historyRecord
     * @return EservVEmail
     */
    public function setHistoryRecord($historyRecord)
    {
        $this->historyRecord = $historyRecord;

        return $this;
    }

    /**
     * Get historyRecord
     *
     * @return string 
     */
    public function getHistoryRecord()
    {
        return $this->historyRecord;
    }

    /**
     * Set deletedRecord
     *
     * @param string $deletedRecord
     * @return EservVEmail
     */
    public function setDeletedRecord($deletedRecord)
    {
        $this->deletedRecord = $deletedRecord;

        return $this;
    }

    /**
     * Get deletedRecord
     *
     * @return string 
     */
    public function getDeletedRecord()
    {
        return $this->deletedRecord;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     * @return EservVEmail
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime 
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set deletedByUsername
     *
     * @param string $deletedByUsername
     * @return EservVEmail
     */
    public function setDeletedByUsername($deletedByUsername)
    {
        $this->deletedByUsername = $deletedByUsername;

        return $this;
    }

    /**
     * Get deletedByUsername
     *
     * @return string 
     */
    public function getDeletedByUsername()
    {
        return $this->deletedByUsername;
    }
    /**
     * @var integer
     */
    private $entityId;

    /**
     * @var string
     */
    private $entityName;


    /**
     * Set entityId
     *
     * @param integer $entityId
     * @return EservVEmail
     */
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;

        return $this;
    }

    /**
     * Get entityId
     *
     * @return integer 
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * Set entityName
     *
     * @param string $entityName
     * @return EservVEmail
     */
    public function setEntityName($entityName)
    {
        $this->entityName = $entityName;

        return $this;
    }

    /**
     * Get entityName
     *
     * @return string 
     */
    public function getEntityName()
    {
        return $this->entityName;
    }
}
