<?php

namespace ESERV\MAIN\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductStockAdjustment
 */
class ProductStockAdjustment
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $stockCredit;

    /**
     * @var integer
     */
    private $stockDebit;

    /**
     * @var string
     */
    private $description;

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
     * @var \ESERV\MAIN\ProductBundle\Entity\Product
     */
    private $product;

    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode
     */
    private $stockAdjTypeSysCode;


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
     * Set stockCredit
     *
     * @param integer $stockCredit
     * @return ProductStockAdjustment
     */
    public function setStockCredit($stockCredit)
    {
        $this->stockCredit = $stockCredit;

        return $this;
    }

    /**
     * Get stockCredit
     *
     * @return integer 
     */
    public function getStockCredit()
    {
        return $this->stockCredit;
    }

    /**
     * Set stockDebit
     *
     * @param integer $stockDebit
     * @return ProductStockAdjustment
     */
    public function setStockDebit($stockDebit)
    {
        $this->stockDebit = $stockDebit;

        return $this;
    }

    /**
     * Get stockDebit
     *
     * @return integer 
     */
    public function getStockDebit()
    {
        return $this->stockDebit;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return ProductStockAdjustment
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ProductStockAdjustment
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
     * @return ProductStockAdjustment
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
     * @return ProductStockAdjustment
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
     * @return ProductStockAdjustment
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
     * Set product
     *
     * @param \ESERV\MAIN\ProductBundle\Entity\Product $product
     * @return ProductStockAdjustment
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
     * Set stockAdjTypeSysCode
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $stockAdjTypeSysCode
     * @return ProductStockAdjustment
     */
    public function setStockAdjTypeSysCode(\ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $stockAdjTypeSysCode = null)
    {
        $this->stockAdjTypeSysCode = $stockAdjTypeSysCode;

        return $this;
    }

    /**
     * Get stockAdjTypeSysCode
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode 
     */
    public function getStockAdjTypeSysCode()
    {
        return $this->stockAdjTypeSysCode;
    }
}
