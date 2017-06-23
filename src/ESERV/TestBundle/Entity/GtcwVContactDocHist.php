<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ESERV\TestBundle\Entity;

/**
 * Description of GtcwVContactDocHist
 *
 * @author rtripathi
 */
class GtcwVContactDocHist {
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $contactDocId;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $version;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $createdBy;

    /**
     * @var integer
     */
    private $orderBy;


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
     * Set contactDocId
     *
     * @param integer $contactDocId
     * @return GtcwVContactDocHist
     */
    public function setContactDocId($contactDocId)
    {
        $this->contactDocId = $contactDocId;

        return $this;
    }

    /**
     * Get contactDocId
     *
     * @return integer 
     */
    public function getContactDocId()
    {
        return $this->contactDocId;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return GtcwVContactDocHist
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
     * Set name
     *
     * @param string $name
     * @return GtcwVContactDocHist
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set version
     *
     * @param integer $version
     * @return GtcwVContactDocHist
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return GtcwVContactDocHist
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
     * @return GtcwVContactDocHist
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
     * Set orderBy
     *
     * @param integer $orderBy
     * @return GtcwVContactDocHist
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;

        return $this;
    }

    /**
     * Get orderBy
     *
     * @return integer 
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }
    /**
     * @var string
     */
    private $createdByUser;


    /**
     * Set createdByUser
     *
     * @param string $createdByUser
     * @return GtcwVContactDocHist
     */
    public function setCreatedByUser($createdByUser)
    {
        $this->createdByUser = $createdByUser;

        return $this;
    }

    /**
     * Get createdByUser
     *
     * @return string 
     */
    public function getCreatedByUser()
    {
        return $this->createdByUser;
    }
    /**
     * @var integer
     */
    private $contactId;

    /**
     * @var string
     */
    private $contactFullName;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $updatedBy;

    /**
     * @var string
     */
    private $updatedByUser;


    /**
     * Set contactId
     *
     * @param integer $contactId
     * @return GtcwVContactDocHist
     */
    public function setContactId($contactId)
    {
        $this->contactId = $contactId;

        return $this;
    }

    /**
     * Get contactId
     *
     * @return integer 
     */
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * Set contactFullName
     *
     * @param string $contactFullName
     * @return GtcwVContactDocHist
     */
    public function setContactFullName($contactFullName)
    {
        $this->contactFullName = $contactFullName;

        return $this;
    }

    /**
     * Get contactFullName
     *
     * @return string 
     */
    public function getContactFullName()
    {
        return $this->contactFullName;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return GtcwEVIndProDocHist
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
     * @return GtcwEVIndProDocHist
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
     * Set updatedByUser
     *
     * @param string $updatedByUser
     * @return GtcwEVIndProDocHist
     */
    public function setUpdatedByUser($updatedByUser)
    {
        $this->updatedByUser = $updatedByUser;

        return $this;
    }

    /**
     * Get updatedByUser
     *
     * @return string 
     */
    public function getUpdatedByUser()
    {
        return $this->updatedByUser;
    }
}
