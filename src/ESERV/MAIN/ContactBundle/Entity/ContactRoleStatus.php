<?php

namespace ESERV\MAIN\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactRoleStatus
 */
class ContactRoleStatus
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $contact_role_type_id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $date_opened;

    /**
     * @var \DateTime
     */
    private $date_closed;

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
     * @var \ESERV\MAIN\ContactBundle\Entity\ContactRoleType
     */
    private $contact_role_type;


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
     * Set contact_role_type_id
     *
     * @param integer $contactRoleTypeId
     * @return ContactRoleStatus
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
     * Set code
     *
     * @param string $code
     * @return ContactRoleStatus
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
     * @return ContactRoleStatus
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
     * Set date_opened
     *
     * @param \DateTime $dateOpened
     * @return ContactRoleStatus
     */
    public function setDateOpened($dateOpened)
    {
        $this->date_opened = $dateOpened;

        return $this;
    }

    /**
     * Get date_opened
     *
     * @return \DateTime 
     */
    public function getDateOpened()
    {
        return $this->date_opened;
    }

    /**
     * Set date_closed
     *
     * @param \DateTime $dateClosed
     * @return ContactRoleStatus
     */
    public function setDateClosed($dateClosed)
    {
        $this->date_closed = $dateClosed;

        return $this;
    }

    /**
     * Get date_closed
     *
     * @return \DateTime 
     */
    public function getDateClosed()
    {
        return $this->date_closed;
    }

    /**
     * Set external_id
     *
     * @param string $externalId
     * @return ContactRoleStatus
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
     * @return ContactRoleStatus
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
     * @return ContactRoleStatus
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
     * @return ContactRoleStatus
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
     * @return ContactRoleStatus
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
     * Set contact_role_type
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactRoleType $contactRoleType
     * @return ContactRoleStatus
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
