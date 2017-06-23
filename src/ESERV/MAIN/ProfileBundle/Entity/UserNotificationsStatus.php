<?php

namespace ESERV\MAIN\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserNotificationsStatus
 */
class UserNotificationsStatus
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $fos_user_id;

    /**
     * @var integer
     */
    private $user_notifications_id;

    /**
     * @var string
     */
    private $status_read;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var integer
     */
    private $created_by;

    /**
     * @var integer
     */
    private $updated_by;

    /**
     * @var \FOS\UserBundle\Model\User
     */
    private $fos_user;

    /**
     * @var \ESERV\MAIN\ProfileBundle\Entity\UserNotifications
     */
    private $user_notifications;


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
     * Set fos_user_id
     *
     * @param integer $fosUserId
     * @return UserNotificationsStatus
     */
    public function setFosUserId($fosUserId)
    {
        $this->fos_user_id = $fosUserId;

        return $this;
    }

    /**
     * Get fos_user_id
     *
     * @return integer 
     */
    public function getFosUserId()
    {
        return $this->fos_user_id;
    }

    /**
     * Set user_notifications_id
     *
     * @param integer $userNotificationsId
     * @return UserNotificationsStatus
     */
    public function setUserNotificationsId($userNotificationsId)
    {
        $this->user_notifications_id = $userNotificationsId;

        return $this;
    }

    /**
     * Get user_notifications_id
     *
     * @return integer 
     */
    public function getUserNotificationsId()
    {
        return $this->user_notifications_id;
    }

    /**
     * Set status_read
     *
     * @param string $statusRead
     * @return UserNotificationsStatus
     */
    public function setStatusRead($statusRead)
    {
        $this->status_read = $statusRead;

        return $this;
    }

    /**
     * Get status_read
     *
     * @return string 
     */
    public function getStatusRead()
    {
        return $this->status_read;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return UserNotificationsStatus
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

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
     * @return UserNotificationsStatus
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

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
     * @param integer $createdBy
     * @return UserNotificationsStatus
     */
    public function setCreatedBy($createdBy)
    {
        $this->created_by = $createdBy;

        return $this;
    }

    /**
     * Get created_by
     *
     * @return integer 
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Set updated_by
     *
     * @param integer $updatedBy
     * @return UserNotificationsStatus
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updated_by = $updatedBy;

        return $this;
    }

    /**
     * Get updated_by
     *
     * @return integer 
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }

    /**
     * Set fos_user
     *
     * @param \FOS\UserBundle\Model\User $fosUser
     * @return UserNotificationsStatus
     */
    public function setFosUser(\FOS\UserBundle\Model\User $fosUser = null)
    {
        $this->fos_user = $fosUser;

        return $this;
    }

    /**
     * Get fos_user
     *
     * @return \FOS\UserBundle\Model\User 
     */
    public function getFosUser()
    {
        return $this->fos_user;
    }

    /**
     * Set user_notifications
     *
     * @param \ESERV\MAIN\ProfileBundle\Entity\UserNotifications $userNotifications
     * @return UserNotificationsStatus
     */
    public function setUserNotifications(\ESERV\MAIN\ProfileBundle\Entity\UserNotifications $userNotifications = null)
    {
        $this->user_notifications = $userNotifications;

        return $this;
    }

    /**
     * Get user_notifications
     *
     * @return \ESERV\MAIN\ProfileBundle\Entity\UserNotifications 
     */
    public function getUserNotifications()
    {
        return $this->user_notifications;
    }
}
