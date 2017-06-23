<?php

namespace Security\UserBundle\Entity;

/**
 * MmUserSetting
 */
class MmUserSetting
{
    
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $autoSave;

    /**
     * @var string
     */
    private $language;

    /**
     * @var \DateTime
     */
    private $lastViewedNews;

    /**
     * @var string
     */
    private $layoutState;

    /**
     * @var string
     */
    private $menuState;

    /**
     * @var \DateTime
     */
    private $statusDate;

    /**
     * @var string
     */
    private $theme;

    /**
     * @var float
     */
    private $themeFontSize;

    /**
     * @var string
     */
    private $themeWidth;

    /**
     * @var string
     */
    private $personId;

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
     * @var \Security\UserBundle\Entity\MmUserProfile
     */
    private $mmUserProfile;

    /**
     * @var \Security\UserBundle\Entity\User
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
     * Set autoSave
     *
     * @param string $autoSave
     * @return MmUserSetting
     */
    public function setAutoSave($autoSave)
    {
        $this->autoSave = $autoSave;

        return $this;
    }

    /**
     * Get autoSave
     *
     * @return string 
     */
    public function getAutoSave()
    {
        return $this->autoSave;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return MmUserSetting
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set lastViewedNews
     *
     * @param \DateTime $lastViewedNews
     * @return MmUserSetting
     */
    public function setLastViewedNews($lastViewedNews)
    {
        $this->lastViewedNews = $lastViewedNews;

        return $this;
    }

    /**
     * Get lastViewedNews
     *
     * @return \DateTime 
     */
    public function getLastViewedNews()
    {
        return $this->lastViewedNews;
    }

    /**
     * Set layoutState
     *
     * @param string $layoutState
     * @return MmUserSetting
     */
    public function setLayoutState($layoutState)
    {
        $this->layoutState = $layoutState;

        return $this;
    }

    /**
     * Get layoutState
     *
     * @return string 
     */
    public function getLayoutState()
    {
        return $this->layoutState;
    }

    /**
     * Set menuState
     *
     * @param string $menuState
     * @return MmUserSetting
     */
    public function setMenuState($menuState)
    {
        $this->menuState = $menuState;

        return $this;
    }

    /**
     * Get menuState
     *
     * @return string 
     */
    public function getMenuState()
    {
        return $this->menuState;
    }

    /**
     * Set statusDate
     *
     * @param \DateTime $statusDate
     * @return MmUserSetting
     */
    public function setStatusDate($statusDate)
    {
        $this->statusDate = $statusDate;

        return $this;
    }

    /**
     * Get statusDate
     *
     * @return \DateTime 
     */
    public function getStatusDate()
    {
        return $this->statusDate;
    }

    /**
     * Set theme
     *
     * @param string $theme
     * @return MmUserSetting
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return string 
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set themeFontSize
     *
     * @param float $themeFontSize
     * @return MmUserSetting
     */
    public function setThemeFontSize($themeFontSize)
    {
        $this->themeFontSize = $themeFontSize;

        return $this;
    }

    /**
     * Get themeFontSize
     *
     * @return float 
     */
    public function getThemeFontSize()
    {
        return $this->themeFontSize;
    }

    /**
     * Set themeWidth
     *
     * @param string $themeWidth
     * @return MmUserSetting
     */
    public function setThemeWidth($themeWidth)
    {
        $this->themeWidth = $themeWidth;

        return $this;
    }

    /**
     * Get themeWidth
     *
     * @return string 
     */
    public function getThemeWidth()
    {
        return $this->themeWidth;
    }

    /**
     * Set personId
     *
     * @param string $personId
     * @return MmUserSetting
     */
    public function setPersonId($personId)
    {
        $this->personId = $personId;

        return $this;
    }

    /**
     * Get personId
     *
     * @return string 
     */
    public function getPersonId()
    {
        return $this->personId;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return MmUserSetting
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
     * @return MmUserSetting
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
     * @return MmUserSetting
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
     * @return MmUserSetting
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
     * Set mmUserProfile
     *
     * @param \Security\UserBundle\Entity\MmUserProfile $mmUserProfile
     * @return MmUserSetting
     */
    public function setMmUserProfile(\Security\UserBundle\Entity\MmUserProfile $mmUserProfile = null)
    {
        $this->mmUserProfile = $mmUserProfile;

        return $this;
    }

    /**
     * Get mmUserProfile
     *
     * @return \Security\UserBundle\Entity\MmUserProfile 
     */
    public function getMmUserProfile()
    {
        return $this->mmUserProfile;
    }

    /**
     * Set fosUser
     *
     * @param \Security\UserBundle\Entity\User $fosUser
     * @return MmUserSetting
     */
    public function setFosUser(\Security\UserBundle\Entity\User $fosUser = null)
    {
        $this->fosUser = $fosUser;

        return $this;
    }

    /**
     * Get fosUser
     *
     * @return \Security\UserBundle\Entity\User 
     */
    public function getFosUser()
    {
        return $this->fosUser;
    }
}
