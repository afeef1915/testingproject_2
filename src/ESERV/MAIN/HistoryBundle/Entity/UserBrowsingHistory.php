<?php

namespace ESERV\MAIN\HistoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserBrowsingHistory
 */
class UserBrowsingHistory
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
    private $selected;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $parent;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $controls;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $histUrl;

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
     * @return UserBrowsingHistory
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
     * Set selected
     *
     * @param string $selected
     * @return UserBrowsingHistory
     */
    public function setSelected($selected)
    {
        $this->selected = $selected;

        return $this;
    }

    /**
     * Get selected
     *
     * @return string 
     */
    public function getSelected()
    {
        return $this->selected;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return UserBrowsingHistory
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
     * Set parent
     *
     * @param string $parent
     * @return UserBrowsingHistory
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return string 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return UserBrowsingHistory
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set controls
     *
     * @param string $controls
     * @return UserBrowsingHistory
     */
    public function setControls($controls)
    {
        $this->controls = $controls;

        return $this;
    }

    /**
     * Get controls
     *
     * @return string 
     */
    public function getControls()
    {
        return $this->controls;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return UserBrowsingHistory
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
     * Set histUrl
     *
     * @param string $histUrl
     * @return UserBrowsingHistory
     */
    public function setHistUrl($histUrl)
    {
        $this->histUrl = $histUrl;

        return $this;
    }

    /**
     * Get histUrl
     *
     * @return string 
     */
    public function getHistUrl()
    {
        return $this->histUrl;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return UserBrowsingHistory
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
     * @return UserBrowsingHistory
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
     * @return UserBrowsingHistory
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
     * @return UserBrowsingHistory
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
     * @var \ESERV\MAIN\SecurityBundle\Entity\ESERVUser
     */
    private $fosUser;


    /**
     * Set fosUser
     *
     * @param \ESERV\MAIN\SecurityBundle\Entity\ESERVUser $fosUser
     * @return UserBrowsingHistory
     */
    public function setFosUser(\ESERV\MAIN\SecurityBundle\Entity\ESERVUser $fosUser = null)
    {
        $this->fosUser = $fosUser;

        return $this;
    }

    /**
     * Get fosUser
     *
     * @return \ESERV\MAIN\HistoryBundle\Entity\ESERVUser 
     */
    public function getFosUser()
    {
        return $this->fosUser;
    }
}
