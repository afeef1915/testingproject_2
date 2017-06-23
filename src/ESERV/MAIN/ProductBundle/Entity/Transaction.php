<?php

namespace ESERV\MAIN\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 */
class Transaction
{
    /**
     * @var integer
     */
    private $id;

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
    private $dateProcessed;

    /**
     * @var string
     */
    private $comments;

    /**
     * @var string
     */
    private $extCardPaymentRef;

    /**
     * @var string
     */
    private $intCardPaymentRef;

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
     * @var \ESERV\MAIN\ContactBundle\Entity\Contact
     */
    private $contact;

    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\TransactionOrigin
     */
    private $transactionOrigin;

    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\PaymentMethod
     */
    private $paymentMethod;


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
     * Set credit
     *
     * @param float $credit
     * @return Transaction
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
     * @return Transaction
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
     * Set dateProcessed
     *
     * @param \DateTime $dateProcessed
     * @return Transaction
     */
    public function setDateProcessed($dateProcessed)
    {
        $this->dateProcessed = $dateProcessed;

        return $this;
    }

    /**
     * Get dateProcessed
     *
     * @return \DateTime 
     */
    public function getDateProcessed()
    {
        return $this->dateProcessed;
    }

    /**
     * Set comments
     *
     * @param string $comments
     * @return Transaction
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set extCardPaymentRef
     *
     * @param string $extCardPaymentRef
     * @return Transaction
     */
    public function setExtCardPaymentRef($extCardPaymentRef)
    {
        $this->extCardPaymentRef = $extCardPaymentRef;

        return $this;
    }

    /**
     * Get extCardPaymentRef
     *
     * @return string 
     */
    public function getExtCardPaymentRef()
    {
        return $this->extCardPaymentRef;
    }

    /**
     * Set intCardPaymentRef
     *
     * @param string $intCardPaymentRef
     * @return Transaction
     */
    public function setIntCardPaymentRef($intCardPaymentRef)
    {
        $this->intCardPaymentRef = $intCardPaymentRef;

        return $this;
    }

    /**
     * Get intCardPaymentRef
     *
     * @return string 
     */
    public function getIntCardPaymentRef()
    {
        return $this->intCardPaymentRef;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Transaction
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
     * @return Transaction
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
     * @return Transaction
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
     * @return Transaction
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
     * Set contact
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\Contact $contact
     * @return Transaction
     */
    public function setContact(\ESERV\MAIN\ContactBundle\Entity\Contact $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\Contact 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set transactionOrigin
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\TransactionOrigin $transactionOrigin
     * @return Transaction
     */
    public function setTransactionOrigin(\ESERV\MAIN\SystemConfigBundle\Entity\TransactionOrigin $transactionOrigin = null)
    {
        $this->transactionOrigin = $transactionOrigin;

        return $this;
    }

    /**
     * Get transactionOrigin
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\TransactionOrigin 
     */
    public function getTransactionOrigin()
    {
        return $this->transactionOrigin;
    }

    /**
     * Set paymentMethod
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\PaymentMethod $paymentMethod
     * @return Transaction
     */
    public function setPaymentMethod(\ESERV\MAIN\SystemConfigBundle\Entity\PaymentMethod $paymentMethod = null)
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * Get paymentMethod
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\PaymentMethod 
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }
}
