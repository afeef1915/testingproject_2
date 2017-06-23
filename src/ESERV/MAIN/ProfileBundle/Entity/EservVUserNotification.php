<?php

namespace ESERV\MAIN\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EservVUserNotification
 */
class EservVUserNotification
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $userNotificationId;

    /**
     * @var integer
     */
    private $fosUserId;

    /**
     * @var string
     */
    private $type;

    /**
     * @var integer
     */
    private $fileId;

    /**
     * @var string
     */
    private $priority;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $isActive;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $createdBy;

    /**
     * @var string
     */
    private $statusRead;

    /**
     * @var \DateTime
     */
    private $notifStatusCreatedAt;

    /**
     * @var \DateTime
     */
    private $notifStatusUpdatedAt;

    /**
     * @var integer
     */
    private $notifStatusCreatedBy;

    /**
     * @var integer
     */
    private $notifStatusUpdatedBy;


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
     * Set userNotificationId
     *
     * @param integer $userNotificationId
     * @return EservVUserNotification
     */
    public function setUserNotificationId($userNotificationId)
    {
        $this->userNotificationId = $userNotificationId;

        return $this;
    }

    /**
     * Get userNotificationId
     *
     * @return integer 
     */
    public function getUserNotificationId()
    {
        return $this->userNotificationId;
    }

    /**
     * Set fosUserId
     *
     * @param integer $fosUserId
     * @return EservVUserNotification
     */
    public function setFosUserId($fosUserId)
    {
        $this->fosUserId = $fosUserId;

        return $this;
    }

    /**
     * Get fosUserId
     *
     * @return integer 
     */
    public function getFosUserId()
    {
        return $this->fosUserId;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return EservVUserNotification
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set fileId
     *
     * @param integer $fileId
     * @return EservVUserNotification
     */
    public function setFileId($fileId)
    {
        $this->fileId = $fileId;

        return $this;
    }

    /**
     * Get fileId
     *
     * @return integer 
     */
    public function getFileId()
    {
        return $this->fileId;
    }

    /**
     * Set priority
     *
     * @param string $priority
     * @return EservVUserNotification
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
     * Set title
     *
     * @param string $title
     * @return EservVUserNotification
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
     * Set description
     *
     * @param string $description
     * @return EservVUserNotification
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
     * Set isActive
     *
     * @param string $isActive
     * @return EservVUserNotification
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return string 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return EservVUserNotification
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
     * Set createdBy
     *
     * @param integer $createdBy
     * @return EservVUserNotification
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
     * Set statusRead
     *
     * @param string $statusRead
     * @return EservVUserNotification
     */
    public function setStatusRead($statusRead)
    {
        $this->statusRead = $statusRead;

        return $this;
    }

    /**
     * Get statusRead
     *
     * @return string 
     */
    public function getStatusRead()
    {
        return $this->statusRead;
    }

    /**
     * Set notifStatusCreatedAt
     *
     * @param \DateTime $notifStatusCreatedAt
     * @return EservVUserNotification
     */
    public function setNotifStatusCreatedAt($notifStatusCreatedAt)
    {
        $this->notifStatusCreatedAt = $notifStatusCreatedAt;

        return $this;
    }

    /**
     * Get notifStatusCreatedAt
     *
     * @return \DateTime 
     */
    public function getNotifStatusCreatedAt()
    {
        return $this->notifStatusCreatedAt;
    }

    /**
     * Set notifStatusUpdatedAt
     *
     * @param \DateTime $notifStatusUpdatedAt
     * @return EservVUserNotification
     */
    public function setNotifStatusUpdatedAt($notifStatusUpdatedAt)
    {
        $this->notifStatusUpdatedAt = $notifStatusUpdatedAt;

        return $this;
    }

    /**
     * Get notifStatusUpdatedAt
     *
     * @return \DateTime 
     */
    public function getNotifStatusUpdatedAt()
    {
        return $this->notifStatusUpdatedAt;
    }

    /**
     * Set notifStatusCreatedBy
     *
     * @param integer $notifStatusCreatedBy
     * @return EservVUserNotification
     */
    public function setNotifStatusCreatedBy($notifStatusCreatedBy)
    {
        $this->notifStatusCreatedBy = $notifStatusCreatedBy;

        return $this;
    }

    /**
     * Get notifStatusCreatedBy
     *
     * @return integer 
     */
    public function getNotifStatusCreatedBy()
    {
        return $this->notifStatusCreatedBy;
    }

    /**
     * Set notifStatusUpdatedBy
     *
     * @param integer $notifStatusUpdatedBy
     * @return EservVUserNotification
     */
    public function setNotifStatusUpdatedBy($notifStatusUpdatedBy)
    {
        $this->notifStatusUpdatedBy = $notifStatusUpdatedBy;

        return $this;
    }

    /**
     * Get notifStatusUpdatedBy
     *
     * @return integer 
     */
    public function getNotifStatusUpdatedBy()
    {
        return $this->notifStatusUpdatedBy;
    }
    /**
     * @var string
     */
    private $priorityCode;


    /**
     * Set priorityCode
     *
     * @param string $priorityCode
     * @return EservVUserNotification
     */
    public function setPriorityCode($priorityCode)
    {
        $this->priorityCode = $priorityCode;

        return $this;
    }

    /**
     * Get priorityCode
     *
     * @return string 
     */
    public function getPriorityCode()
    {
        return $this->priorityCode;
    }
    /**
     * @var string
     */
    private $priorityOrder;


    /**
     * Set priorityOrder
     *
     * @param string $priorityOrder
     * @return EservVUserNotification
     */
    public function setPriorityOrder($priorityOrder)
    {
        $this->priorityOrder = $priorityOrder;

        return $this;
    }

    /**
     * Get priorityOrder
     *
     * @return string 
     */
    public function getPriorityOrder()
    {
        return $this->priorityOrder;
    }
    /**
     * @var string
     */
    private $levelCode;

    /**
     * @var string
     */
    private $levelDescription;


    /**
     * Set levelCode
     *
     * @param string $levelCode
     * @return EservVUserNotification
     */
    public function setLevel($levelCode)
    {
        $this->levelCode = $levelCode;

        return $this;
    }

    /**
     * Get levelCode
     *
     * @return string 
     */
    public function getLevel()
    {
        return $this->levelCode;
    }

    /**
     * Set levelDescription
     *
     * @param string $levelDescription
     * @return EservVUserNotification
     */
    public function setLevelDescription($levelDescription)
    {
        $this->levelDescription = $levelDescription;

        return $this;
    }

    /**
     * Get levelDescription
     *
     * @return string 
     */
    public function getLevelDescription()
    {
        return $this->levelDescription;
    }

    /**
     * Set levelCode
     *
     * @param string $levelCode
     * @return EservVUserNotification
     */
    public function setLevelCode($levelCode)
    {
        $this->levelCode = $levelCode;

        return $this;
    }

    /**
     * Get levelCode
     *
     * @return string 
     */
    public function getLevelCode()
    {
        return $this->levelCode;
    }
    /**
     * @var string
     */
    private $createdAtDate;

    /**
     * @var string
     */
    private $createdAtTime;


    /**
     * Set createdAtDate
     *
     * @param string $createdAtDate
     * @return EservVUserNotification
     */
    public function setCreatedAtDate($createdAtDate)
    {
        $this->createdAtDate = $createdAtDate;

        return $this;
    }

    /**
     * Get createdAtDate
     *
     * @return string 
     */
    public function getCreatedAtDate()
    {
        return $this->createdAtDate;
    }

    /**
     * Set createdAtTime
     *
     * @param string $createdAtTime
     * @return EservVUserNotification
     */
    public function setCreatedAtTime($createdAtTime)
    {
        $this->createdAtTime = $createdAtTime;

        return $this;
    }

    /**
     * Get createdAtTime
     *
     * @return string 
     */
    public function getCreatedAtTime()
    {
        return $this->createdAtTime;
    }
}
