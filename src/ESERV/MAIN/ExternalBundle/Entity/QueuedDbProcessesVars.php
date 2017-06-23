<?php

namespace ESERV\MAIN\ExternalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QueuedDbProcessesVars
 */
class QueuedDbProcessesVars
{
    /**
     * @var integer
     */
    private $queued_db_processes_id;

    /**
     * @var string
     */
    private $field_name;

    /**
     * @var string
     */
    private $field_value;

    /**
     * @var string
     */
    private $field_param_ext;

    /**
     * @var string
     */
    private $field_param_type;

    /**
     * @var string
     */
    private $field_param_size;

    /**
     * @var integer
     */
    private $order_col;


    /**
     * Get queued_db_processes_id
     *
     * @return integer 
     */
    public function getQueuedDbProcessesId()
    {
        return $this->queued_db_processes_id;
    }

    /**
     * Set field_name
     *
     * @param string $fieldName
     * @return QueuedDbProcessesVars
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
     * Set field_value
     *
     * @param string $fieldValue
     * @return QueuedDbProcessesVars
     */
    public function setFieldValue($fieldValue)
    {
        $this->field_value = $fieldValue;

        return $this;
    }

    /**
     * Get field_value
     *
     * @return string 
     */
    public function getFieldValue()
    {
        return $this->field_value;
    }

    /**
     * Set field_param_ext
     *
     * @param string $fieldParamExt
     * @return QueuedDbProcessesVars
     */
    public function setFieldParamExt($fieldParamExt)
    {
        $this->field_param_ext = $fieldParamExt;

        return $this;
    }

    /**
     * Get field_param_ext
     *
     * @return string 
     */
    public function getFieldParamExt()
    {
        return $this->field_param_ext;
    }

    /**
     * Set field_param_type
     *
     * @param string $fieldParamType
     * @return QueuedDbProcessesVars
     */
    public function setFieldParamType($fieldParamType)
    {
        $this->field_param_type = $fieldParamType;

        return $this;
    }

    /**
     * Get field_param_type
     *
     * @return string 
     */
    public function getFieldParamType()
    {
        return $this->field_param_type;
    }

    /**
     * Set field_param_size
     *
     * @param string $fieldParamSize
     * @return QueuedDbProcessesVars
     */
    public function setFieldParamSize($fieldParamSize)
    {
        $this->field_param_size = $fieldParamSize;

        return $this;
    }

    /**
     * Get field_param_size
     *
     * @return string 
     */
    public function getFieldParamSize()
    {
        return $this->field_param_size;
    }

    /**
     * Set order_col
     *
     * @param integer $orderCol
     * @return QueuedDbProcessesVars
     */
    public function setOrderCol($orderCol)
    {
        $this->order_col = $orderCol;

        return $this;
    }

    /**
     * Get order_col
     *
     * @return integer 
     */
    public function getOrderCol()
    {
        return $this->order_col;
    }
}
