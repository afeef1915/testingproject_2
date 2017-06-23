<?php

namespace ESERV\MAIN\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserNotification
 */
class UserNotification
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
     * @var \ESERV\MAIN\SecurityBundle\Entity\User
     */
    private $fosUser;

    /**
     * @var \ESERV\MAIN\ProfileBundle\Entity\MmUserProfile
     */
    private $mmUserProfile;


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
     * @return UserNotification
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
     * @return UserNotification
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
     * @return UserNotification
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
     * @return UserNotification
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
     * @return UserNotification
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
     * @return UserNotification
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
     * @return UserNotification
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
     * @return UserNotification
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
     * @return UserNotification
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
     * @return UserNotification
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
     * Set fosUser
     *
     * @param \ESERV\MAIN\SecurityBundle\Entity\User $fosUser
     * @return UserNotification
     */
    public function setFosUser(\ESERV\MAIN\SecurityBundle\Entity\User $fosUser = null)
    {
        $this->fosUser = $fosUser;

        return $this;
    }

    /**
     * Get fosUser
     *
     * @return \ESERV\MAIN\SecurityBundle\Entity\User 
     */
    public function getFosUser()
    {
        return $this->fosUser;
    }

    /**
     * Set mmUserProfile
     *
     * @param \ESERV\MAIN\ProfileBundle\Entity\MmUserProfile $mmUserProfile
     * @return UserNotification
     */
    public function setMmUserProfile(\ESERV\MAIN\ProfileBundle\Entity\MmUserProfile $mmUserProfile = null)
    {
        $this->mmUserProfile = $mmUserProfile;

        return $this;
    }

    /**
     * Get mmUserProfile
     *
     * @return \ESERV\MAIN\ProfileBundle\Entity\MmUserProfile 
     */
    public function getMmUserProfile()
    {
        return $this->mmUserProfile;
    }
    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode
     */
    private $level;


    /**
     * Set level
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $level
     * @return UserNotification
     */
    public function setLevel(\ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $level = null)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode 
     */
    public function getLevel()
    {
        return $this->level;
    }
}
