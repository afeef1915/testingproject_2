<?php

namespace ESERV\MAIN\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MmHelpMessage
 */
class MmHelpMessage
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
     * @var string
     */
    private $isActive;

    /**
     * @var string
     */
    private $moreLink;

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
     * @var integer
     */
    private $createdBy;

    /**
     * @var integer
     */
    private $updatedBy;

    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode
     */
    private $messageType;

    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode
     */
    private $severity;


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
     * @return MmHelpMessage
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
     * @return MmHelpMessage
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
     * Set isActive
     *
     * @param string $isActive
     * @return MmHelpMessage
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
     * @return MmHelpMessage
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
     * Set title
     *
     * @param string $title
     * @return MmHelpMessage
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
     * @return MmHelpMessage
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
     * @return MmHelpMessage
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
     * @return MmHelpMessage
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
     * @return MmHelpMessage
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
     * Set messageType
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $messageType
     * @return MmHelpMessage
     */
    public function setMessageType(\ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $messageType = null)
    {
        $this->messageType = $messageType;

        return $this;
    }

    /**
     * Get messageType
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode 
     */
    public function getMessageType()
    {
        return $this->messageType;
    }

    /**
     * Set severity
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $severity
     * @return MmHelpMessage
     */
    public function setSeverity(\ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $severity = null)
    {
        $this->severity = $severity;

        return $this;
    }

    /**
     * Get severity
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode 
     */
    public function getSeverity()
    {
        return $this->severity;
    }
}
