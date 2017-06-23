<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ESERV\TestBundle\Entity;

/**
 * Description of GtcwVResultFile
 *
 * @author RTripathi
 */
class GtcwVResultFile {
    
    /**
     * @var integer
     */
    private $dtindex;

    /**
     * @var integer
     */
    private $resultFileId;

    /**
     * @var integer
     */
    private $contactId;

    /**
     * @var string
     */
    private $referenceNo;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var \DateTime
     */
    private $dateOfBirth;

    /**
     * @var integer
     */
    private $contactStatusId;

    /**
     * @var string
     */
    private $contactStatusCode;

    /**
     * @var string
     */
    private $contactStatusName;

    /**
     * @var string
     */
    private $comments;

    /**
     * @var \DateTime
     */
    private $dateSubmitted;

    /**
     * @var integer
     */
    private $employerId;

    /**
     * @var string
     */
    private $employerCode;

    /**
     * @var string
     */
    private $employerName;

    /**
     * @var string
     */
    private $employerNameWelsh;

    /**
     * @var integer
     */
    private $extLength;

    /**
     * @var integer
     */
    private $extUnitId;

    /**
     * @var string
     */
    private $extUnitName;

    /**
     * @var string
     */
    private $fullExtLength;

    /**
     * @var integer
     */
    private $fileStatusId;

    /**
     * @var string
     */
    private $fileStatusCode;

    /**
     * @var string
     */
    private $fileStatusName;

    /**
     * @var string
     */
    private $fileStatusNameWelsh;

    /**
     * @var integer
     */
    private $indRouteId;

    /**
     * @var string
     */
    private $indRouteCode;

    /**
     * @var string
     */
    private $indRouteName;

    /**
     * @var string
     */
    private $indRouteNameWelsh;

    /**
     * @var integer
     */
    private $recordNo;

    /**
     * @var \DateTime
     */
    private $indStartDate;

    /**
     * @var integer
     */
    private $resultId;

    /**
     * @var string
     */
    private $resultCode;

    /**
     * @var string
     */
    private $resultName;

    /**
     * @var string
     */
    private $resultNameWelsh;

    /**
     * @var \DateTime
     */
    private $resultDate;

    /**
     * @var integer
     */
    private $termNo;

    /**
     * @var integer
     */
    private $workplaceId;

    /**
     * @var string
     */
    private $workplaceCode;

    /**
     * @var string
     */
    private $workplaceName;

    /**
     * @var string
     */
    private $workplaceNameWelsh;


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
     * Set resultFileId
     *
     * @param integer $resultFileId
     * @return GtcwVResultFile
     */
    public function setResultFileId($resultFileId)
    {
        $this->resultFileId = $resultFileId;

        return $this;
    }

    /**
     * Get resultFileId
     *
     * @return integer 
     */
    public function getResultFileId()
    {
        return $this->resultFileId;
    }

    /**
     * Set contactId
     *
     * @param integer $contactId
     * @return GtcwVResultFile
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
     * Set referenceNo
     *
     * @param string $referenceNo
     * @return GtcwVResultFile
     */
    public function setReferenceNo($referenceNo)
    {
        $this->referenceNo = $referenceNo;

        return $this;
    }

