<?php

namespace ESERV\MAIN\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EservVActivity
 */
class EservVActivity
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $activityId;

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
     * @var string
     */
    private $activityCategory;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $templateVersion;

    /**
     * @var string
     */
    private $targetContact;

    /**
     * @var integer
     */
    private $targetContactId;

    /**
     * @var string
     */
    private $sourceContact;

    /**
     * @var string
     */
    private $userDepartment;

    /**
     * @var string
     */
    private $activityTypeCode;

    /**
     * @var string
     */
    private $gotoUrl;

    /**
     * @var string
     */
    private $buttonLabel;


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
     * Set activityId
     *
     * @param integer $activityId
     * @return EservVActivity
     */
    public function setActivityId($activityId)
    {
        $this->activityId = $activityId;

        return $this;
    }

    /**
     * Get activityId
     *
     * @return integer 
     */
    public function getActivityId()
    {
        return $this->activityId;
    }

    /**
     * Set entityId
     *
     * @param integer $entityId
     * @return EservVActivity
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
     * @return EservVActivity
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
     * @return EservVActivity
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
     * @return EservVActivity
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
     * @return EservVActivity
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
     * @return EservVActivity
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
     * @return EservVActivity
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return EservVActivity
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
     * @return EservVActivity
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
     * @return EservVActivity
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
     * @return EservVActivity
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
     * @param string $activityCategory
     * @return EservVActivity
     */
    public function setActivityCategory($activityCategory)
    {
        $this->activityCategory = $activityCategory;

        return $this;
    }

    /**
     * Get activityCategory
     *
     * @return string 
     */
    public function getActivityCategory()
    {
        return $this->activityCategory;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return EservVActivity
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set templateVersion
     *
     * @param string $templateVersion
     * @return EservVActivity
     */
    public function setTemplateVersion($templateVersion)
    {
        $this->templateVersion = $templateVersion;

        return $this;
    }

    /**
     * Get templateVersion
     *
     * @return string 
     */
    public function getTemplateVersion()
    {
        return $this->templateVersion;
    }

    /**
     * Set targetContact
     *
     * @param string $targetContact
     * @return EservVActivity
     */
    public function setTargetContact($targetContact)
    {
        $this->targetContact = $targetContact;

        return $this;
    }

    /**
     * Get targetContact
     *
     * @return string 
     */
    public function getTargetContact()
    {
        return $this->targetContact;
    }

    /**
     * Set targetContactId
     *
     * @param integer $targetContactId
     * @return EservVActivity
     */
    public function setTargetContactId($targetContactId)
    {
        $this->targetContactId = $targetContactId;

        return $this;
    }

    /**
     * Get targetContactId
     *
     * @return integer 
     */
    public function getTargetContactId()
    {
        return $this->targetContactId;
    }

    /**
     * Set sourceContact
     *
     * @param string $sourceContact
     * @return EservVActivity
     */
    public function setSourceContact($sourceContact)
    {
        $this->sourceContact = $sourceContact;

        return $this;
    }

    /**
     * Get sourceContact
     *
     * @return string 
     */
    public function getSourceContact()
    {
        return $this->sourceContact;
    }

    /**
     * Set userDepartment
     *
     * @param string $userDepartment
     * @return EservVActivity
     */
    public function setUserDepartment($userDepartment)
    {
        $this->userDepartment = $userDepartment;

        return $this;
    }

    /**
     * Get userDepartment
     *
     * @return string 
     */
    public function getUserDepartment()
    {
        return $this->userDepartment;
    }

    /**
     * Set activityTypeCode
     *
     * @param string $activityTypeCode
     * @return EservVActivity
     */
    public function setActivityTypeCode($activityTypeCode)
    {
        $this->activityTypeCode = $activityTypeCode;

        return $this;
    }

    /**
     * Get activityTypeCode
     *
     * @return string 
     */
    public function getActivityTypeCode()
    {
        return $this->activityTypeCode;
    }

    /**
     * Set gotoUrl
     *
     * @param string $gotoUrl
     * @return EservVActivity
     */
    public function setGotoUrl($gotoUrl)
    {
        $this->gotoUrl = $gotoUrl;

        return $this;
    }

    /**
     * Get gotoUrl
     *
     * @return string 
     */
    public function getGotoUrl()
    {
        return $this->gotoUrl;
    }

    /**
     * Set buttonLabel
     *
     * @param string $buttonLabel
     * @return EservVActivity
     */
    public function setButtonLabel($buttonLabel)
    {
        $this->buttonLabel = $buttonLabel;

        return $this;
    }

    /**
     * Get buttonLabel
     *
     * @return string 
     */
    public function getButtonLabel()
    {
        return $this->buttonLabel;
    }
    /**
     * @var integer
     */
    private $activitySourceId;

    /**
     * @var string
     */
    private $activitySourceName;


    /**
     * Set activitySourceId
     *
     * @param integer $activitySourceId
     * @return EservVActivity
     */
    public function setActivitySourceId($activitySourceId)
    {
        $this->activitySourceId = $activitySourceId;

        return $this;
    }

    /**
     * Get activitySourceId
     *
     * @return integer 
     */
    public function getActivitySourceId()
    {
        return $this->activitySourceId;
    }

    /**
     * Set activitySourceName
     *
     * @param string $activitySourceName
     * @return EservVActivity
     */
    public function setActivitySourceName($activitySourceName)
    {
        $this->activitySourceName = $activitySourceName;

        return $this;
    }

    /**
     * Get activitySourceName
     *
     * @return string 
     */
    public function getActivitySourceName()
    {
        return $this->activitySourceName;
    }
    /**
     * @var string
     */
    private $longDescription;


    /**
     * Set longDescription
     *
     * @param string $longDescription
     * @return EservVActivity
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
}
