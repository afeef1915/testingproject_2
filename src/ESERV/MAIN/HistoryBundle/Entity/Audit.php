<?php

namespace ESERV\MAIN\HistoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Audit
 */
class Audit
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
    private $entity_name;

    /**
     * @var string
     */
    private $entity_id;

    /**
     * @var string
     */
    private $field_name;

    /**
     * @var string
     */
    private $field_type;

    /**
     * @var string
     */
    private $old_value;

    /**
     * @var string
     */
    private $new_value;

    /**
     * @var \DateTime
     */
    private $update_date;

    /**
     * @var string
     */
    private $db_user_name;

    /**
     * @var string
     */
    private $application_user_name;

    /**
     * @var string
     */
    private $synchronise_flag;

    /**
     * @var string
     */
    private $synchronise_job_id;


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
     * @return Audit
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
     * Set entity_name
     *
     * @param string $entityName
     * @return Audit
     */
    public function setEntityName($entityName)
    {
        $this->entity_name = $entityName;

        return $this;
    }

    /**
     * Get entity_name
     *
     * @return string 
     */
    public function getEntityName()
    {
        return $this->entity_name;
    }

    /**
     * Set entity_id
     *
     * @param string $entityId
     * @return Audit
     */
    public function setEntityId($entityId)
    {
        $this->entity_id = $entityId;

        return $this;
    }

    /**
     * Get entity_id
     *
     * @return string 
     */
    public function getEntityId()
    {
        return $this->entity_id;
    }

    /**
     * Set field_name
     *
     * @param string $fieldName
     * @return Audit
     */
    public function setFieldName($fieldName)
    {
        $this->field_name = $fieldName;

        return $this;
    }

    /**
     * Get field_name
     *
     * @return string 
     */
    public function getFieldName()
    {
        return $this->field_name;
    }

    /**
     * Set field_type
     *
     * @param string $fieldType
     * @return Audit
     */
    public function setFieldType($fieldType)
    {
        $this->field_type = $fieldType;

        return $this;
    }

    /**
     * Get field_type
     *
     * @return string 
     */
    public function getFieldType()
    {
        return $this->field_type;
    }

    /**
     * Set old_value
     *
     * @param string $oldValue
     * @return Audit
     */
    public function setOldValue($oldValue)
    {
        $this->old_value = $oldValue;

        return $this;
    }

    /**
     * Get old_value
     *
     * @return string 
     */
    public function getOldValue()
    {
        return $this->old_value;
    }

    /**
     * Set new_value
     *
     * @param string $newValue
     * @return Audit
     */
    public function setNewValue($newValue)
    {
        $this->new_value = $newValue;

        return $this;
    }

    /**
     * Get new_value
     *
     * @return string 
     */
    public function getNewValue()
    {
        return $this->new_value;
    }

    /**
     * Set update_date
     *
     * @param \DateTime $updateDate
     * @return Audit
     */
    public function setUpdateDate($updateDate)
    {
        $this->update_date = $updateDate;

        return $this;
    }

    /**
     * Get update_date
     *
     * @return \DateTime 
     */
    public function getUpdateDate()
    {
        return $this->update_date;
    }

    /**
     * Set db_user_name
     *
     * @param string $dbUserName
     * @return Audit
     */
    public function setDbUserName($dbUserName)
    {
        $this->db_user_name = $dbUserName;

        return $this;
    }

    /**
     * Get db_user_name
     *
     * @return string 
     */
    public function getDbUserName()
    {
        return $this->db_user_name;
    }

    /**
     * Set application_user_name
     *
     * @param string $applicationUserName
     * @return Audit
     */
    public function setApplicationUserName($applicationUserName)
    {
        $this->application_user_name = $applicationUserName;

        return $this;
    }

    /**
     * Get application_user_name
     *
     * @return string 
     */
    public function getApplicationUserName()
    {
        return $this->application_user_name;
    }

    /**
     * Set synchronise_flag
     *
     * @param string $synchroniseFlag
     * @return Audit
     */
    public function setSynchroniseFlag($synchroniseFlag)
    {
        $this->synchronise_flag = $synchroniseFlag;

        return $this;
    }

    /**
     * Get synchronise_flag
     *
     * @return string 
     */
    public function getSynchroniseFlag()
    {
        return $this->synchronise_flag;
    }

    /**
     * Set synchronise_job_id
     *
     * @param string $synchroniseJobId
     * @return Audit
     */
    public function setSynchroniseJobId($synchroniseJobId)
    {
        $this->synchronise_job_id = $synchroniseJobId;

        return $this;
    }

    /**
     * Get synchronise_job_id
     *
     * @return string 
     */
    public function getSynchroniseJobId()
    {
        return $this->synchronise_job_id;
    }
}
