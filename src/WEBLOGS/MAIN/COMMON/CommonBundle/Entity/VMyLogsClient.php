<?php

namespace WEBLOGS\MAIN\COMMON\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VMyLogsClient
 */
class VMyLogsClient
{
    /**
     * @var string
     */
    private $job_no;

    /**
     * @var string
     */
    private $customer;

    /**
     * @var string
     */
    private $category;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $attention_of;

    /**
     * @var string
     */
    private $requested_by;

    /**
     * @var \DateTime
     */
    private $requested;

    /**
     * @var string
     */
    private $priority;

    /**
     * @var string
     */
    private $developer_status;

    /**
     * @var string
     */
    private $mtl;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * @var \DateTime
     */
    private $dueby;

    /**
     * @var string
     */
    private $dev_status;

    /**
     * @var string
     */
    private $customer_log_id;

    /**
     * @var string
     */
    private $assigned_to;

    /**
     * @var string
     */
    private $brief_description;

    /**
     * @var string
     */
    private $mtl_description;

    /**
     * @var string
     */
    private $task_description;

    /**
     * @var string
     */
    private $version_no;

    /**
     * @var string
     */
    private $chargeable;

    /**
     * @var string
     */
    private $mlo_quote_id;

    /**
     * @var string
     */
    private $completed_by;

    /**
     * @var \DateTime
     */
    private $date_completed;

    /**
     * @var string
     */
    private $mtl_status;

    /**
     * @var string
     */
    private $user_id;


    /**
     * Set job_no
     *
     * @param string $jobNo
     * @return VMyLogsClient
     */
    public function setJobNo($jobNo)
    {
        $this->job_no = $jobNo;

        return $this;
    }

    /**
     * Get job_no
     *
     * @return string 
     */
    public function getJobNo()
    {
        return $this->job_no;
    }

    /**
     * Set customer
     *
     * @param string $customer
     * @return VMyLogsClient
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return string 
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return VMyLogsClient
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return VMyLogsClient
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set attention_of
     *
     * @param string $attentionOf
     * @return VMyLogsClient
     */
    public function setAttentionOf($attentionOf)
    {
        $this->attention_of = $attentionOf;

        return $this;
    }

    /**
     * Get attention_of
     *
     * @return string 
     */
    public function getAttentionOf()
    {
        return $this->attention_of;
    }

    /**
     * Set requested_by
     *
     * @param string $requestedBy
     * @return VMyLogsClient
     */
    public function setRequestedBy($requestedBy)
    {
        $this->requested_by = $requestedBy;

        return $this;
    }

    /**
     * Get requested_by
     *
     * @return string 
     */
    public function getRequestedBy()
    {
        return $this->requested_by;
    }

    /**
     * Set requested
     *
     * @param \DateTime $requested
     * @return VMyLogsClient
     */
    public function setRequested($requested)
    {
        $this->requested = $requested;

        return $this;
    }

    /**
     * Get requested
     *
     * @return \DateTime 
     */
    public function getRequested()
    {
        return $this->requested;
    }

    /**
     * Set priority
     *
     * @param string $priority
     * @return VMyLogsClient
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return string 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set developer_status
     *
     * @param string $developerStatus
     * @return VMyLogsClient
     */
    public function setDeveloperStatus($developerStatus)
    {
        $this->developer_status = $developerStatus;

        return $this;
    }

    /**
     * Get developer_status
     *
     * @return string 
     */
    public function getDeveloperStatus()
    {
        return $this->developer_status;
    }

    /**
     * Set mtl
     *
     * @param string $mtl
     * @return VMyLogsClient
     */
    public function setMtl($mtl)
    {
        $this->mtl = $mtl;

        return $this;
    }

