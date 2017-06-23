<?php

namespace ESERV\MAIN\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactRole
 */
class ContactRole
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $contact_id;

    /**
     * @var integer
     */
    private $contact_role_type_id;

    /**
     * @var string
     */
    private $unique_type_ref_no;

    /**
     * @var \DateTime
     */
    private $start_date;

    /**
     * @var \DateTime
     */
    private $end_date;

    /**
     * @var integer
     */
    private $contact_role_status_id;

    /**
     * @var \DateTime
     */
    private $status_date;

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
    private $contact_role_custom;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $contact_role_language;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $contact_role_logo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $mm_user_settings;

    /**
     * @var \ESERV\MAIN\ContactBundle\Entity\Contact
     */
    private $contact;

    /**
     * @var \ESERV\MAIN\ContactBundle\Entity\ContactRoleType
     */
    private $contact_role_type;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contact_role_custom = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contact_role_language = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contact_role_logo = new \Doctrine\Common\Collections\ArrayCollection();
        $this->mm_user_settings = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set contact_id
     *
     * @param integer $contactId
     * @return ContactRole
     */
    public function setContactId($contactId)
    {
        $this->contact_id = $contactId;

        return $this;
    }

    /**
     * Get contact_id
     *
     * @return integer 
     */
    public function getContactId()
    {
        return $this->contact_id;
    }

    /**
     * Set contact_role_type_id
     *
     * @param integer $contactRoleTypeId
     * @return ContactRole
     */
    public function setContactRoleTypeId($contactRoleTypeId)
    {
        $this->contact_role_type_id = $contactRoleTypeId;

        return $this;
    }

    /**
     * Get contact_role_type_id
     *
     * @return integer 
     */
    public function getContactRoleTypeId()
    {
        return $this->contact_role_type_id;
    }

    /**
     * Set unique_type_ref_no
     *
     * @param string $uniqueTypeRefNo
     * @return ContactRole
     */
    public function setUniqueTypeRefNo($uniqueTypeRefNo)
    {
        $this->unique_type_ref_no = $uniqueTypeRefNo;

        return $this;
    }

    /**
     * Get unique_type_ref_no
     *
     * @return string 
     */
    public function getUniqueTypeRefNo()
    {
        return $this->unique_type_ref_no;
    }

    /**
     * Set start_date
     *
     * @param \DateTime $startDate
     * @return ContactRole
     */
    public function setStartDate($startDate)
    {
        $this->start_date = $startDate;

        return $this;
    }

    /**
     * Get start_date
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Set end_date
     *
     * @param \DateTime $endDate
     * @return ContactRole
     */
    public function setEndDate($endDate)
    {
        $this->end_date = $endDate;

        return $this;
    }

    /**
     * Get end_date
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * Set contact_role_status_id
     *
     * @param integer $contactRoleStatusId
     * @return ContactRole
     */
    public function setContactRoleStatusId($contactRoleStatusId)
    {
        $this->contact_role_status_id = $contactRoleStatusId;

        return $this;
    }

    /**
     * Get contact_role_status_id
     *
     * @return integer 
     */
    public function getContactRoleStatusId()
    {
        return $this->contact_role_status_id;
    }

    /**
     * Set status_date
     *
     * @param \DateTime $statusDate
     * @return ContactRole
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
     * Set external_id
     *
     * @param string $externalId
     * @return ContactRole
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
     * @return ContactRole
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
     * @return ContactRole
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
     * @return ContactRole
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
     * @return ContactRole
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
     * Add contact_role_custom
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactRoleCustom $contactRoleCustom
     * @return ContactRole
     */
    public function addContactRoleCustom(\ESERV\MAIN\ContactBundle\Entity\ContactRoleCustom $contactRoleCustom)
    {
        $this->contact_role_custom[] = $contactRoleCustom;

        return $this;
    }

    /**
     * Remove contact_role_custom
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactRoleCustom $contactRoleCustom
     */
    public function removeContactRoleCustom(\ESERV\MAIN\ContactBundle\Entity\ContactRoleCustom $contactRoleCustom)
    {
        $this->contact_role_custom->removeElement($contactRoleCustom);
    }

    /**
     * Get contact_role_custom
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContactRoleCustom()
    {
        return $this->contact_role_custom;
    }

    /**
     * Add contact_role_language
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactRoleLanguage $contactRoleLanguage
     * @return ContactRole
     */
    public function addContactRoleLanguage(\ESERV\MAIN\ContactBundle\Entity\ContactRoleLanguage $contactRoleLanguage)
    {
        $this->contact_role_language[] = $contactRoleLanguage;

        return $this;
    }

    /**
     * Remove contact_role_language
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactRoleLanguage $contactRoleLanguage
     */
    public function removeContactRoleLanguage(\ESERV\MAIN\ContactBundle\Entity\ContactRoleLanguage $contactRoleLanguage)
    {
        $this->contact_role_language->removeElement($contactRoleLanguage);
    }

    /**
     * Get contact_role_language
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContactRoleLanguage()
    {
        return $this->contact_role_language;
    }

    /**
     * Add contact_role_logo
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactRoleLogo $contactRoleLogo
     * @return ContactRole
     */
    public function addContactRoleLogo(\ESERV\MAIN\ContactBundle\Entity\ContactRoleLogo $contactRoleLogo)
    {
        $this->contact_role_logo[] = $contactRoleLogo;

        return $this;
    }

    /**
     * Remove contact_role_logo
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactRoleLogo $contactRoleLogo
     */
    public function removeContactRoleLogo(\ESERV\MAIN\ContactBundle\Entity\ContactRoleLogo $contactRoleLogo)
    {
        $this->contact_role_logo->removeElement($contactRoleLogo);
    }

    /**
     * Get contact_role_logo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContactRoleLogo()
    {
        return $this->contact_role_logo;
    }

    /**
     * Add mm_user_settings
     *
     * @param \ESERV\MAIN\ProfileBundle\Entity\MmUserSettings $mmUserSettings
     * @return ContactRole
     */
    public function addMmUserSetting(\ESERV\MAIN\ProfileBundle\Entity\MmUserSettings $mmUserSettings)
    {
        $this->mm_user_settings[] = $mmUserSettings;

        return $this;
    }

    /**
     * Remove mm_user_settings
     *
     * @param \ESERV\MAIN\ProfileBundle\Entity\MmUserSettings $mmUserSettings
     */
    public function removeMmUserSetting(\ESERV\MAIN\ProfileBundle\Entity\MmUserSettings $mmUserSettings)
    {
        $this->mm_user_settings->removeElement($mmUserSettings);
    }

    /**
     * Get mm_user_settings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMmUserSettings()
    {
        return $this->mm_user_settings;
    }

    /**
     * Set contact
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\Contact $contact
     * @return ContactRole
     */
    public function setContact(\ESERV\MAIN\ContactBundle\Entity\Contact $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\Contact 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set contact_role_type
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactRoleType $contactRoleType
     * @return ContactRole
     */
    public function setContactRoleType(\ESERV\MAIN\ContactBundle\Entity\ContactRoleType $contactRoleType = null)
    {
        $this->contact_role_type = $contactRoleType;

        return $this;
    }

    /**
     * Get contact_role_type
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\ContactRoleType 
     */
    public function getContactRoleType()
    {
        return $this->contact_role_type;
    }
}
