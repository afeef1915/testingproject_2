<?php

namespace ESERV\MAIN\ExternalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QueuedDbProcessVar
 */
class QueuedDbProcessVar
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $fieldName;

    /**
     * @var string
     */
    private $fieldValue;

    /**
     * @var string
     */
    private $fieldParamExt;

    /**
     * @var string
     */
    private $fieldParamType;

    /**
     * @var string
     */
    private $fieldParamSize;

    /**
     * @var integer
     */
    private $orderCol;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fieldName
     *
     * @param string $fieldName
     * @return QueuedDbProcessVar
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
     * Set fieldValue
     *
     * @param string $fieldValue
     * @return QueuedDbProcessVar
     */
    public function setFieldValue($fieldValue)
    {
        $this->fieldValue = $fieldValue;

        return $this;
    }

    /**
     * Get fieldValue
     *
     * @return string 
     */
    public function getFieldValue()
    {
        return $this->fieldValue;
    }

    /**
     * Set fieldParamExt
     *
     * @param string $fieldParamExt
     * @return QueuedDbProcessVar
     */
    public function setFieldParamExt($fieldParamExt)
    {
        $this->fieldParamExt = $fieldParamExt;

        return $this;
    }

    /**
     * Get fieldParamExt
     *
     * @return string 
     */
    public function getFieldParamExt()
    {
        return $this->fieldParamExt;
    }

    /**
     * Set fieldParamType
     *
     * @param string $fieldParamType
     * @return QueuedDbProcessVar
     */
    public function setFieldParamType($fieldParamType)
    {
        $this->fieldParamType = $fieldParamType;

        return $this;
    }

    /**
     * Get fieldParamType
     *
     * @return string 
     */
    public function getFieldParamType()
    {
        return $this->fieldParamType;
    }

    /**
     * Set fieldParamSize
     *
     * @param string $fieldParamSize
     * @return QueuedDbProcessVar
     */
    public function setFieldParamSize($fieldParamSize)
    {
        $this->fieldParamSize = $fieldParamSize;

        return $this;
    }

    /**
     * Get fieldParamSize
     *
     * @return string 
     */
    public function getFieldParamSize()
    {
        return $this->fieldParamSize;
    }

    /**
     * Set orderCol
     *
     * @param integer $orderCol
     * @return QueuedDbProcessVar
     */
    public function setOrderCol($orderCol)
    {
        $this->orderCol = $orderCol;

        return $this;
    }

    /**
     * Get orderCol
     *
     * @return integer 
     */
    public function getOrderCol()
    {
        return $this->orderCol;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return QueuedDbProcessVar
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
     * @return QueuedDbProcessVar
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
     * @return QueuedDbProcessVar
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
     * @return QueuedDbProcessVar
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
    
    private $queuedDbProcess;


    /**
     * Set queuedDbProcess
     *
     * @param \ESERV\MAIN\ExternalBundle\Entity\QueuedDbProcess $queuedDbProcess
     * @return QueuedDbProcessVar
     */
    public function setQueuedDbProcess(\ESERV\MAIN\ExternalBundle\Entity\QueuedDbProcess $queuedDbProcess = null)
    {
        $this->queuedDbProcess = $queuedDbProcess;

        return $this;
    }

    /**
     * Get queuedDbProcess
     *
     * @return \ESERV\MAIN\ExternalBundle\Entity\QueuedDbProcess 
     */
    public function getQueuedDbProcess()
    {
        return $this->queuedDbProcess;
    }
}
