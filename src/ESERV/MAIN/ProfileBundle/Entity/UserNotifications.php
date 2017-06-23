<?php

namespace ESERV\MAIN\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserNotifications
 */
class UserNotifications
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var integer
     */
    private $mm_user_profile_id;

    /**
     * @var integer
     */
    private $fos_user_id;

    /**
     * @var integer
     */
    private $file_id;

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
    private $is_active;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $user_notifications_status;

    /**
     * @var \ESERV\MAIN\ProfileBundle\Entity\MmUserProfile
     */
    private $mm_user_profile;

    /**
     * @var \FOS\UserBundle\Model\User
     */
    private $fos_user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user_notifications_status = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set type
     *
     * @param string $type
     * @return UserNotifications
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
     * Set mm_user_profile_id
     *
     * @param integer $mmUserProfileId
     * @return UserNotifications
     */
    public function setMmUserProfileId($mmUserProfileId)
    {
        $this->mm_user_profile_id = $mmUserProfileId;

        return $this;
    }

    /**
     * Get mm_user_profile_id
     *
     * @return integer 
     */
    public function getMmUserProfileId()
    {
        return $this->mm_user_profile_id;
    }

    /**
     * Set fos_user_id
     *
     * @param integer $fosUserId
     * @return UserNotifications
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
     * Set file_id
     *
     * @param integer $fileId
     * @return UserNotifications
     */
    public function setFileId($fileId)
    {
        $this->file_id = $fileId;

        return $this;
    }

    /**
     * Get file_id
     *
     * @return integer 
     */
    public function getFileId()
    {
        return $this->file_id;
    }

    /**
     * Set priority
     *
     * @param string $priority
     * @return UserNotifications
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
     * @return UserNotifications
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
     * @return UserNotifications
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
     * Set is_active
     *
     * @param string $isActive
     * @return UserNotifications
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;

        return $this;
    }

    /**
     * Get is_active
     *
     * @return string 
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return UserNotifications
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
     * @return UserNotifications
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
     * @return UserNotifications
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
     * @return UserNotifications
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
     * Add user_notifications_status
     *
     * @param \ESERV\MAIN\ProfileBundle\Entity\UserNotificationsStatus $userNotificationsStatus
     * @return UserNotifications
     */
    public function addUserNotificationsStatus(\ESERV\MAIN\ProfileBundle\Entity\UserNotificationsStatus $userNotificationsStatus)
    {
        $this->user_notifications_status[] = $userNotificationsStatus;

        return $this;
    }

    /**
     * Remove user_notifications_status
     *
     * @param \ESERV\MAIN\ProfileBundle\Entity\UserNotificationsStatus $userNotificationsStatus
     */
    public function removeUserNotificationsStatus(\ESERV\MAIN\ProfileBundle\Entity\UserNotificationsStatus $userNotificationsStatus)
    {
        $this->user_notifications_status->removeElement($userNotificationsStatus);
    }

    /**
     * Get user_notifications_status
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserNotificationsStatus()
    {
        return $this->user_notifications_status;
    }

    /**
     * Set mm_user_profile
     *
     * @param \ESERV\MAIN\ProfileBundle\Entity\MmUserProfile $mmUserProfile
     * @return UserNotifications
     */
    public function setMmUserProfile(\ESERV\MAIN\ProfileBundle\Entity\MmUserProfile $mmUserProfile = null)
    {
        $this->mm_user_profile = $mmUserProfile;

        return $this;
    }

    /**
     * Get mm_user_profile
     *
     * @return \ESERV\MAIN\ProfileBundle\Entity\MmUserProfile 
     */
    public function getMmUserProfile()
    {
        return $this->mm_user_profile;
    }

    /**
     * Set fos_user
     *
     * @param \FOS\UserBundle\Model\User $fosUser
     * @return UserNotifications
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
}
