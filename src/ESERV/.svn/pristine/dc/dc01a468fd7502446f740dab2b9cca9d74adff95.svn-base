<?php

namespace ESERV\MAIN\HistoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * History
 */
class History
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $entityId;

    /**
     * @var string
     */
    private $entityName;

    /**
     * @var string
     */
    private $fieldName;

    /**
     * @var string
     */
    private $oldValue;

    /**
     * @var string
     */
    private $newValue;

    /**
     * @var string
     */
    private $reason;

    /**
     * @var integer
     */
    private $createdBy;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $reasonType;

    /**
     * @var \ESERV\MAIN\HistoryBundle\Entity\HistoryControl
     */
    private $historyControl;


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
     * Set entityId
     *
     * @param integer $entityId
     * @return History
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
     * @return History
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
     * Set fieldName
     *
     * @param string $fieldName
     * @return History
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
     * Set oldValue
     *
     * @param string $oldValue
     * @return History
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
     * @return History
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
     * Set reason
     *
     * @param string $reason
     * @return History
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string 
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return History
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return History
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
     * Set reasonType
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $reasonType
     * @return History
     */
    public function setReasonType(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $reasonType = null)
    {
        $this->reasonType = $reasonType;

        return $this;
    }

    /**
     * Get reasonType
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getReasonType()
    {
        return $this->reasonType;
    }

    /**
     * Set historyControl
     *
     * @param \ESERV\MAIN\HistoryBundle\Entity\HistoryControl $historyControl
     * @return History
     */
    public function setHistoryControl(\ESERV\MAIN\HistoryBundle\Entity\HistoryControl $historyControl = null)
    {
        $this->historyControl = $historyControl;

        return $this;
    }

    /**
     * Get historyControl
     *
     * @return \ESERV\MAIN\HistoryBundle\Entity\HistoryControl 
     */
    public function getHistoryControl()
    {
        return $this->historyControl;
    }
}
