<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ESERV\TestBundle\Entity;

/**
 * Description of GtcwVContactDocAccessList
 *
 * @author rtripathi
 */
class GtcwVContactDocAccessList {
    
    /**
     * @var integer
     */
    private $dtindex;

    /**
     * @var integer
     */
    private $contactDocId;

    /**
     * @var integer
     */
    private $fosGroupId;

    /**
     * @var string
     */
    private $fosGroupName;

    /**
     * @var string
     */
    private $updateAccess;

    /**
     * @var string
     */
    private $viewAccess;

    /**
     * @var string
     */
    private $signOffAccess;

    /**
     * @var string
     */
    private $isSignedOff;

    /**
     * @var \DateTime
     */
    private $signOffDate;


    /**
     * Get dtindex
     *
     * @return integer 
     */
    public function getDtindex()
    {
        return $this->dtindex;
    }

    /**
     * Set contactDocId
     *
     * @param integer $contactDocId
     * @return GtcwVContactDocAccessList
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
     * Set fosGroupId
     *
     * @param integer $fosGroupId
     * @return GtcwVContactDocAccessList
     */
    public function setFosGroupId($fosGroupId)
    {
        $this->fosGroupId = $fosGroupId;

        return $this;
    }

    /**
     * Get fosGroupId
     *
     * @return integer 
     */
    public function getFosGroupId()
    {
        return $this->fosGroupId;
    }

    /**
     * Set fosGroupName
     *
     * @param string $fosGroupName
     * @return GtcwVContactDocAccessList
     */
    public function setFosGroupName($fosGroupName)
    {
        $this->fosGroupName = $fosGroupName;

        return $this;
    }

    /**
     * Get fosGroupName
     *
     * @return string 
     */
    public function getFosGroupName()
    {
        return $this->fosGroupName;
    }

    /**
     * Set updateAccess
     *
     * @param string $updateAccess
     * @return GtcwVContactDocAccessList
     */
    public function setUpdateAccess($updateAccess)
    {
        $this->updateAccess = $updateAccess;

        return $this;
    }

    /**
     * Get updateAccess
     *
     * @return string 
     */
    public function getUpdateAccess()
    {
        return $this->updateAccess;
    }

    /**
     * Set viewAccess
     *
     * @param string $viewAccess
     * @return GtcwVContactDocAccessList
     */
    public function setViewAccess($viewAccess)
    {
        $this->viewAccess = $viewAccess;

        return $this;
    }

    /**
     * Get viewAccess
     *
     * @return string 
     */
    public function getViewAccess()
    {
        return $this->viewAccess;
    }

    /**
     * Set signOffAccess
     *
     * @param string $signOffAccess
     * @return GtcwVContactDocAccessList
     */
    public function setSignOffAccess($signOffAccess)
    {
        $this->signOffAccess = $signOffAccess;

        return $this;
    }

    /**
     * Get signOffAccess
     *
     * @return string 
     */
    public function getSignOffAccess()
    {
        return $this->signOffAccess;
    }

    /**
     * Set isSignedOff
     *
     * @param string $isSignedOff
     * @return GtcwVContactDocAccessList
     */
    public function setIsSignedOff($isSignedOff)
    {
        $this->isSignedOff = $isSignedOff;

        return $this;
    }

    /**
     * Get isSignedOff
     *
     * @return string 
     */
    public function getIsSignedOff()
    {
        return $this->isSignedOff;
    }

    /**
     * Set signOffDate
     *
     * @param \DateTime $signOffDate
     * @return GtcwVContactDocAccessList
     */
    public function setSignOffDate($signOffDate)
    {
        $this->signOffDate = $signOffDate;

        return $this;
    }

    /**
     * Get signOffDate
     *
     * @return \DateTime 
     */
    public function getSignOffDate()
    {
        return $this->signOffDate;
    }
    /**
     * @var integer
     */
    private $contactDocAccessId;


    /**
     * Set contactDocAccessId
     *
     * @param integer $contactDocAccessId
     * @return GtcwVContactDocAccessList
     */
    public function setContactDocAccessId($contactDocAccessId)
    {
        $this->contactDocAccessId = $contactDocAccessId;

        return $this;
    }

    /**
     * Get contactDocAccessId
     *
     * @return integer 
     */
    public function getContactDocAccessId()
    {
        return $this->contactDocAccessId;
    }
}
