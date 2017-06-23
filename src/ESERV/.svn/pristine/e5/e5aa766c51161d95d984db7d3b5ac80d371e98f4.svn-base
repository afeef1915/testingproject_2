<?php

namespace ESERV\MAIN\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactRoleType
 */
class ContactRoleType
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
    private $description;

    /**
     * @var integer
     */
    private $contact_type_id;

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
     * @var \ESERV\MAIN\ContactBundle\Entity\ContactType
     */
    private $contact_type;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $contact_role_status;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $contact_role;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contact_role_status = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contact_role = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set code
     *
     * @param string $code
     * @return ContactRoleType
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
     * Set description
     *
     * @param string $description
     * @return ContactRoleType
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
     * Set contact_type_id
     *
     * @param integer $contactTypeId
     * @return ContactRoleType
     */
    public function setContactTypeId($contactTypeId)
    {
        $this->contact_type_id = $contactTypeId;

        return $this;
    }

    /**
     * Get contact_type_id
     *
     * @return integer 
     */
    public function getContactTypeId()
    {
        return $this->contact_type_id;
    }

    /**
     * Set external_id
     *
     * @param string $externalId
     * @return ContactRoleType
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
     * @return ContactRoleType
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
     * @return ContactRoleType
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
     * @return ContactRoleType
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
     * @return ContactRoleType
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
     * Set contact_type
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactType $contactType
     * @return ContactRoleType
     */
    public function setContactType(\ESERV\MAIN\ContactBundle\Entity\ContactType $contactType = null)
    {
        $this->contact_type = $contactType;

        return $this;
    }

    /**
     * Get contact_type
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\ContactType 
     */
    public function getContactType()
    {
        return $this->contact_type;
    }

    /**
     * Add contact_role_status
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactRoleStatus $contactRoleStatus
     * @return ContactRoleType
     */
    public function addContactRoleStatus(\ESERV\MAIN\ContactBundle\Entity\ContactRoleStatus $contactRoleStatus)
    {
        $this->contact_role_status[] = $contactRoleStatus;

        return $this;
    }

    /**
     * Remove contact_role_status
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactRoleStatus $contactRoleStatus
     */
    public function removeContactRoleStatus(\ESERV\MAIN\ContactBundle\Entity\ContactRoleStatus $contactRoleStatus)
    {
        $this->contact_role_status->removeElement($contactRoleStatus);
    }

    /**
     * Get contact_role_status
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContactRoleStatus()
    {
        return $this->contact_role_status;
    }

    /**
     * Add contact_role
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactRole $contactRole
     * @return ContactRoleType
     */
    public function addContactRole(\ESERV\MAIN\ContactBundle\Entity\ContactRole $contactRole)
    {
        $this->contact_role[] = $contactRole;

        return $this;
    }

    /**
     * Remove contact_role
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactRole $contactRole
     */
    public function removeContactRole(\ESERV\MAIN\ContactBundle\Entity\ContactRole $contactRole)
    {
        $this->contact_role->removeElement($contactRole);
    }

    /**
     * Get contact_role
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContactRole()
    {
        return $this->contact_role;
    }
}
