<?php

namespace ESERV\MAIN\TableQueryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QueryViewField
 */
class QueryViewField
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
    private $name;

    /**
     * @var string
     */
    private $isActive;

    /**
     * @var string
     */
    private $isPrimaryKey;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $createdBy;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $updatedBy;

    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode
     */
    private $fieldType;

    /**
     * @var \ESERV\MAIN\TableQueryBundle\Entity\QueryView
     */
    private $queryView;

    /**
     * @var \ESERV\MAIN\TableQueryBundle\Entity\QueryViewLov
     */
    private $queryViewLov;


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
     * @return QueryViewField
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
     * Set name
     *
     * @param string $name
     * @return QueryViewField
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set isActive
     *
     * @param string $isActive
     * @return QueryViewField
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return string 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set isPrimaryKey
     *
     * @param string $isPrimaryKey
     * @return QueryViewField
     */
    public function setIsPrimaryKey($isPrimaryKey)
    {
        $this->isPrimaryKey = $isPrimaryKey;

        return $this;
    }

    /**
     * Get isPrimaryKey
     *
     * @return string 
     */
    public function getIsPrimaryKey()
    {
        return $this->isPrimaryKey;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return QueryViewField
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
     * @param integer $createdBy
     * @return QueryViewField
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return QueryViewField
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
     * Set updatedBy
     *
     * @param integer $updatedBy
     * @return QueryViewField
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
     * Set fieldType
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $fieldType
     * @return QueryViewField
     */
    public function setFieldType(\ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $fieldType = null)
    {
        $this->fieldType = $fieldType;

        return $this;
    }

    /**
     * Get fieldType
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode 
     */
    public function getFieldType()
    {
        return $this->fieldType;
    }

    /**
     * Set queryView
     *
     * @param \ESERV\MAIN\TableQueryBundle\Entity\QueryView $queryView
     * @return QueryViewField
     */
    public function setQueryView(\ESERV\MAIN\TableQueryBundle\Entity\QueryView $queryView = null)
    {
        $this->queryView = $queryView;

        return $this;
    }

    /**
     * Get queryView
     *
     * @return \ESERV\MAIN\TableQueryBundle\Entity\QueryView 
     */
    public function getQueryView()
    {
        return $this->queryView;
    }

    /**
     * Set queryViewLov
     *
     * @param \ESERV\MAIN\TableQueryBundle\Entity\QueryViewLov $queryViewLov
     * @return QueryViewField
     */
    public function setQueryViewLov(\ESERV\MAIN\TableQueryBundle\Entity\QueryViewLov $queryViewLov = null)
    {
        $this->queryViewLov = $queryViewLov;

        return $this;
    }

    /**
     * Get queryViewLov
     *
     * @return \ESERV\MAIN\TableQueryBundle\Entity\QueryViewLov 
     */
    public function getQueryViewLov()
    {
        return $this->queryViewLov;
    }
}
