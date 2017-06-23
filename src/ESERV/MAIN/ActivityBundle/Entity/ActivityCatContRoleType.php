<?php

namespace ESERV\MAIN\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActivityCatContRoleType
 */
class ActivityCatContRoleType
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $activity_category_id;

    /**
     * @var integer
     */
    private $contact_role_type_id;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set activity_category_id
     *
     * @param integer $activityCategoryId
     * @return ActivityCatContRoleType
     */
    public function setActivityCategoryId($activityCategoryId)
    {
        $this->activity_category_id = $activityCategoryId;

        return $this;
    }

    /**
     * Get activity_category_id
     *
     * @return integer 
     */
    public function getActivityCategoryId()
    {
        return $this->activity_category_id;
    }

    /**
     * Set contact_role_type_id
     *
     * @param integer $contactRoleTypeId
     * @return ActivityCatContRoleType
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
     * Set external_id
     *
     * @param string $externalId
     * @return ActivityCatContRoleType
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
     * @return ActivityCatContRoleType
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
     * @return ActivityCatContRoleType
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
     * @return ActivityCatContRoleType
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
     * @return ActivityCatContRoleType
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
}
