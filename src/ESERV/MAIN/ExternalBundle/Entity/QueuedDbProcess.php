<?php

namespace ESERV\MAIN\ExternalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QueuedDbProcess
 */
class QueuedDbProcess
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $processed;

    /**
     * @var integer
     */
    private $attempts;

    /**
     * @var string
     */
    private $result;

    /**
     * @var integer
     */
    private $fileId;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return QueuedDbProcess
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return QueuedDbProcess
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
     * Set description
     *
     * @param string $description
     * @return QueuedDbProcess
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
     * Set processed
     *
     * @param string $processed
     * @return QueuedDbProcess
     */
    public function setProcessed($processed)
    {
        $this->processed = $processed;

        return $this;
    }

    /**
     * Get processed
     *
     * @return string 
     */
    public function getProcessed()
    {
        return $this->processed;
    }

    /**
     * Set attempts
     *
     * @param integer $attempts
     * @return QueuedDbProcess
     */
    public function setAttempts($attempts)
    {
        $this->attempts = $attempts;

        return $this;
    }

    /**
     * Get attempts
     *
     * @return integer 
     */
    public function getAttempts()
    {
        return $this->attempts;
    }

    /**
     * Set result
     *
     * @param string $result
     * @return QueuedDbProcess
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return string 
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set fileId
     *
     * @param integer $fileId
     * @return QueuedDbProcess
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return QueuedDbProcess
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
     * @return QueuedDbProcess
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
     * @return QueuedDbProcess
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
     * @return QueuedDbProcess
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
     * @return QueuedDbProcess
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
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode
     */
    private $notificationPriority;


    /**
     * Set notificationPriority
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $notificationPriority
     * @return QueuedDbProcess
     */
    public function setNotificationPriority(\ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $notificationPriority = null)
    {
        $this->notificationPriority = $notificationPriority;

        return $this;
    }

    /**
     * Get notificationPriority
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode 
     */
    public function getNotificationPriority()
    {
        return $this->notificationPriority;
    }
}
