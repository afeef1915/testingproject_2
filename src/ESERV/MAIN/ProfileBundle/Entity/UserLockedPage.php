<?php

namespace ESERV\MAIN\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserLockedPage
 */
class UserLockedPage
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
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $pageId;

    /**
     * @var \DateTime
     */
    private $lockedAt;

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
     * Set type
     *
     * @param string $type
     * @return UserLockedPage
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
     * Set url
     *
     * @param string $url
     * @return UserLockedPage
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set pageId
     *
     * @param string $pageId
     * @return UserLockedPage
     */
    public function setPageId($pageId)
    {
        $this->pageId = $pageId;

        return $this;
    }

    /**
     * Get pageId
     *
     * @return string 
     */
    public function getPageId()
    {
        return $this->pageId;
    }

    /**
     * Set lockedAt
     *
     * @param \DateTime $lockedAt
     * @return UserLockedPage
     */
    public function setLockedAt($lockedAt)
    {
        $this->lockedAt = $lockedAt;

        return $this;
    }

    /**
     * Get lockedAt
     *
     * @return \DateTime 
     */
    public function getLockedAt()
    {
        return $this->lockedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return UserLockedPage
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
     * @return UserLockedPage
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
     * @return UserLockedPage
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
     * @return UserLockedPage
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
     * @return UserLockedPage
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
     * @var string
     */
    private $pageCode;


    /**
     * Set pageCode
     *
     * @param string $pageCode
     * @return UserLockedPage
     */
    public function setPageCode($pageCode)
    {
        $this->pageCode = $pageCode;

        return $this;
    }

    /**
     * Get pageCode
     *
     * @return string 
     */
    public function getPageCode()
    {
        return $this->pageCode;
    }
    /**
     * @var string
     */
    private $phpSesId;


    /**
     * Set phpSesId
     *
     * @param string $phpSesId
     * @return UserLockedPage
     */
    public function setPhpSesId($phpSesId)
    {
        $this->phpSesId = $phpSesId;

        return $this;
    }

    /**
     * Get phpSesId
     *
     * @return string 
     */
    public function getPhpSesId()
    {
        return $this->phpSesId;
    }
}