    /**
     * Get referenceNo
     *
     * @return string 
     */
    public function getReferenceNo()
    {
        return $this->referenceNo;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return GtcwVResultFile
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return GtcwVResultFile
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     * @return GtcwVResultFile
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime 
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set contactStatusId
     *
     * @param integer $contactStatusId
     * @return GtcwVResultFile
     */
    public function setContactStatusId($contactStatusId)
    {
        $this->contactStatusId = $contactStatusId;

        return $this;
    }

    /**
     * Get contactStatusId
     *
     * @return integer 
     */
    public function getContactStatusId()
    {
        return $this->contactStatusId;
    }

    /**
     * Set contactStatusCode
     *
     * @param string $contactStatusCode
     * @return GtcwVResultFile
     */
    public function setContactStatusCode($contactStatusCode)
    {
        $this->contactStatusCode = $contactStatusCode;

        return $this;
    }

    /**
     * Get contactStatusCode
     *
     * @return string 
     */
    public function getContactStatusCode()
    {
        return $this->contactStatusCode;
    }

    /**
     * Set contactStatusName
     *
     * @param string $contactStatusName
     * @return GtcwVResultFile
     */
    public function setContactStatusName($contactStatusName)
    {
        $this->contactStatusName = $contactStatusName;

        return $this;
    }

    /**
     * Get contactStatusName
     *
     * @return string 
     */
    public function getContactStatusName()
    {
        return $this->contactStatusName;
    }

    /**
     * Set comments
     *
     * @param string $comments
     * @return GtcwVResultFile
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set dateSubmitted
     *
     * @param \DateTime $dateSubmitted
     * @return GtcwVResultFile
     */
    public function setDateSubmitted($dateSubmitted)
    {
        $this->dateSubmitted = $dateSubmitted;

        return $this;
    }

    /**
     * Get dateSubmitted
     *
     * @return \DateTime 
     */
    public function getDateSubmitted()
    {
        return $this->dateSubmitted;
    }

    /**
     * Set employerId
     *
     * @param integer $employerId
     * @return GtcwVResultFile
     */
    public function setEmployerId($employerId)
    {
        $this->employerId = $employerId;

        return $this;
    }

    /**
     * Get employerId
     *
     * @return integer 
     */
    public function getEmployerId()
    {
        return $this->employerId;
    }

    /**
     * Set employerCode
     *
     * @param string $employerCode
     * @return GtcwVResultFile
     */
    public function setEmployerCode($employerCode)
    {
        $this->employerCode = $employerCode;

        return $this;
    }

    /**
     * Get employerCode
     *
     * @return string 
     */
    public function getEmployerCode()
    {
        return $this->employerCode;
    }

    /**
     * Set employerName
     *
     * @param string $employerName
     * @return GtcwVResultFile
     */
    public function setEmployerName($employerName)
    {
        $this->employerName = $employerName;

        return $this;
    }

    /**
     * Get employerName
     *
     * @return string 
     */
    public function getEmployerName()
    {
        return $this->employerName;
    }

    /**
     * Set employerNameWelsh
     *
     * @param string $employerNameWelsh
     * @return GtcwVResultFile
     */
    public function setEmployerNameWelsh($employerNameWelsh)
    {
        $this->employerNameWelsh = $employerNameWelsh;

        return $this;
    }

    /**
     * Get employerNameWelsh
     *
     * @return string 
     */
    public function getEmployerNameWelsh()
    {
        return $this->employerNameWelsh;
    }

    /**
     * Set extLength
     *
     * @param integer $extLength
     * @return GtcwVResultFile
     */
    public function setExtLength($extLength)
    {
        $this->extLength = $extLength;

        return $this;
    }

    /**
     * Get extLength
     *
     * @return integer 
     */
    public function getExtLength()
    {
        return $this->extLength;
    }

    /**
     * Set extUnitId
     *
     * @param integer $extUnitId
     * @return GtcwVResultFile
     */
    public function setExtUnitId($extUnitId)
    {
        $this->extUnitId = $extUnitId;

        return $this;
    }

    /**
     * Get extUnitId
     *
     * @return integer 
     */
    public function getExtUnitId()
    {
        return $this->extUnitId;
    }

    /**
     * Set extUnitName
     *
     * @param string $extUnitName
     * @return GtcwVResultFile
     */
    public function setExtUnitName($extUnitName)
    {
        $this->extUnitName = $extUnitName;

        return $this;
    }

    /**
     * Get extUnitName
     *
     * @return string 
     */
    public function getExtUnitName()
    {
        return $this->extUnitName;
    }

    /**
     * Set fullExtLength
     *
     * @param string $fullExtLength
     * @return GtcwVResultFile
     */
    public function setFullExtLength($fullExtLength)
    {
        $this->fullExtLength = $fullExtLength;

        return $this;
    }

    /**
     * Get fullExtLength
     *
     * @return string 
     */
    public function getFullExtLength()
    {
        return $this->fullExtLength;
    }

    /**
     * Set fileStatusId
     *
     * @param integer $fileStatusId
     * @return GtcwVResultFile
     */
    public function setFileStatusId($fileStatusId)
    {
        $this->fileStatusId = $fileStatusId;

        return $this;
    }

    /**
     * Get fileStatusId
     *
     * @return integer 
     */
    public function getFileStatusId()
    {
        return $this->fileStatusId;
    }

    /**
     * Set fileStatusCode
     *
     * @param string $fileStatusCode
     * @return GtcwVResultFile
     */
    public function setFileStatusCode($fileStatusCode)
    {
        $this->fileStatusCode = $fileStatusCode;

        return $this;
    }

    /**
     * Get fileStatusCode
     *
     * @return string 
     */
    public function getFileStatusCode()
    {
        return $this->fileStatusCode;
    }

    /**
     * Set fileStatusName
     *
     * @param string $fileStatusName
     * @return GtcwVResultFile
     */
    public function setFileStatusName($fileStatusName)
    {
        $this->fileStatusName = $fileStatusName;

        return $this;
    }

    /**
     * Get fileStatusName
     *
     * @return string 
     */
    public function getFileStatusName()
    {
        return $this->fileStatusName;
    }

    /**
     * Set fileStatusNameWelsh
     *
     * @param string $fileStatusNameWelsh
     * @return GtcwVResultFile
     */
    public function setFileStatusNameWelsh($fileStatusNameWelsh)
    {
        $this->fileStatusNameWelsh = $fileStatusNameWelsh;

        return $this;
    }

    /**
     * Get fileStatusNameWelsh
     *
     * @return string 
     */
    public function getFileStatusNameWelsh()
    {
        return $this->fileStatusNameWelsh;
    }

    /**
     * Set indRouteId
     *
     * @param integer $indRouteId
     * @return GtcwVResultFile
     */
    public function setIndRouteId($indRouteId)
    {
        $this->indRouteId = $indRouteId;

        return $this;
    }

    /**
     * Get indRouteId
     *
     * @return integer 
     */
    public function getIndRouteId()
    {
        return $this->indRouteId;
    }

    /**
     * Set indRouteCode
     *
     * @param string $indRouteCode
     * @return GtcwVResultFile
     */
    public function setIndRouteCode($indRouteCode)
    {
        $this->indRouteCode = $indRouteCode;

        return $this;
    }

    /**
     * Get indRouteCode
     *
     * @return string 
     */
    public function getIndRouteCode()
    {
        return $this->indRouteCode;
    }

    /**
     * Set indRouteName
     *
     * @param string $indRouteName
     * @return GtcwVResultFile
     */
    public function setIndRouteName($indRouteName)
    {
        $this->indRouteName = $indRouteName;

        return $this;
    }

    /**
     * Get indRouteName
     *
     * @return string 
     */
    public function getIndRouteName()
    {
        return $this->indRouteName;
    }

    /**
     * Set indRouteNameWelsh
     *
     * @param string $indRouteNameWelsh
     * @return GtcwVResultFile
     */
    public function setIndRouteNameWelsh($indRouteNameWelsh)
    {
        $this->indRouteNameWelsh = $indRouteNameWelsh;

        return $this;
    }

    /**
     * Get indRouteNameWelsh
     *
     * @return string 
     */
    public function getIndRouteNameWelsh()
    {
        return $this->indRouteNameWelsh;
    }

    /**
     * Set recordNo
     *
     * @param integer $recordNo
     * @return GtcwVResultFile
     */
    public function setRecordNo($recordNo)
    {
        $this->recordNo = $recordNo;

        return $this;
    }

    /**
     * Get recordNo
     *
     * @return integer 
     */
    public function getRecordNo()
    {
        return $this->recordNo;
    }

    /**
     * Set indStartDate
     *
     * @param \DateTime $indStartDate
     * @return GtcwVResultFile
     */
    public function setIndStartDate($indStartDate)
    {
        $this->indStartDate = $indStartDate;

        return $this;
    }

    /**
     * Get indStartDate
     *
     * @return \DateTime 
     */
    public function getIndStartDate()
    {
        return $this->indStartDate;
    }

    /**
     * Set resultId
     *
     * @param integer $resultId
     * @return GtcwVResultFile
     */
    public function setResultId($resultId)
    {
        $this->resultId = $resultId;

        return $this;
    }

    /**
     * Get resultId
     *
     * @return integer 
     */
    public function getResultId()
    {
        return $this->resultId;
    }

    /**
     * Set resultCode
     *
     * @param string $resultCode
     * @return GtcwVResultFile
     */
    public function setResultCode($resultCode)
    {
        $this->resultCode = $resultCode;

        return $this;
    }

    /**
     * Get resultCode
     *
     * @return string 
     */
    public function getResultCode()
    {
        return $this->resultCode;
    }

    /**
     * Set resultName
     *
     * @param string $resultName
     * @return GtcwVResultFile
     */
    public function setResultName($resultName)
    {
        $this->resultName = $resultName;

        return $this;
    }

    /**
     * Get resultName
     *
     * @return string 
     */
    public function getResultName()
    {
        return $this->resultName;
    }

    /**
     * Set resultNameWelsh
     *
     * @param string $resultNameWelsh
     * @return GtcwVResultFile
     */
    public function setResultNameWelsh($resultNameWelsh)
    {
        $this->resultNameWelsh = $resultNameWelsh;

        return $this;
    }

    /**
     * Get resultNameWelsh
     *
     * @return string 
     */
    public function getResultNameWelsh()
    {
        return $this->resultNameWelsh;
    }

    /**
     * Set resultDate
     *
     * @param \DateTime $resultDate
     * @return GtcwVResultFile
     */
    public function setResultDate($resultDate)
    {
        $this->resultDate = $resultDate;

        return $this;
    }

    /**
     * Get resultDate
     *
     * @return \DateTime 
     */
    public function getResultDate()
    {
        return $this->resultDate;
    }

    /**
     * Set termNo
     *
     * @param integer $termNo
     * @return GtcwVResultFile
     */
    public function setTermNo($termNo)
    {
        $this->termNo = $termNo;

        return $this;
    }

    /**
     * Get termNo
     *
     * @return integer 
     */
    public function getTermNo()
    {
        return $this->termNo;
    }

    /**
     * Set workplaceId
     *
     * @param integer $workplaceId
     * @return GtcwVResultFile
     */
    public function setWorkplaceId($workplaceId)
    {
        $this->workplaceId = $workplaceId;

        return $this;
    }

    /**
     * Get workplaceId
     *
     * @return integer 
     */
    public function getWorkplaceId()
    {
        return $this->workplaceId;
    }

    /**
     * Set workplaceCode
     *
     * @param string $workplaceCode
     * @return GtcwVResultFile
     */
    public function setWorkplaceCode($workplaceCode)
    {
        $this->workplaceCode = $workplaceCode;

        return $this;
    }

    /**
     * Get workplaceCode
     *
     * @return string 
     */
    public function getWorkplaceCode()
    {
        return $this->workplaceCode;
    }

    /**
     * Set workplaceName
     *
     * @param string $workplaceName
     * @return GtcwVResultFile
     */
    public function setWorkplaceName($workplaceName)
    {
        $this->workplaceName = $workplaceName;

        return $this;
    }

    /**
     * Get workplaceName
     *
     * @return string 
     */
    public function getWorkplaceName()
    {
        return $this->workplaceName;
    }

    /**
     * Set workplaceNameWelsh
     *
     * @param string $workplaceNameWelsh
     * @return GtcwVResultFile
     */
    public function setWorkplaceNameWelsh($workplaceNameWelsh)
    {
        $this->workplaceNameWelsh = $workplaceNameWelsh;

        return $this;
    }

    /**
     * Get workplaceNameWelsh
     *
     * @return string 
     */
    public function getWorkplaceNameWelsh()
    {
        return $this->workplaceNameWelsh;
    }
    /**
     * @var integer
     */
    private $rfCreatedById;

    /**
     * @var string
     */
    private $rfCreatedByName;

    /**
     * @var \DateTime
     */
    private $rfCreatedAt;

    /**
     * @var integer
     */
    private $rfUpdatedById;

    /**
     * @var string
     */
    private $rfUpdatedByName;

    /**
     * @var \DateTime
     */
    private $rfUpdatedAt;


    /**
     * Set rfCreatedById
     *
     * @param integer $rfCreatedById
     * @return GtcwVResultFile
     */
    public function setRfCreatedById($rfCreatedById)
    {
        $this->rfCreatedById = $rfCreatedById;

        return $this;
    }

    /**
     * Get rfCreatedById
     *
     * @return integer 
     */
    public function getRfCreatedById()
    {
        return $this->rfCreatedById;
    }

    /**
     * Set rfCreatedByName
     *
     * @param string $rfCreatedByName
     * @return GtcwVResultFile
     */
    public function setRfCreatedByName($rfCreatedByName)
    {
        $this->rfCreatedByName = $rfCreatedByName;

        return $this;
    }

    /**
     * Get rfCreatedByName
     *
     * @return string 
     */
    public function getRfCreatedByName()
    {
        return $this->rfCreatedByName;
    }

    /**
     * Set rfCreatedAt
     *
     * @param \DateTime $rfCreatedAt
     * @return GtcwVResultFile
     */
    public function setRfCreatedAt($rfCreatedAt)
    {
        $this->rfCreatedAt = $rfCreatedAt;

        return $this;
    }

    /**
     * Get rfCreatedAt
     *
     * @return \DateTime 
     */
    public function getRfCreatedAt()
    {
        return $this->rfCreatedAt;
    }

    /**
     * Set rfUpdatedById
     *
     * @param integer $rfUpdatedById
     * @return GtcwVResultFile
     */
    public function setRfUpdatedById($rfUpdatedById)
    {
        $this->rfUpdatedById = $rfUpdatedById;

        return $this;
    }

    /**
     * Get rfUpdatedById
     *
     * @return integer 
     */
    public function getRfUpdatedById()
    {
        return $this->rfUpdatedById;
    }

    /**
     * Set rfUpdatedByName
     *
     * @param string $rfUpdatedByName
     * @return GtcwVResultFile
     */
    public function setRfUpdatedByName($rfUpdatedByName)
    {
        $this->rfUpdatedByName = $rfUpdatedByName;

        return $this;
    }

    /**
     * Get rfUpdatedByName
     *
     * @return string 
     */
    public function getRfUpdatedByName()
    {
        return $this->rfUpdatedByName;
    }

    /**
     * Set rfUpdatedAt
     *
     * @param \DateTime $rfUpdatedAt
     * @return GtcwVResultFile
     */
    public function setRfUpdatedAt($rfUpdatedAt)
    {
        $this->rfUpdatedAt = $rfUpdatedAt;

        return $this;
    }

    /**
     * Get rfUpdatedAt
     *
     * @return \DateTime 
     */
    public function getRfUpdatedAt()
    {
        return $this->rfUpdatedAt;
    }
}
