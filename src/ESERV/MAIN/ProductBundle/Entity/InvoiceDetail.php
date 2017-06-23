<?php

namespace ESERV\MAIN\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvoiceDetail
 */
class InvoiceDetail
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
     * @var integer
     */
    private $productQuantity;

    /**
     * @var float
     */
    private $productPrice;

    /**
     * @var float
     */
    private $invDetAmount;

    /**
     * @var float
     */
    private $invDetDiscountAmount;

    /**
     * @var float
     */
    private $invDetVatAmount;

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
     * @var \ESERV\MAIN\ProductBundle\Entity\Invoice
     */
    private $invoice;

    /**
     * @var \ESERV\MAIN\ProductBundle\Entity\Product
     */
    private $product;

    /**
     * @var \ESERV\MAIN\ProductBundle\Entity\Vat
     */
    private $vat;


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
     * @return InvoiceDetail
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
     * Set productQuantity
     *
     * @param integer $productQuantity
     * @return InvoiceDetail
     */
    public function setProductQuantity($productQuantity)
    {
        $this->productQuantity = $productQuantity;

        return $this;
    }

    /**
     * Get productQuantity
     *
     * @return integer 
     */
    public function getProductQuantity()
    {
        return $this->productQuantity;
    }

    /**
     * Set productPrice
     *
     * @param float $productPrice
     * @return InvoiceDetail
     */
    public function setProductPrice($productPrice)
    {
        $this->productPrice = $productPrice;

        return $this;
    }

    /**
     * Get productPrice
     *
     * @return float 
     */
    public function getProductPrice()
    {
        return $this->productPrice;
    }

    /**
     * Set invDetAmount
     *
     * @param float $invDetAmount
     * @return InvoiceDetail
     */
    public function setInvDetAmount($invDetAmount)
    {
        $this->invDetAmount = $invDetAmount;

        return $this;
    }

    /**
     * Get invDetAmount
     *
     * @return float 
     */
    public function getInvDetAmount()
    {
        return $this->invDetAmount;
    }

    /**
     * Set invDetDiscountAmount
     *
     * @param float $invDetDiscountAmount
     * @return InvoiceDetail
     */
    public function setInvDetDiscountAmount($invDetDiscountAmount)
    {
        $this->invDetDiscountAmount = $invDetDiscountAmount;

        return $this;
    }

    /**
     * Get invDetDiscountAmount
     *
     * @return float 
     */
    public function getInvDetDiscountAmount()
    {
        return $this->invDetDiscountAmount;
    }

    /**
     * Set invDetVatAmount
     *
     * @param float $invDetVatAmount
     * @return InvoiceDetail
     */
    public function setInvDetVatAmount($invDetVatAmount)
    {
        $this->invDetVatAmount = $invDetVatAmount;

        return $this;
    }

    /**
     * Get invDetVatAmount
     *
     * @return float 
     */
    public function getInvDetVatAmount()
    {
        return $this->invDetVatAmount;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return InvoiceDetail
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
     * @return InvoiceDetail
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
     * @return InvoiceDetail
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
     * @return InvoiceDetail
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
     * Set invoice
     *
     * @param \ESERV\MAIN\ProductBundle\Entity\Invoice $invoice
     * @return InvoiceDetail
     */
    public function setInvoice(\ESERV\MAIN\ProductBundle\Entity\Invoice $invoice = null)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return \ESERV\MAIN\ProductBundle\Entity\Invoice 
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * Set product
     *
     * @param \ESERV\MAIN\ProductBundle\Entity\Product $product
     * @return InvoiceDetail
     */
    public function setProduct(\ESERV\MAIN\ProductBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \ESERV\MAIN\ProductBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set vat
     *
     * @param \ESERV\MAIN\ProductBundle\Entity\Vat $vat
     * @return InvoiceDetail
     */
    public function setVat(\ESERV\MAIN\ProductBundle\Entity\Vat $vat = null)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Get vat
     *
     * @return \ESERV\MAIN\ProductBundle\Entity\Vat 
     */
    public function getVat()
    {
        return $this->vat;
    }
}
