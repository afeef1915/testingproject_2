<?php

namespace ESERV\MAIN\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EservVMmHelpMessage
 */
class EservVMmHelpMessage
{
    /**
     * @var integer
     */
    private $id;
    
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $messageTypeId;

    /**
     * @var string
     */
    private $messageTypeCode;

    /**
     * @var string
     */
    private $messageTypeName;

    /**
     * @var string
     */
    private $isActive;

    /**
     * @var string
     */
    private $moreLink;

    /**
     * @var integer
     */
    private $severityId;

    /**
     * @var string
     */
    private $severityCode;

    /**
     * @var string
     */
    private $severityName;

    /**
     * @var string
     */
    private $title;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;


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
     * Set code
     *
     * @param string $code
     * @return EservVMmHelpMessage
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return EservVMmHelpMessage
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
     * Set messageTypeId
     *
     * @param integer $messageTypeId
     * @return EservVMmHelpMessage
     */
    public function setMessageTypeId($messageTypeId)
    {
        $this->messageTypeId = $messageTypeId;

        return $this;
    }

    /**
     * Get messageTypeId
     *
     * @return integer 
     */
    public function getMessageTypeId()
    {
        return $this->messageTypeId;
    }

    /**
     * Set messageTypeCode
     *
     * @param string $messageTypeCode
     * @return EservVMmHelpMessage
     */
    public function setMessageTypeCode($messageTypeCode)
    {
        $this->messageTypeCode = $messageTypeCode;

        return $this;
    }

    /**
     * Get messageTypeCode
     *
     * @return string 
     */
    public function getMessageTypeCode()
    {
        return $this->messageTypeCode;
    }

    /**
     * Set messageTypeName
     *
     * @param string $messageTypeName
     * @return EservVMmHelpMessage
     */
    public function setMessageTypeName($messageTypeName)
    {
        $this->messageTypeName = $messageTypeName;

        return $this;
    }

    /**
     * Get messageTypeName
     *
     * @return string 
     */
    public function getMessageTypeName()
    {
        return $this->messageTypeName;
    }

    /**
     * Set isActive
     *
     * @param string $isActive
     * @return EservVMmHelpMessage
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
     * Set moreLink
     *
     * @param string $moreLink
     * @return EservVMmHelpMessage
     */
    public function setMoreLink($moreLink)
    {
        $this->moreLink = $moreLink;

        return $this;
    }

    /**
     * Get moreLink
     *
     * @return string 
     */
    public function getMoreLink()
    {
        return $this->moreLink;
    }

    /**
     * Set severityId
     *
     * @param integer $severityId
     * @return EservVMmHelpMessage
     */
    public function setSeverityId($severityId)
    {
        $this->severityId = $severityId;

        return $this;
    }

    /**
     * Get severityId
     *
     * @return integer 
     */
    public function getSeverityId()
    {
        return $this->severityId;
    }

    /**
     * Set severityCode
     *
     * @param string $severityCode
     * @return EservVMmHelpMessage
     */
    public function setSeverityCode($severityCode)
    {
        $this->severityCode = $severityCode;

        return $this;
    }

    /**
     * Get severityCode
     *
     * @return string 
     */
    public function getSeverityCode()
    {
        return $this->severityCode;
    }

    /**
     * Set severityName
     *
     * @param string $severityName
     * @return EservVMmHelpMessage
     */
    public function setSeverityName($severityName)
    {
        $this->severityName = $severityName;

        return $this;
    }

    /**
     * Get severityName
     *
     * @return string 
     */
    public function getSeverityName()
    {
        return $this->severityName;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return EservVMmHelpMessage
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return EservVMmHelpMessage
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
     * @return EservVMmHelpMessage
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
}
