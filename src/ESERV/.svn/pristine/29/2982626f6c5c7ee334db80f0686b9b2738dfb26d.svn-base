<?php

namespace ESERV\MAIN\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MmUserSettings
 */
class MmUserSettings
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $auto_save;

    /**
     * @var string
     */
    private $language;

    /**
     * @var \DateTime
     */
    private $last_viewed_news;

    /**
     * @var string
     */
    private $layout_state;

    /**
     * @var string
     */
    private $menu_state;

    /**
     * @var integer
     */
    private $mm_user_profile_id;

    /**
     * @var integer
     */
    private $sf_guard_user_id;

    /**
     * @var integer
     */
    private $fos_user_id;

    /**
     * @var integer
     */
    private $contact_role_id;

    /**
     * @var integer
     */
    private $relationship_id;

    /**
     * @var \DateTime
     */
    private $status_date;

    /**
     * @var string
     */
    private $theme;

    /**
     * @var float
     */
    private $theme_font_size;

    /**
     * @var string
     */
    private $theme_width;

    /**
     * @var string
     */
    private $external_id;

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
    private $fos_user;

    /**
     * @var \ESERV\MAIN\ProfileBundle\Entity\MmUserProfile
     */
    private $mm_user_profile;

    /**
     * @var \ESERV\MAIN\ContactBundle\Entity\ContactRole
     */
    private $contact_role;

    /**
     * @var \ESERV\MAIN\ContactBundle\Entity\Relationship
     */
    private $relationship;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fos_user = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set auto_save
     *
     * @param string $autoSave
     * @return MmUserSettings
     */
    public function setAutoSave($autoSave)
    {
        $this->auto_save = $autoSave;

        return $this;
    }

    /**
     * Get auto_save
     *
     * @return string 
     */
    public function getAutoSave()
    {
        return $this->auto_save;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return MmUserSettings
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
     * Set last_viewed_news
     *
     * @param \DateTime $lastViewedNews
     * @return MmUserSettings
     */
    public function setLastViewedNews($lastViewedNews)
    {
        $this->last_viewed_news = $lastViewedNews;

        return $this;
    }

    /**
     * Get last_viewed_news
     *
     * @return \DateTime 
     */
    public function getLastViewedNews()
    {
        return $this->last_viewed_news;
    }

    /**
     * Set layout_state
     *
     * @param string $layoutState
     * @return MmUserSettings
     */
    public function setLayoutState($layoutState)
    {
        $this->layout_state = $layoutState;

        return $this;
    }

    /**
     * Get layout_state
     *
     * @return string 
     */
    public function getLayoutState()
    {
        return $this->layout_state;
    }

    /**
     * Set menu_state
     *
     * @param string $menuState
     * @return MmUserSettings
     */
    public function setMenuState($menuState)
    {
        $this->menu_state = $menuState;

        return $this;
    }

    /**
     * Get menu_state
     *
     * @return string 
     */
    public function getMenuState()
    {
        return $this->menu_state;
    }

    /**
     * Set mm_user_profile_id
     *
     * @param integer $mmUserProfileId
     * @return MmUserSettings
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
     * Set sf_guard_user_id
     *
     * @param integer $sfGuardUserId
     * @return MmUserSettings
     */
    public function setSfGuardUserId($sfGuardUserId)
    {
        $this->sf_guard_user_id = $sfGuardUserId;

        return $this;
    }

    /**
     * Get sf_guard_user_id
     *
     * @return integer 
     */
    public function getSfGuardUserId()
    {
        return $this->sf_guard_user_id;
    }

    /**
     * Set fos_user_id
     *
     * @param integer $fosUserId
     * @return MmUserSettings
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
     * Set contact_role_id
     *
     * @param integer $contactRoleId
     * @return MmUserSettings
     */
    public function setContactRoleId($contactRoleId)
    {
        $this->contact_role_id = $contactRoleId;

        return $this;
    }

    /**
     * Get contact_role_id
     *
     * @return integer 
     */
    public function getContactRoleId()
    {
        return $this->contact_role_id;
    }

    /**
     * Set relationship_id
     *
     * @param integer $relationshipId
     * @return MmUserSettings
     */
    public function setRelationshipId($relationshipId)
    {
        $this->relationship_id = $relationshipId;

        return $this;
    }

    /**
     * Get relationship_id
     *
     * @return integer 
     */
    public function getRelationshipId()
    {
        return $this->relationship_id;
    }

    /**
     * Set status_date
     *
     * @param \DateTime $statusDate
     * @return MmUserSettings
     */
    public function setStatusDate($statusDate)
    {
        $this->status_date = $statusDate;

        return $this;
    }

    /**
     * Get status_date
     *
     * @return \DateTime 
     */
    public function getStatusDate()
    {
        return $this->status_date;
    }

    /**
     * Set theme
     *
     * @param string $theme
     * @return MmUserSettings
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
     * Set theme_font_size
     *
     * @param float $themeFontSize
     * @return MmUserSettings
     */
    public function setThemeFontSize($themeFontSize)
    {
        $this->theme_font_size = $themeFontSize;

        return $this;
    }

    /**
     * Get theme_font_size
     *
     * @return float 
     */
    public function getThemeFontSize()
    {
        return $this->theme_font_size;
    }

    /**
     * Set theme_width
     *
     * @param string $themeWidth
     * @return MmUserSettings
     */
    public function setThemeWidth($themeWidth)
    {
        $this->theme_width = $themeWidth;

        return $this;
    }

    /**
     * Get theme_width
     *
     * @return string 
     */
    public function getThemeWidth()
    {
        return $this->theme_width;
    }

    /**
     * Set external_id
     *
     * @param string $externalId
     * @return MmUserSettings
     */
    public function setExternalId($externalId)
    {
        $this->external_id = $externalId;

        return $this;
    }

    /**
     * Get external_id
     *
     * @return string 
     */
    public function getExternalId()
    {
        return $this->external_id;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return MmUserSettings
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
     * @return MmUserSettings
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
     * @return MmUserSettings
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
     * @return MmUserSettings
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
     * Add fos_user
     *
     * @param \FOS\UserBundle\Model\User $fosUser
     * @return MmUserSettings
     */
    public function addFosUser(\FOS\UserBundle\Model\User $fosUser)
    {
        $this->fos_user[] = $fosUser;

        return $this;
    }

    /**
     * Remove fos_user
     *
     * @param \FOS\UserBundle\Model\User $fosUser
     */
    public function removeFosUser(\FOS\UserBundle\Model\User $fosUser)
    {
        $this->fos_user->removeElement($fosUser);
    }

    /**
     * Get fos_user
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFosUser()
    {
        return $this->fos_user;
    }

    /**
     * Set mm_user_profile
     *
     * @param \ESERV\MAIN\ProfileBundle\Entity\MmUserProfile $mmUserProfile
     * @return MmUserSettings
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
     * Set contact_role
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactRole $contactRole
     * @return MmUserSettings
     */
    public function setContactRole(\ESERV\MAIN\ContactBundle\Entity\ContactRole $contactRole = null)
    {
        $this->contact_role = $contactRole;

        return $this;
    }

    /**
     * Get contact_role
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\ContactRole 
     */
    public function getContactRole()
    {
        return $this->contact_role;
    }

    /**
     * Set relationship
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\Relationship $relationship
     * @return MmUserSettings
     */
    public function setRelationship(\ESERV\MAIN\ContactBundle\Entity\Relationship $relationship = null)
    {
        $this->relationship = $relationship;

        return $this;
    }

    /**
     * Get relationship
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\Relationship 
     */
    public function getRelationship()
    {
        return $this->relationship;
    }
}
