<?php

namespace ESERV\MAIN\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice
 */
class Invoice
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $invoiceNo;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $invoiceDate;

    /**
     * @var float
     */
    private $invoiceAmount;

    /**
     * @var float
     */
    private $invoiceVatAmount;

    /**
     * @var \DateTime
     */
    private $statusDate;

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
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode
     */
    private $invStatusSystemCode;


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
     * Set invoiceNo
     *
     * @param string $invoiceNo
     * @return Invoice
     */
    public function setInvoiceNo($invoiceNo)
    {
        $this->invoiceNo = $invoiceNo;

        return $this;
    }

    /**
     * Get invoiceNo
     *
     * @return string 
     */
    public function getInvoiceNo()
    {
        return $this->invoiceNo;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Invoice
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set invoiceDate
     *
     * @param \DateTime $invoiceDate
     * @return Invoice
     */
    public function setInvoiceDate($invoiceDate)
    {
        $this->invoiceDate = $invoiceDate;

        return $this;
    }

    /**
     * Get invoiceDate
     *
     * @return \DateTime 
     */
    public function getInvoiceDate()
    {
        return $this->invoiceDate;
    }

    /**
     * Set invoiceAmount
     *
     * @param float $invoiceAmount
     * @return Invoice
     */
    public function setInvoiceAmount($invoiceAmount)
    {
        $this->invoiceAmount = $invoiceAmount;

        return $this;
    }

    /**
     * Get invoiceAmount
     *
     * @return float 
     */
    public function getInvoiceAmount()
    {
        return $this->invoiceAmount;
    }

    /**
     * Set invoiceVatAmount
     *
     * @param float $invoiceVatAmount
     * @return Invoice
     */
    public function setInvoiceVatAmount($invoiceVatAmount)
    {
        $this->invoiceVatAmount = $invoiceVatAmount;

        return $this;
    }

    /**
     * Get invoiceVatAmount
     *
     * @return float 
     */
    public function getInvoiceVatAmount()
    {
        return $this->invoiceVatAmount;
    }

    /**
     * Set statusDate
     *
     * @param \DateTime $statusDate
     * @return Invoice
     */
    public function setStatusDate($statusDate)
    {
        $this->statusDate = $statusDate;

        return $this;
    }

    /**
     * Get statusDate
     *
     * @return \DateTime 
     */
    public function getStatusDate()
    {
        return $this->statusDate;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Invoice
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
     * @return Invoice
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
     * @return Invoice
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
     * @return Invoice
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
     * @return Invoice
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
     * Set invStatusSystemCode
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $invStatusSystemCode
     * @return Invoice
     */
    public function setInvStatusSystemCode(\ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $invStatusSystemCode = null)
    {
        $this->invStatusSystemCode = $invStatusSystemCode;

        return $this;
    }

    /**
     * Get invStatusSystemCode
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode 
     */
    public function getInvStatusSystemCode()
    {
        return $this->invStatusSystemCode;
    }
}
