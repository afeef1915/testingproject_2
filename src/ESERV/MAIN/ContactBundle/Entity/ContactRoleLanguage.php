<?php

namespace ESERV\MAIN\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactRoleLanguage
 */
class ContactRoleLanguage
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $contact_role_id;

    /**
     * @var integer
     */
    private $language_id;

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
     * @var \ESERV\MAIN\ContactBundle\Entity\ContactRole
     */
    private $contact_role;


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
     * Set contact_role_id
     *
     * @param integer $contactRoleId
     * @return ContactRoleLanguage
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
     * Set language_id
     *
     * @param integer $languageId
     * @return ContactRoleLanguage
     */
    public function setLanguageId($languageId)
    {
        $this->language_id = $languageId;

        return $this;
    }

    /**
     * Get language_id
     *
     * @return integer 
     */
    public function getLanguageId()
    {
        return $this->language_id;
    }

    /**
     * Set external_id
     *
     * @param string $externalId
     * @return ContactRoleLanguage
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
     * @return ContactRoleLanguage
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
     * @return ContactRoleLanguage
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
     * @return ContactRoleLanguage
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
     * @return ContactRoleLanguage
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
     * Set contact_role
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactRole $contactRole
     * @return ContactRoleLanguage
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
}
