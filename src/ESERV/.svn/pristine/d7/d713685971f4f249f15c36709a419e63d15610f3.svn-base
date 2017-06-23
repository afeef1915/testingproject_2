<?php

namespace ESERV\MAIN\MembershipBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContRate
 */
class ContRate
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $changeOverDate;

    /**
     * @var float
     */
    private $contAmount;

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
     * @var \ESERV\MAIN\MembershipBundle\Entity\ContRateMaster
     */
    private $contRateMaster;

    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\Fund
     */
    private $fund;

    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\Frequency
     */
    private $frequency;

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
     * Set changeOverDate
     *
     * @param \DateTime $changeOverDate
     * @return ContRate
     */
    public function setChangeOverDate($changeOverDate)
    {
        $this->changeOverDate = $changeOverDate;

        return $this;
    }

    /**
     * Get changeOverDate
     *
     * @return \DateTime 
     */
    public function getChangeOverDate()
    {
        return $this->changeOverDate;
    }

    /**
     * Set contAmount
     *
     * @param float $contAmount
     * @return ContRate
     */
    public function setContAmount($contAmount)
    {
        $this->contAmount = $contAmount;

        return $this;
    }

    /**
     * Get contAmount
     *
     * @return float 
     */
    public function getContAmount()
    {
        return $this->contAmount;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ContRate
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
     * @return ContRate
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
     * @return ContRate
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
     * @return ContRate
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
     * Set contRateMaster
     *
     * @param \ESERV\MAIN\MembershipBundle\Entity\ContRateMaster $contRateMaster
     * @return ContRate
     */
    public function setContRateMaster(\ESERV\MAIN\MembershipBundle\Entity\ContRateMaster $contRateMaster = null)
    {
        $this->contRateMaster = $contRateMaster;

        return $this;
    }

    /**
     * Get contRateMaster
     *
     * @return \ESERV\MAIN\MembershipBundle\Entity\ContRateMaster 
     */
    public function getContRateMaster()
    {
        return $this->contRateMaster;
    }

    /**
     * Set fund
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\Fund $fund
     * @return ContRate
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
     * Set frequency
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\Frequency $frequency
     * @return ContRate
     */
    public function setFrequency(\ESERV\MAIN\SystemConfigBundle\Entity\Frequency $frequency = null)
    {
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * Get frequency
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\Frequency 
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Set paymentMethod
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\PaymentMethod $paymentMethod
     * @return ContRate
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
