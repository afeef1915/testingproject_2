<?php

namespace ESERV\MAIN\SystemConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MtlAuditColMap
 */
class MtlAuditColMap
{
    
    /**
     * @var integer
     */
    private $id;

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
    private $fieldDesc;

    /**
     * @var string
     */
    private $masterTable;

    /**
     * @var string
     */
    private $codeColumn;

    /**
     * @var string
     */
    private $valueColumn;

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
     * Set entityName
     *
     * @param string $entityName
     * @return MtlAuditColMap
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
     * @return MtlAuditColMap
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
     * Set fieldDesc
     *
     * @param string $fieldDesc
     * @return MtlAuditColMap
     */
    public function setFieldDesc($fieldDesc)
    {
        $this->fieldDesc = $fieldDesc;

        return $this;
    }

    /**
     * Get fieldDesc
     *
     * @return string 
     */
    public function getFieldDesc()
    {
        return $this->fieldDesc;
    }

    /**
     * Set masterTable
     *
     * @param string $masterTable
     * @return MtlAuditColMap
     */
    public function setMasterTable($masterTable)
    {
        $this->masterTable = $masterTable;

        return $this;
    }

    /**
     * Get masterTable
     *
     * @return string 
     */
    public function getMasterTable()
    {
        return $this->masterTable;
    }

    /**
     * Set codeColumn
     *
     * @param string $codeColumn
     * @return MtlAuditColMap
     */
    public function setCodeColumn($codeColumn)
    {
        $this->codeColumn = $codeColumn;

        return $this;
    }

    /**
     * Get codeColumn
     *
     * @return string 
     */
    public function getCodeColumn()
    {
        return $this->codeColumn;
    }

    /**
     * Set valueColumn
     *
     * @param string $valueColumn
     * @return MtlAuditColMap
     */
    public function setValueColumn($valueColumn)
    {
        $this->valueColumn = $valueColumn;

        return $this;
    }

    /**
     * Get valueColumn
     *
     * @return string 
     */
    public function getValueColumn()
    {
        return $this->valueColumn;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return MtlAuditColMap
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
     * @return MtlAuditColMap
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
     * @return MtlAuditColMap
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
     * @return MtlAuditColMap
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
}
