<?php

namespace ESERV\MAIN\MembershipBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MemberRate
 */
class MemberRate
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $startDate;

    /**
     * @var \DateTime
     */
    private $endDate;

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
     * @var \ESERV\MAIN\MembershipBundle\Entity\Member
     */
    private $member;

    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\Fund
     */
    private $fund;

    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\Frequency
     */
    private $frequency;

    /**
     * @var \ESERV\MAIN\MembershipBundle\Entity\ContRateMaster
     */
    private $contRateMaster;

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
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return MemberRate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return MemberRate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return MemberRate
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
     * @return MemberRate
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
     * @return MemberRate
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
     * @return MemberRate
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
     * Set member
     *
     * @param \ESERV\MAIN\MembershipBundle\Entity\Member $member
     * @return MemberRate
     */
    public function setMember(\ESERV\MAIN\MembershipBundle\Entity\Member $member = null)
    {
        $this->member = $member;

        return $this;
    }

    /**
     * Get member
     *
     * @return \ESERV\MAIN\MembershipBundle\Entity\Member 
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * Set fund
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\Fund $fund
     * @return MemberRate
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
     * @return MemberRate
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
     * Set contRateMaster
     *
     * @param \ESERV\MAIN\MembershipBundle\Entity\ContRateMaster $contRateMaster
     * @return MemberRate
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
     * Set paymentMethod
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\PaymentMethod $paymentMethod
     * @return MemberRate
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
