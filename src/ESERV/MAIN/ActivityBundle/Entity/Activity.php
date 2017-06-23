<?php

namespace ESERV\MAIN\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 */
class Activity
{   
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $entityId;

    /**
     * @var string
     */
    private $entityName;

    /**
     * @var integer
     */
    private $priorityId;

    /**
     * @var integer
     */
    private $parentId;

    /**
     * @var string
     */
    private $shortDescription;

    /**
     * @var \DateTime
     */
    private $activityDateTime;

    /**
     * @var \DateTime
     */
    private $statusDateTime;

    /**
     * @var string
     */
    private $longDescription;

    /**
     * @var string
     */
    private $adviceGiven;

    /**
     * @var boolean
     */
    private $isDeleted;

    /**
     * @var string
     */
    private $reissue;

    /**
     * @var string
     */
    private $showAlert;

    /**
     * @var string
     */
    private $isReminder;

    /**
     * @var integer
     */
    private $noOfReminders;

    /**
     * @var integer
     */
    private $firstReminderDays;

    /**
     * @var integer
     */
    private $subsequentReminderDays;

    /**
     * @var string
     */
    private $commFirstName;

    /**
     * @var string
     */
    private $commLastName;

    /**
     * @var string
     */
    private $commPhoneNo;

    /**
     * @var string
     */
    private $commEmail;

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
     * @var \ESERV\MAIN\ActivityBundle\Entity\ActivityCategory
     */
    private $activityCategory;

    /**
     * @var \ESERV\MAIN\ActivityBundle\Entity\ActivitySet
     */
    private $activitySet;

    /**
     * @var \ESERV\MAIN\ActivityBundle\Entity\ActivitySubCategory
     */
    private $activitySubCategory;

    /**
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $commTitle;

    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode
     */
    private $status;

    /**
     * @var \ESERV\MAIN\TemplateBundle\Entity\TemplateVersion
     */
    private $templateVersion;


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
     * Set entityId
     *
     * @param integer $entityId
     * @return Activity
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
     * Set entityName
     *
     * @param string $entityName
     * @return Activity
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
     * Set priorityId
     *
     * @param integer $priorityId
     * @return Activity
     */
    public function setPriorityId($priorityId)
    {
        $this->priorityId = $priorityId;

        return $this;
    }

