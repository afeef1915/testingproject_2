<?php

namespace ESERV\MAIN\HistoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DeletedRecords
 */
class DeletedRecords
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $sequenceNo;

    /**
     * @var string
     */
    private $deletedFrom;

    /**
     * @var string
     */
    private $tableName;

    /**
     * @var string
     */
    private $columnsAndValues;

    /**
     * @var string
     */
    private $deletedBy;

    /**
     * @var \DateTime
     */
    private $deletedAt;


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
     * Set sequenceNo
     *
     * @param integer $sequenceNo
     * @return DeletedRecords
     */
    public function setSequenceNo($sequenceNo)
    {
        $this->sequenceNo = $sequenceNo;

        return $this;
    }

    /**
     * Get sequenceNo
     *
     * @return integer 
     */
    public function getSequenceNo()
    {
        return $this->sequenceNo;
    }

    /**
     * Set deletedFrom
     *
     * @param string $deletedFrom
     * @return DeletedRecords
     */
    public function setDeletedFrom($deletedFrom)
    {
        $this->deletedFrom = $deletedFrom;

        return $this;
    }

    /**
     * Get deletedFrom
     *
     * @return string 
     */
    public function getDeletedFrom()
    {
        return $this->deletedFrom;
    }

    /**
     * Set tableName
     *
     * @param string $tableName
     * @return DeletedRecords
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;

        return $this;
    }

    /**
     * Get tableName
     *
     * @return string 
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * Set columnsAndValues
     *
     * @param string $columnsAndValues
     * @return DeletedRecords
     */
    public function setColumnsAndValues($columnsAndValues)
    {
        $this->columnsAndValues = $columnsAndValues;

        return $this;
    }

    /**
     * Get columnsAndValues
     *
     * @return string 
     */
    public function getColumnsAndValues()
    {
        return $this->columnsAndValues;
    }

    /**
     * Set deletedBy
     *
     * @param string $deletedBy
     * @return DeletedRecords
     */
    public function setDeletedBy($deletedBy)
    {
        $this->deletedBy = $deletedBy;

        return $this;
    }

    /**
     * Get deletedBy
     *
     * @return string 
     */
    public function getDeletedBy()
    {
        return $this->deletedBy;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     * @return DeletedRecords
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
}
