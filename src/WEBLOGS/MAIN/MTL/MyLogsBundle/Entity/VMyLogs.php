<?php

namespace WEBLOGS\MAIN\MTL\MyLogsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VMyLogs
 */
class VMyLogs
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
    private $status;

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
    private $task_description;


    /**
     * Set job_no
     *
     * @param string $jobNo
     * @return VMyLogs
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
     * @return VMyLogs
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
     * @return VMyLogs
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
     * @return VMyLogs
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
     * @return VMyLogs
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
     * @return VMyLogs
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
     * @return VMyLogs
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
     * @return VMyLogs
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
     * Set status
     *
     * @param string $status
     * @return VMyLogs
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
     * Set mtl
     *
     * @param string $mtl
     * @return VMyLogs
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
     * @return VMyLogs
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
     * @return VMyLogs
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
     * @return VMyLogs
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
     * @return VMyLogs
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
     * @return VMyLogs
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
     * Set task_description
     *
     * @param string $taskDescription
     * @return VMyLogs
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
}
