<?php

namespace ESERV\MAIN\TableQueryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QueryDetailWhere
 */
class QueryDetailWhere
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $lineNo;

    /**
     * @var string
     */
    private $qdetJoin;

    /**
     * @var string
     */
    private $qdetExpression;

    /**
     * @var string
     */
    private $qdetValue1;

    /**
     * @var string
     */
    private $qdetValue2;

    /**
     * @var string
     */
    private $qdetOpenBracket;

    /**
     * @var string
     */
    private $qdetCloseBracket;

    /**
     * @var string
     */
    private $promptForValue;

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
     * @var \ESERV\MAIN\TableQueryBundle\Entity\QueryMaster
     */
    private $queryMaster;

    /**
     * @var \ESERV\MAIN\TableQueryBundle\Entity\QueryViewField
     */
    private $queryViewField;


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
     * Set lineNo
     *
     * @param integer $lineNo
     * @return QueryDetailWhere
     */
    public function setLineNo($lineNo)
    {
        $this->lineNo = $lineNo;

        return $this;
    }

    /**
     * Get lineNo
     *
     * @return integer 
     */
    public function getLineNo()
    {
        return $this->lineNo;
    }

    /**
     * Set qdetJoin
     *
     * @param string $qdetJoin
     * @return QueryDetailWhere
     */
    public function setQdetJoin($qdetJoin)
    {
        $this->qdetJoin = $qdetJoin;

        return $this;
    }

    /**
     * Get qdetJoin
     *
     * @return string 
     */
    public function getQdetJoin()
    {
        return $this->qdetJoin;
    }

    /**
     * Set qdetExpression
     *
     * @param string $qdetExpression
     * @return QueryDetailWhere
     */
    public function setQdetExpression($qdetExpression)
    {
        $this->qdetExpression = $qdetExpression;

        return $this;
    }

    /**
     * Get qdetExpression
     *
     * @return string 
     */
    public function getQdetExpression()
    {
        return $this->qdetExpression;
    }

    /**
     * Set qdetValue1
     *
     * @param string $qdetValue1
     * @return QueryDetailWhere
     */
    public function setQdetValue1($qdetValue1)
    {
        $this->qdetValue1 = $qdetValue1;

        return $this;
    }

    /**
     * Get qdetValue1
     *
     * @return string 
     */
    public function getQdetValue1()
    {
        return $this->qdetValue1;
    }

    /**
     * Set qdetValue2
     *
     * @param string $qdetValue2
     * @return QueryDetailWhere
     */
    public function setQdetValue2($qdetValue2)
    {
        $this->qdetValue2 = $qdetValue2;

        return $this;
    }

    /**
     * Get qdetValue2
     *
     * @return string 
     */
    public function getQdetValue2()
    {
        return $this->qdetValue2;
    }

    /**
     * Set qdetOpenBracket
     *
     * @param string $qdetOpenBracket
     * @return QueryDetailWhere
     */
    public function setQdetOpenBracket($qdetOpenBracket)
    {
        $this->qdetOpenBracket = $qdetOpenBracket;

        return $this;
    }

    /**
     * Get qdetOpenBracket
     *
     * @return string 
     */
    public function getQdetOpenBracket()
    {
        return $this->qdetOpenBracket;
    }

    /**
     * Set qdetCloseBracket
     *
     * @param string $qdetCloseBracket
     * @return QueryDetailWhere
     */
    public function setQdetCloseBracket($qdetCloseBracket)
    {
        $this->qdetCloseBracket = $qdetCloseBracket;

        return $this;
    }

    /**
     * Get qdetCloseBracket
     *
     * @return string 
     */
    public function getQdetCloseBracket()
    {
        return $this->qdetCloseBracket;
    }

    /**
     * Set promptForValue
     *
     * @param string $promptForValue
     * @return QueryDetailWhere
     */
    public function setPromptForValue($promptForValue)
    {
        $this->promptForValue = $promptForValue;

        return $this;
    }

    /**
     * Get promptForValue
     *
     * @return string 
     */
    public function getPromptForValue()
    {
        return $this->promptForValue;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return QueryDetailWhere
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
     * @return QueryDetailWhere
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
     * @return QueryDetailWhere
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
     * @return QueryDetailWhere
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
     * Set queryMaster
     *
     * @param \ESERV\MAIN\TableQueryBundle\Entity\QueryMaster $queryMaster
     * @return QueryDetailWhere
     */
    public function setQueryMaster(\ESERV\MAIN\TableQueryBundle\Entity\QueryMaster $queryMaster = null)
    {
        $this->queryMaster = $queryMaster;

        return $this;
    }

    /**
     * Get queryMaster
     *
     * @return \ESERV\MAIN\TableQueryBundle\Entity\QueryMaster 
     */
    public function getQueryMaster()
    {
        return $this->queryMaster;
    }

    /**
     * Set queryViewField
     *
     * @param \ESERV\MAIN\TableQueryBundle\Entity\QueryViewField $queryViewField
     * @return QueryDetailWhere
     */
    public function setQueryViewField(\ESERV\MAIN\TableQueryBundle\Entity\QueryViewField $queryViewField = null)
    {
        $this->queryViewField = $queryViewField;

        return $this;
    }

    /**
     * Get queryViewField
     *
     * @return \ESERV\MAIN\TableQueryBundle\Entity\QueryViewField 
     */
    public function getQueryViewField()
    {
        return $this->queryViewField;
    }
}