    /**
     * Get priorityId
     *
     * @return integer 
     */
    public function getPriorityId()
    {
        return $this->priorityId;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     * @return Activity
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer 
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return Activity
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string 
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set activityDateTime
     *
     * @param \DateTime $activityDateTime
     * @return Activity
     */
    public function setActivityDateTime($activityDateTime)
    {
        $this->activityDateTime = $activityDateTime;

        return $this;
    }

    /**
     * Get activityDateTime
     *
     * @return \DateTime 
     */
    public function getActivityDateTime()
    {
        return $this->activityDateTime;
    }

    /**
     * Set statusDateTime
     *
     * @param \DateTime $statusDateTime
     * @return Activity
     */
    public function setStatusDateTime($statusDateTime)
    {
        $this->statusDateTime = $statusDateTime;

        return $this;
    }

    /**
     * Get statusDateTime
     *
     * @return \DateTime 
     */
    public function getStatusDateTime()
    {
        return $this->statusDateTime;
    }

    /**
     * Set longDescription
     *
     * @param string $longDescription
     * @return Activity
     */
    public function setLongDescription($longDescription)
    {
        $this->longDescription = $longDescription;

        return $this;
    }

    /**
     * Get longDescription
     *
     * @return string 
     */
    public function getLongDescription()
    {
        return $this->longDescription;
    }

    /**
     * Set adviceGiven
     *
     * @param string $adviceGiven
     * @return Activity
     */
    public function setAdviceGiven($adviceGiven)
    {
        $this->adviceGiven = $adviceGiven;

        return $this;
    }

    /**
     * Get adviceGiven
     *
     * @return string 
     */
    public function getAdviceGiven()
    {
        return $this->adviceGiven;
    }

    /**
     * Set isDeleted
     *
     * @param boolean $isDeleted
     * @return Activity
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Get isDeleted
     *
     * @return boolean 
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * Set reissue
     *
     * @param string $reissue
     * @return Activity
     */
    public function setReissue($reissue)
    {
        $this->reissue = $reissue;

        return $this;
    }

    /**
     * Get reissue
     *
     * @return string 
     */
    public function getReissue()
    {
        return $this->reissue;
    }

    /**
     * Set showAlert
     *
     * @param string $showAlert
     * @return Activity
     */
    public function setShowAlert($showAlert)
    {
        $this->showAlert = $showAlert;

        return $this;
    }

    /**
     * Get showAlert
     *
     * @return string 
     */
    public function getShowAlert()
    {
        return $this->showAlert;
    }

    /**
     * Set isReminder
     *
     * @param string $isReminder
     * @return Activity
     */
    public function setIsReminder($isReminder)
    {
        $this->isReminder = $isReminder;

        return $this;
    }

    /**
     * Get isReminder
     *
     * @return string 
     */
    public function getIsReminder()
    {
        return $this->isReminder;
    }

    /**
     * Set noOfReminders
     *
     * @param integer $noOfReminders
     * @return Activity
     */
    public function setNoOfReminders($noOfReminders)
    {
        $this->noOfReminders = $noOfReminders;

        return $this;
    }

    /**
     * Get noOfReminders
     *
     * @return integer 
     */
    public function getNoOfReminders()
    {
        return $this->noOfReminders;
    }

    /**
     * Set firstReminderDays
     *
     * @param integer $firstReminderDays
     * @return Activity
     */
    public function setFirstReminderDays($firstReminderDays)
    {
        $this->firstReminderDays = $firstReminderDays;

        return $this;
    }

    /**
     * Get firstReminderDays
     *
     * @return integer 
     */
    public function getFirstReminderDays()
    {
        return $this->firstReminderDays;
    }

    /**
     * Set subsequentReminderDays
     *
     * @param integer $subsequentReminderDays
     * @return Activity
     */
    public function setSubsequentReminderDays($subsequentReminderDays)
    {
        $this->subsequentReminderDays = $subsequentReminderDays;

        return $this;
    }

    /**
     * Get subsequentReminderDays
     *
     * @return integer 
     */
    public function getSubsequentReminderDays()
    {
        return $this->subsequentReminderDays;
    }

    /**
     * Set commFirstName
     *
     * @param string $commFirstName
     * @return Activity
     */
    public function setCommFirstName($commFirstName)
    {
        $this->commFirstName = $commFirstName;

        return $this;
    }

    /**
     * Get commFirstName
     *
     * @return string 
     */
    public function getCommFirstName()
    {
        return $this->commFirstName;
    }

    /**
     * Set commLastName
     *
     * @param string $commLastName
     * @return Activity
     */
    public function setCommLastName($commLastName)
    {
        $this->commLastName = $commLastName;

        return $this;
    }

    /**
     * Get commLastName
     *
     * @return string 
     */
    public function getCommLastName()
    {
        return $this->commLastName;
    }

    /**
     * Set commPhoneNo
     *
     * @param string $commPhoneNo
     * @return Activity
     */
    public function setCommPhoneNo($commPhoneNo)
    {
        $this->commPhoneNo = $commPhoneNo;

        return $this;
    }

    /**
     * Get commPhoneNo
     *
     * @return string 
     */
    public function getCommPhoneNo()
    {
        return $this->commPhoneNo;
    }

    /**
     * Set commEmail
     *
     * @param string $commEmail
     * @return Activity
     */
    public function setCommEmail($commEmail)
    {
        $this->commEmail = $commEmail;

        return $this;
    }

    /**
     * Get commEmail
     *
     * @return string 
     */
    public function getCommEmail()
    {
        return $this->commEmail;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Activity
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
     * @return Activity
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
     * @return Activity
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
     * @return Activity
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
     * Set activityCategory
     *
     * @param \ESERV\MAIN\ActivityBundle\Entity\ActivityCategory $activityCategory
     * @return Activity
     */
    public function setActivityCategory(\ESERV\MAIN\ActivityBundle\Entity\ActivityCategory $activityCategory = null)
    {
        $this->activityCategory = $activityCategory;

        return $this;
    }

    /**
     * Get activityCategory
     *
     * @return \ESERV\MAIN\ActivityBundle\Entity\ActivityCategory 
     */
    public function getActivityCategory()
    {
        return $this->activityCategory;
    }

    /**
     * Set activitySet
     *
     * @param \ESERV\MAIN\ActivityBundle\Entity\ActivitySet $activitySet
     * @return Activity
     */
    public function setActivitySet(\ESERV\MAIN\ActivityBundle\Entity\ActivitySet $activitySet = null)
    {
        $this->activitySet = $activitySet;

        return $this;
    }

    /**
     * Get activitySet
     *
     * @return \ESERV\MAIN\ActivityBundle\Entity\ActivitySet 
     */
    public function getActivitySet()
    {
        return $this->activitySet;
    }

    /**
     * Set activitySubCategory
     *
     * @param \ESERV\MAIN\ActivityBundle\Entity\ActivitySubCategory $activitySubCategory
     * @return Activity
     */
    public function setActivitySubCategory(\ESERV\MAIN\ActivityBundle\Entity\ActivitySubCategory $activitySubCategory = null)
    {
        $this->activitySubCategory = $activitySubCategory;

        return $this;
    }

    /**
     * Get activitySubCategory
     *
     * @return \ESERV\MAIN\ActivityBundle\Entity\ActivitySubCategory 
     */
    public function getActivitySubCategory()
    {
        return $this->activitySubCategory;
    }

    /**
     * Set commTitle
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $commTitle
     * @return Activity
     */
    public function setCommTitle(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $commTitle = null)
    {
        $this->commTitle = $commTitle;

        return $this;
    }

    /**
     * Get commTitle
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getCommTitle()
    {
        return $this->commTitle;
    }

    /**
     * Set status
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $status
     * @return Activity
     */
    public function setStatus(\ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set templateVersion
     *
     * @param \ESERV\MAIN\TemplateBundle\Entity\TemplateVersion $templateVersion
     * @return Activity
     */
    public function setTemplateVersion(\ESERV\MAIN\TemplateBundle\Entity\TemplateVersion $templateVersion = null)
    {
        $this->templateVersion = $templateVersion;

        return $this;
    }

    /**
     * Get templateVersion
     *
     * @return \ESERV\MAIN\TemplateBundle\Entity\TemplateVersion 
     */
    public function getTemplateVersion()
    {
        return $this->templateVersion;
    }
    /**
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $activitySource;


    /**
     * Set activitySource
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $activitySource
     * @return Activity
     */
    public function setActivitySource(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $activitySource = null)
    {
        $this->activitySource = $activitySource;

        return $this;
    }

    /**
     * Get activitySource
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getActivitySource()
    {
        return $this->activitySource;
    }
}
