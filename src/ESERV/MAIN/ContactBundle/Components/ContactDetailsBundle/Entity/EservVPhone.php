<?php

namespace ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity;

/**
 * EservVPhone
 */
class EservVPhone
{
    
    /**
     * @var integer
     */
    private $dtindex;

    /**
     * @var integer
     */
    private $phoneId;

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
    private $phoneTypeId;

    /**
     * @var string
     */
    private $phoneTypeCode;

    /**
     * @var string
     */
    private $phoneTypeName;

    /**
     * @var string
     */
    private $phoneStd;

    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * @var string
     */
    private $oldPhoneNumber;

    /**
     * @var string
     */
    private $newPhoneNumber;

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
     * Set phoneId
     *
     * @param integer $phoneId
     * @return EservVPhone
     */
    public function setPhoneId($phoneId)
    {
        $this->phoneId = $phoneId;

        return $this;
    }

    /**
     * Get phoneId
     *
     * @return integer 
     */
    public function getPhoneId()
    {
        return $this->phoneId;
    }

    /**
     * Set mtlAuditId
     *
     * @param integer $mtlAuditId
     * @return EservVPhone
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
     * @return EservVPhone
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
     * @return EservVPhone
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
     * @return EservVPhone
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
     * Set phoneTypeId
     *
     * @param integer $phoneTypeId
     * @return EservVPhone
     */
    public function setPhoneTypeId($phoneTypeId)
    {
        $this->phoneTypeId = $phoneTypeId;

        return $this;
    }

    /**
     * Get phoneTypeId
     *
     * @return integer 
     */
    public function getPhoneTypeId()
    {
        return $this->phoneTypeId;
    }

    /**
     * Set phoneTypeCode
     *
     * @param string $phoneTypeCode
     * @return EservVPhone
     */
    public function setPhoneTypeCode($phoneTypeCode)
    {
        $this->phoneTypeCode = $phoneTypeCode;

        return $this;
    }

    /**
     * Get phoneTypeCode
     *
     * @return string 
     */
    public function getPhoneTypeCode()
    {
        return $this->phoneTypeCode;
    }

    /**
     * Set phoneTypeName
     *
     * @param string $phoneTypeName
     * @return EservVPhone
     */
    public function setPhoneTypeName($phoneTypeName)
    {
        $this->phoneTypeName = $phoneTypeName;

        return $this;
    }

    /**
     * Get phoneTypeName
     *
     * @return string 
     */
    public function getPhoneTypeName()
    {
        return $this->phoneTypeName;
    }

    /**
     * Set phoneStd
     *
     * @param string $phoneStd
     * @return EservVPhone
     */
    public function setPhoneStd($phoneStd)
    {
        $this->phoneStd = $phoneStd;

        return $this;
    }

    /**
     * Get phoneStd
     *
     * @return string 
     */
    public function getPhoneStd()
    {
        return $this->phoneStd;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return EservVPhone
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set oldPhoneNumber
     *
     * @param string $oldPhoneNumber
     * @return EservVPhone
     */
    public function setOldPhoneNumber($oldPhoneNumber)
    {
        $this->oldPhoneNumber = $oldPhoneNumber;

        return $this;
    }

    /**
     * Get oldPhoneNumber
     *
     * @return string 
     */
    public function getOldPhoneNumber()
    {
        return $this->oldPhoneNumber;
    }

    /**
     * Set newPhoneNumber
     *
     * @param string $newPhoneNumber
     * @return EservVPhone
     */
    public function setNewPhoneNumber($newPhoneNumber)
    {
        $this->newPhoneNumber = $newPhoneNumber;

        return $this;
    }

    /**
     * Get newPhoneNumber
     *
     * @return string 
     */
    public function getNewPhoneNumber()
    {
        return $this->newPhoneNumber;
    }

    /**
     * Set primaryRecord
     *
     * @param string $primaryRecord
     * @return EservVPhone
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
     * @return EservVPhone
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
     * @return EservVPhone
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
     * @return EservVPhone
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
     * @return EservVPhone
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
     * @return EservVPhone
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
     * @return EservVPhone
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
     * @return EservVPhone
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
     * @return EservVPhone
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
     * @return EservVPhone
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
     * @return EservVPhone
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
