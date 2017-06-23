<?php

namespace ESERV\MAIN\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActivityEmail
 */
class ActivityEmail
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $statusDate;

    /**
     * @var string
     */
    private $fromEmailAddress;

    /**
     * @var string
     */
    private $toEmailAddress;

    /**
     * @var string
     */
    private $emailSubject;

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
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode
     */
    private $emailStatusSystemCode;

    /**
     * @var \ESERV\MAIN\ActivityBundle\Entity\ActivityTarget
     */
    private $activityTarget;


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
     * Set statusDate
     *
     * @param \DateTime $statusDate
     * @return ActivityEmail
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
     * Set fromEmailAddress
     *
     * @param string $fromEmailAddress
     * @return ActivityEmail
     */
    public function setFromEmailAddress($fromEmailAddress)
    {
        $this->fromEmailAddress = $fromEmailAddress;

        return $this;
    }

    /**
     * Get fromEmailAddress
     *
     * @return string 
     */
    public function getFromEmailAddress()
    {
        return $this->fromEmailAddress;
    }

    /**
     * Set toEmailAddress
     *
     * @param string $toEmailAddress
     * @return ActivityEmail
     */
    public function setToEmailAddress($toEmailAddress)
    {
        $this->toEmailAddress = $toEmailAddress;

        return $this;
    }

    /**
     * Get toEmailAddress
     *
     * @return string 
     */
    public function getToEmailAddress()
    {
        return $this->toEmailAddress;
    }

    /**
     * Set emailSubject
     *
     * @param string $emailSubject
     * @return ActivityEmail
     */
    public function setEmailSubject($emailSubject)
    {
        $this->emailSubject = $emailSubject;

        return $this;
    }

    /**
     * Get emailSubject
     *
     * @return string 
     */
    public function getEmailSubject()
    {
        return $this->emailSubject;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ActivityEmail
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
     * @return ActivityEmail
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
     * @return ActivityEmail
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
     * @return ActivityEmail
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
     * Set emailStatusSystemCode
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $emailStatusSystemCode
     * @return ActivityEmail
     */
    public function setEmailStatusSystemCode(\ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $emailStatusSystemCode = null)
    {
        $this->emailStatusSystemCode = $emailStatusSystemCode;

        return $this;
    }

    /**
     * Get emailStatusSystemCode
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode 
     */
    public function getEmailStatusSystemCode()
    {
        return $this->emailStatusSystemCode;
    }

    /**
     * Set activityTarget
     *
     * @param \ESERV\MAIN\ActivityBundle\Entity\ActivityTarget $activityTarget
     * @return ActivityEmail
     */
    public function setActivityTarget(\ESERV\MAIN\ActivityBundle\Entity\ActivityTarget $activityTarget = null)
    {
        $this->activityTarget = $activityTarget;

        return $this;
    }

    /**
     * Get activityTarget
     *
     * @return \ESERV\MAIN\ActivityBundle\Entity\ActivityTarget 
     */
    public function getActivityTarget()
    {
        return $this->activityTarget;
    }
}
