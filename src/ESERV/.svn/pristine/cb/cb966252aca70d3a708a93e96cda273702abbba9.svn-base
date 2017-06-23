<?php

namespace ESERV\MAIN\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserNotificationStatus
 */
class UserNotificationStatus
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $statusRead;

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
     * @var \ESERV\MAIN\ProfileBundle\Entity\UserNotification
     */
    private $userNotification;


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
     * Set statusRead
     *
     * @param string $statusRead
     * @return UserNotificationStatus
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return UserNotificationStatus
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
     * @return UserNotificationStatus
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
     * @return UserNotificationStatus
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
     * @return UserNotificationStatus
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
     * Set userNotification
     *
     * @param \ESERV\MAIN\ProfileBundle\Entity\UserNotification $userNotification
     * @return UserNotificationStatus
     */
    public function setUserNotification(\ESERV\MAIN\ProfileBundle\Entity\UserNotification $userNotification = null)
    {
        $this->userNotification = $userNotification;

        return $this;
    }

    /**
     * Get userNotification
     *
     * @return \ESERV\MAIN\ProfileBundle\Entity\UserNotification 
     */
    public function getUserNotification()
    {
        return $this->userNotification;
    }
}
