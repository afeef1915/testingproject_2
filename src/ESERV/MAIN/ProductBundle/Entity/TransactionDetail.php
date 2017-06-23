<?php

namespace ESERV\MAIN\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TransactionDetail
 */
class TransactionDetail
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
     * @var float
     */
    private $credit;

    /**
     * @var float
     */
    private $debit;

    /**
     * @var \DateTime
     */
    private $periodStartDate;

    /**
     * @var \DateTime
     */
    private $periodEndDate;

    /**
     * @var string
     */
    private $entityName;

    /**
     * @var integer
     */
    private $entityId;

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
     * @var \ESERV\MAIN\ProductBundle\Entity\Transaction
     */
    private $transaction;

    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\Fund
     */
    private $fund;

    /**
     * @var \ESERV\MAIN\ProductBundle\Entity\TransactionType
     */
    private $transactionType;

    /**
     * @var \ESERV\MAIN\MembershipBundle\Entity\Workplace
     */
    private $workplace;


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
     * @return TransactionDetail
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
     * Set credit
     *
     * @param float $credit
     * @return TransactionDetail
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * Get credit
     *
     * @return float 
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Set debit
     *
     * @param float $debit
     * @return TransactionDetail
     */
    public function setDebit($debit)
    {
        $this->debit = $debit;

        return $this;
    }

    /**
     * Get debit
     *
     * @return float 
     */
    public function getDebit()
    {
        return $this->debit;
    }

    /**
     * Set periodStartDate
     *
     * @param \DateTime $periodStartDate
     * @return TransactionDetail
     */
    public function setPeriodStartDate($periodStartDate)
    {
        $this->periodStartDate = $periodStartDate;

        return $this;
    }

    /**
     * Get periodStartDate
     *
     * @return \DateTime 
     */
    public function getPeriodStartDate()
    {
        return $this->periodStartDate;
    }

    /**
     * Set periodEndDate
     *
     * @param \DateTime $periodEndDate
     * @return TransactionDetail
     */
    public function setPeriodEndDate($periodEndDate)
    {
        $this->periodEndDate = $periodEndDate;

        return $this;
    }

    /**
     * Get periodEndDate
     *
     * @return \DateTime 
     */
    public function getPeriodEndDate()
    {
        return $this->periodEndDate;
    }

    /**
     * Set entityName
     *
     * @param string $entityName
     * @return TransactionDetail
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
     * @param integer $entityId
     * @return TransactionDetail
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return TransactionDetail
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
     * @return TransactionDetail
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
     * @return TransactionDetail
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
     * @return TransactionDetail
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
     * Set transaction
     *
     * @param \ESERV\MAIN\ProductBundle\Entity\Transaction $transaction
     * @return TransactionDetail
     */
    public function setTransaction(\ESERV\MAIN\ProductBundle\Entity\Transaction $transaction = null)
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * Get transaction
     *
     * @return \ESERV\MAIN\ProductBundle\Entity\Transaction 
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * Set fund
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\Fund $fund
     * @return TransactionDetail
     */
    public function setFund(\ESERV\MAIN\SystemConfigBundle\Entity\Fund $fund = null)
    {
        $this->fund = $fund;

        return $this;
    }

    /**
     * Get fund
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\Fund 
     */
    public function getFund()
    {
        return $this->fund;
    }

    /**
     * Set transactionType
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\TransactionType $transactionType
     * @return TransactionDetail
     */
    public function setTransactionType(\ESERV\MAIN\SystemConfigBundle\Entity\TransactionType $transactionType = null)
    {
        $this->transactionType = $transactionType;

        return $this;
    }

    /**
     * Get transactionType
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\TransactionType 
     */
    public function getTransactionType()
    {
        return $this->transactionType;
    }

    /**
     * Set workplace
     *
     * @param \ESERV\MAIN\MembershipBundle\Entity\Workplace $workplace
     * @return TransactionDetail
     */
    public function setWorkplace(\ESERV\MAIN\MembershipBundle\Entity\Workplace $workplace = null)
    {
        $this->workplace = $workplace;

        return $this;
    }

    /**
     * Get workplace
     *
     * @return \ESERV\MAIN\MembershipBundle\Entity\Workplace 
     */
    public function getWorkplace()
    {
        return $this->workplace;
    }
}
