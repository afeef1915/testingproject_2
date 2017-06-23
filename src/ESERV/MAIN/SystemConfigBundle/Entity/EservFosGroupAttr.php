<?php

namespace ESERV\MAIN\SystemConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EservFosGroupAttr
 */
class EservFosGroupAttr
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $mainUrlSuffix;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $createdBy;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $updatedBy;

    /**
     * @var \ESERV\MAIN\SecurityBundle\Entity\Group
     */
    private $fosGroup;


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
     * Set mainUrlSuffix
     *
     * @param string $mainUrlSuffix
     * @return EservFosGroupAttr
     */
    public function setMainUrlSuffix($mainUrlSuffix)
    {
        $this->mainUrlSuffix = $mainUrlSuffix;

        return $this;
    }

    /**
     * Get mainUrlSuffix
     *
     * @return string 
     */
    public function getMainUrlSuffix()
    {
        return $this->mainUrlSuffix;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return EservFosGroupAttr
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
     * Set createdBy
     *
     * @param integer $createdBy
     * @return EservFosGroupAttr
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return EservFosGroupAttr
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
     * Set updatedBy
     *
     * @param integer $updatedBy
     * @return EservFosGroupAttr
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
     * Set fosGroup
     *
     * @param \ESERV\MAIN\SecurityBundle\Entity\Group $fosGroup
     * @return EservFosGroupAttr
     */
    public function setFosGroup(\ESERV\MAIN\SecurityBundle\Entity\Group $fosGroup = null)
    {
        $this->fosGroup = $fosGroup;

        return $this;
    }

    /**
     * Get fosGroup
     *
     * @return \ESERV\MAIN\SecurityBundle\Entity\Group 
     */
    public function getFosGroup()
    {
        return $this->fosGroup;
    }
    /**
     * @var string
     */
    private $fosGroupRole;


    /**
     * Set fosGroupRole
     *
     * @param string $fosGroupRole
     * @return EservFosGroupAttr
     */
    public function setFosGroupRole($fosGroupRole)
    {
        $this->fosGroupRole = $fosGroupRole;

        return $this;
    }

    /**
     * Get fosGroupRole
     *
     * @return string 
     */
    public function getFosGroupRole()
    {
        return $this->fosGroupRole;
    }
}
