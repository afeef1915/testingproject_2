<?php

namespace ESERV\MAIN\SystemConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EservSaveQueryDetail
 */
class EservSaveQueryDetail
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $columnName;

    /**
     * @var string
     */
    private $clientColumnName;

    /**
     * @var string
     */
    private $columnValue;

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
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\EservSaveQuery
     */
    private $eservSaveQuery;


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
     * Set columnName
     *
     * @param string $columnName
     * @return EservSaveQueryDetail
     */
    public function setColumnName($columnName)
    {
        $this->columnName = $columnName;

        return $this;
    }

    /**
     * Get columnName
     *
     * @return string 
     */
    public function getColumnName()
    {
        return $this->columnName;
    }

    /**
     * Set clientColumnName
     *
     * @param string $clientColumnName
     * @return EservSaveQueryDetail
     */
    public function setClientColumnName($clientColumnName)
    {
        $this->clientColumnName = $clientColumnName;

        return $this;
    }

    /**
     * Get clientColumnName
     *
     * @return string 
     */
    public function getClientColumnName()
    {
        return $this->clientColumnName;
    }

    /**
     * Set columnValue
     *
     * @param string $columnValue
     * @return EservSaveQueryDetail
     */
    public function setColumnValue($columnValue)
    {
        $this->columnValue = $columnValue;

        return $this;
    }

    /**
     * Get columnValue
     *
     * @return string 
     */
    public function getColumnValue()
    {
        return $this->columnValue;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return EservSaveQueryDetail
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
     * @return EservSaveQueryDetail
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
     * @return EservSaveQueryDetail
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
     * @return EservSaveQueryDetail
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
     * Set eservSaveQuery
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\EservSaveQuery $eservSaveQuery
     * @return EservSaveQueryDetail
     */
    public function setEservSaveQuery(\ESERV\MAIN\SystemConfigBundle\Entity\EservSaveQuery $eservSaveQuery = null)
    {
        $this->eservSaveQuery = $eservSaveQuery;

        return $this;
    }

    /**
     * Get eservSaveQuery
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\EservSaveQuery 
     */
    public function getEservSaveQuery()
    {
        return $this->eservSaveQuery;
    }
}