    /**
     * Get mtl
     *
     * @return string 
     */
    public function getMtl()
    {
        return $this->mtl;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return VMyLogsClient
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set dueby
     *
     * @param \DateTime $dueby
     * @return VMyLogsClient
     */
    public function setDueby($dueby)
    {
        $this->dueby = $dueby;

        return $this;
    }

    /**
     * Get dueby
     *
     * @return \DateTime 
     */
    public function getDueby()
    {
        return $this->dueby;
    }

    /**
     * Set dev_status
     *
     * @param string $devStatus
     * @return VMyLogsClient
     */
    public function setDevStatus($devStatus)
    {
        $this->dev_status = $devStatus;

        return $this;
    }

    /**
     * Get dev_status
     *
     * @return string 
     */
    public function getDevStatus()
    {
        return $this->dev_status;
    }

    /**
     * Set customer_log_id
     *
     * @param string $customerLogId
     * @return VMyLogsClient
     */
    public function setCustomerLogId($customerLogId)
    {
        $this->customer_log_id = $customerLogId;

        return $this;
    }

    /**
     * Get customer_log_id
     *
     * @return string 
     */
    public function getCustomerLogId()
    {
        return $this->customer_log_id;
    }

    /**
     * Set assigned_to
     *
     * @param string $assignedTo
     * @return VMyLogsClient
     */
    public function setAssignedTo($assignedTo)
    {
        $this->assigned_to = $assignedTo;

        return $this;
    }

    /**
     * Get assigned_to
     *
     * @return string 
     */
    public function getAssignedTo()
    {
        return $this->assigned_to;
    }

    /**
     * Set brief_description
     *
     * @param string $briefDescription
     * @return VMyLogsClient
     */
    public function setBriefDescription($briefDescription)
    {
        $this->brief_description = $briefDescription;

        return $this;
    }

    /**
     * Get brief_description
     *
     * @return string 
     */
    public function getBriefDescription()
    {
        return $this->brief_description;
    }

    /**
     * Set mtl_description
     *
     * @param string $mtlDescription
     * @return VMyLogsClient
     */
    public function setMtlDescription($mtlDescription)
    {
        $this->mtl_description = $mtlDescription;

        return $this;
    }

    /**
     * Get mtl_description
     *
     * @return string 
     */
    public function getMtlDescription()
    {
        return $this->mtl_description;
    }

    /**
     * Set task_description
     *
     * @param string $taskDescription
     * @return VMyLogsClient
     */
    public function setTaskDescription($taskDescription)
    {
        $this->task_description = $taskDescription;

        return $this;
    }

    /**
     * Get task_description
     *
     * @return string 
     */
    public function getTaskDescription()
    {
        return $this->task_description;
    }

    /**
     * Set version_no
     *
     * @param string $versionNo
     * @return VMyLogsClient
     */
    public function setVersionNo($versionNo)
    {
        $this->version_no = $versionNo;

        return $this;
    }

    /**
     * Get version_no
     *
     * @return string 
     */
    public function getVersionNo()
    {
        return $this->version_no;
    }

    /**
     * Set chargeable
     *
     * @param string $chargeable
     * @return VMyLogsClient
     */
    public function setChargeable($chargeable)
    {
        $this->chargeable = $chargeable;

        return $this;
    }

    /**
     * Get chargeable
     *
     * @return string 
     */
    public function getChargeable()
    {
        return $this->chargeable;
    }

    /**
     * Set mlo_quote_id
     *
     * @param string $mloQuoteId
     * @return VMyLogsClient
     */
    public function setMloQuoteId($mloQuoteId)
    {
        $this->mlo_quote_id = $mloQuoteId;

        return $this;
    }

    /**
     * Get mlo_quote_id
     *
     * @return string 
     */
    public function getMloQuoteId()
    {
        return $this->mlo_quote_id;
    }

    /**
     * Set completed_by
     *
     * @param string $completedBy
     * @return VMyLogsClient
     */
    public function setCompletedBy($completedBy)
    {
        $this->completed_by = $completedBy;

        return $this;
    }

    /**
     * Get completed_by
     *
     * @return string 
     */
    public function getCompletedBy()
    {
        return $this->completed_by;
    }

    /**
     * Set date_completed
     *
     * @param \DateTime $dateCompleted
     * @return VMyLogsClient
     */
    public function setDateCompleted($dateCompleted)
    {
        $this->date_completed = $dateCompleted;

        return $this;
    }

    /**
     * Get date_completed
     *
     * @return \DateTime 
     */
    public function getDateCompleted()
    {
        return $this->date_completed;
    }

    /**
     * Set mtl_status
     *
     * @param string $mtlStatus
     * @return VMyLogsClient
     */
    public function setMtlStatus($mtlStatus)
    {
        $this->mtl_status = $mtlStatus;

        return $this;
    }

    /**
     * Get mtl_status
     *
     * @return string 
     */
    public function getMtlStatus()
    {
        return $this->mtl_status;
    }

    /**
     * Set user_id
     *
     * @param string $userId
     * @return VMyLogsClient
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get user_id
     *
     * @return string 
     */
    public function getUserId()
    {
        return $this->user_id;
    }
}
