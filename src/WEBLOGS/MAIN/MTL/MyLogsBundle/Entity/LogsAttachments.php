<?php

namespace WEBLOGS\MAIN\MTL\MyLogsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogsAttachments
 */
class LogsAttachments
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $log_id;

    /**
     * @var string
     */
    private $media_store_id;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \DateTime
     */
    private $created_by;

    /**
     * @var \DateTime
     */
    private $updated_by;


    /**
     * Set id
     *
     * @param string $id
     * @return LogsAttachments
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set log_id
     *
     * @param string $logId
     * @return LogsAttachments
     */
    public function setLogId($logId)
    {
        $this->log_id = $logId;

        return $this;
    }

    /**
     * Get log_id
     *
     * @return string 
     */
    public function getLogId()
    {
        return $this->log_id;
    }

    /**
     * Set media_store_id
     *
     * @param string $mediaStoreId
     * @return LogsAttachments
     */
    public function setMediaStoreId($mediaStoreId)
    {
        $this->media_store_id = $mediaStoreId;

        return $this;
    }

    /**
     * Get media_store_id
     *
     * @return string 
     */
    public function getMediaStoreId()
    {
        return $this->media_store_id;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return LogsAttachments
     */
    public function setCreatedAt($createdAt)
    {
       // $this->created_at = $createdAt;
        $this->created_at = new \DateTime("now");

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return LogsAttachments
     */
    public function setUpdatedAt($updatedAt)
    {
        //$this->updated_at = $updatedAt;
         $this->updated_at =new \DateTime("now");

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set created_by
     *
     * @param \DateTime $createdBy
     * @return LogsAttachments
     */
    public function setCreatedBy($createdBy)
    {
       // $this->created_by = $createdBy;
        $this->created_by=new \DateTime("now");

        return $this;
    }

    /**
     * Get created_by
     *
     * @return \DateTime 
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Set updated_by
     *
     * @param \DateTime $updatedBy
     * @return LogsAttachments
     */
    public function setUpdatedBy($updatedBy)
    {
       // $this->updated_by = $updatedBy;
        $this->updated_by=new \DateTime("now");
        return $this;
    }

    /**
     * Get updated_by
     *
     * @return \DateTime 
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }
    /**
     * @var string
     */
    private $user_id;


    /**
     * Set user_id
     *
     * @param string $userId
     * @return LogsAttachments
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
