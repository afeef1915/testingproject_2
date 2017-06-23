<?php

namespace WEBLOGS\CORE\MAIN\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MmUserSettingOrg
 */
class MmUserSettingOrg
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $customer_code;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $created_by;

    /**
     * @var integer
     */
    private $updated_by;

    /**
     * @var \WEBLOGS\CORE\MAIN\ProfileBundle\Entity\MmUserSetting
     */
    private $mmUserSettingFos;


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
     * Set customer_code
     *
     * @param string $customerCode
     * @return MmUserSettingOrg
     */
    public function setCustomerCode($customerCode)
    {
        $this->customer_code = $customerCode;

        return $this;
    }

    /**
     * Get customer_code
     *
     * @return string 
     */
    public function getCustomerCode()
    {
        return $this->customer_code;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return MmUserSettingOrg
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return MmUserSettingOrg
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
     * Set created_by
     *
     * @param integer $createdBy
     * @return MmUserSettingOrg
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
     * @return MmUserSettingOrg
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
     * Set mmUserSettingFos
     *
     * @param \WEBLOGS\CORE\MAIN\ProfileBundle\Entity\MmUserSetting $mmUserSettingFos
     * @return MmUserSettingOrg
     */
    public function setMmUserSettingFos(\WEBLOGS\CORE\MAIN\ProfileBundle\Entity\MmUserSetting $mmUserSettingFos = null)
    {
        $this->mmUserSettingFos = $mmUserSettingFos;

        return $this;
    }

    /**
     * Get mmUserSettingFos
     *
     * @return \WEBLOGS\CORE\MAIN\ProfileBundle\Entity\MmUserSetting 
     */
    public function getMmUserSettingFos()
    {
        return $this->mmUserSettingFos;
    }
}
