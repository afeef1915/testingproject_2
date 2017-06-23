<?php

namespace ESERV\MAIN\TableQueryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QueryMaster
 */
class QueryMaster
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

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
     * @var \ESERV\MAIN\TableQueryBundle\Entity\QueryView
     */
    private $queryView;


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
     * Set name
     *
     * @param string $name
     * @return QueryMaster
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return QueryMaster
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
     * @return QueryMaster
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
     * @return QueryMaster
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
     * @return QueryMaster
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
     * Set queryView
     *
     * @param \ESERV\MAIN\TableQueryBundle\Entity\QueryView $queryView
     * @return QueryMaster
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
     * @var string
     */
    private $queryJson;


    /**
     * Set queryJson
     *
     * @param string $queryJson
     * @return QueryMaster
     */
    public function setQueryJson($queryJson)
    {
        $this->queryJson = $queryJson;

        return $this;
    }

    /**
     * Get queryJson
     *
     * @return string 
     */
    public function getQueryJson()
    {
        return $this->queryJson;
    }
    /**
     * @var string
     */
    private $rawSql;


    /**
     * Set rawSql
     *
     * @param string $rawSql
     * @return QueryMaster
     */
    public function setRawSql($rawSql)
    {
        $this->rawSql = $rawSql;

        return $this;
    }

    /**
     * Get rawSql
     *
     * @return string 
     */
    public function getRawSql()
    {
        return $this->rawSql;
    }
}
