<?php

namespace ESERV\MAIN\HistoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MtlAudit
 */
class MtlAudit
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $entityName;

    /**
     * @var string
     */
    private $entityId;

    /**
     * @var string
     */
    private $fieldName;

    /**
     * @var string
     */
    private $fieldType;

    /**
     * @var string
     */
    private $oldValue;

    /**
     * @var string
     */
    private $newValue;

    /**
     * @var \DateTime
     */
    private $updateDate;

    /**
     * @var string
     */
    private $dbUserName;

    /**
     * @var string
     */
    private $applicationUserName;


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
     * Set type
     *
     * @param string $type
     * @return MtlAudit
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set entityName
     *
     * @param string $entityName
     * @return MtlAudit
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

    /**
     * Set entityId
     *
     * @param string $entityId
     * @return MtlAudit
     */
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;

        return $this;
    }

    /**
     * Get entityId
     *
     * @return string 
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * Set fieldName
     *
     * @param string $fieldName
     * @return MtlAudit
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;

        return $this;
    }

    /**
     * Get fieldName
     *
     * @return string 
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * Set fieldType
     *
     * @param string $fieldType
     * @return MtlAudit
     */
    public function setFieldType($fieldType)
    {
        $this->fieldType = $fieldType;

        return $this;
    }

    /**
     * Get fieldType
     *
     * @return string 
     */
    public function getFieldType()
    {
        return $this->fieldType;
    }

    /**
     * Set oldValue
     *
     * @param string $oldValue
     * @return MtlAudit
     */
    public function setOldValue($oldValue)
    {
        $this->oldValue = $oldValue;

        return $this;
    }

    /**
     * Get oldValue
     *
     * @return string 
     */
    public function getOldValue()
    {
        return $this->oldValue;
    }

    /**
     * Set newValue
     *
     * @param string $newValue
     * @return MtlAudit
     */
    public function setNewValue($newValue)
    {
        $this->newValue = $newValue;

        return $this;
    }

    /**
     * Get newValue
     *
     * @return string 
     */
    public function getNewValue()
    {
        return $this->newValue;
    }

    /**
     * Set updateDate
     *
     * @param \DateTime $updateDate
     * @return MtlAudit
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get updateDate
     *
     * @return \DateTime 
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * Set dbUserName
     *
     * @param string $dbUserName
     * @return MtlAudit
     */
    public function setDbUserName($dbUserName)
    {
        $this->dbUserName = $dbUserName;

        return $this;
    }

    /**
     * Get dbUserName
     *
     * @return string 
     */
    public function getDbUserName()
    {
        return $this->dbUserName;
    }

    /**
     * Set applicationUserName
     *
     * @param string $applicationUserName
     * @return MtlAudit
     */
    public function setApplicationUserName($applicationUserName)
    {
        $this->applicationUserName = $applicationUserName;

        return $this;
    }

    /**
     * Get applicationUserName
     *
     * @return string 
     */
    public function getApplicationUserName()
    {
        return $this->applicationUserName;
    }
}
