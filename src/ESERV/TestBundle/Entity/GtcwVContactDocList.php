<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ESERV\TestBundle\Entity;

/**
 * Description of GtcwVContactDocList
 *
 * @author rtripathi
 */
class GtcwVContactDocList {
    
    /**
     * @var integer
     */
    private $dtindex;

    /**
     * @var integer
     */
    private $contactId;

    /**
     * @var integer
     */
    private $contactDocId;

    /**
     * @var string
     */
    private $documentCode;

    /**
     * @var string
     */
    private $documentName;

    /**
     * @var string
     */
    private $documentTypeCode;

    /**
     * @var string
     */
    private $documentTypeName;

    /**
     * @var string
     */
    private $versionNo;

    /**
     * @var \DateTime
     */
    private $createdDate;

    /**
     * @var integer
     */
    private $orderBy;


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
     * Set contactId
     *
     * @param integer $contactId
     * @return GtcwVContactDocList
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
     * Set contactDocId
     *
     * @param integer $contactDocId
     * @return GtcwVContactDocList
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
     * Set documentCode
     *
     * @param string $documentCode
     * @return GtcwVContactDocList
     */
    public function setDocumentCode($documentCode)
    {
        $this->documentCode = $documentCode;

        return $this;
    }

    /**
     * Get documentCode
     *
     * @return string 
     */
    public function getDocumentCode()
    {
        return $this->documentCode;
    }

    /**
     * Set documentName
     *
     * @param string $documentName
     * @return GtcwVContactDocList
     */
    public function setDocumentName($documentName)
    {
        $this->documentName = $documentName;

        return $this;
    }

    /**
     * Get documentName
     *
     * @return string 
     */
    public function getDocumentName()
    {
        return $this->documentName;
    }

    /**
     * Set documentTypeCode
     *
     * @param string $documentTypeCode
     * @return GtcwVContactDocList
     */
    public function setDocumentTypeCode($documentTypeCode)
    {
        $this->documentTypeCode = $documentTypeCode;

        return $this;
    }

    /**
     * Get documentTypeCode
     *
     * @return string 
     */
    public function getDocumentTypeCode()
    {
        return $this->documentTypeCode;
    }

    /**
     * Set documentTypeName
     *
     * @param string $documentTypeName
     * @return GtcwVContactDocList
     */
    public function setDocumentTypeName($documentTypeName)
    {
        $this->documentTypeName = $documentTypeName;

        return $this;
    }

    /**
     * Get documentTypeName
     *
     * @return string 
     */
    public function getDocumentTypeName()
    {
        return $this->documentTypeName;
    }

    /**
     * Set versionNo
     *
     * @param string $versionNo
     * @return GtcwVContactDocList
     */
    public function setVersionNo($versionNo)
    {
        $this->versionNo = $versionNo;

        return $this;
    }

    /**
     * Get versionNo
     *
     * @return string 
     */
    public function getVersionNo()
    {
        return $this->versionNo;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     * @return GtcwVContactDocList
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime 
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set orderBy
     *
     * @param integer $orderBy
     * @return GtcwVContactDocList
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
}
