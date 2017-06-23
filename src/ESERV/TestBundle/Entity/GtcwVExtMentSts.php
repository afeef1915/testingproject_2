<?php

namespace ESERV\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GtcwVExtMentSts
 */
namespace ESERV\TestBundle\Entity;

/**
 * Description of GtcwVExtMentSts
 *
 * @author rtripathi
 */
class GtcwVExtMentSts {
    

    /**
     * @var integer
     */
    private $dtindex;

    /**
     * @var integer
     */
    private $contactId;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $referenceNo;

    /**
     * @var \DateTime
     */
    private $dateOfBirth;

    /**
     * @var \DateTime
     */
    private $inductionCommenced;
    
    /**
     * @var integer
     */
    private $employerId;

    /**
     * @var string
     */
    private $schoolName;

    /**
     * @var string
     */
    private $schoolNameWelsh;

    /**
     * @var \DateTime
     */
    private $tStartDate;

    /**
     * @var string
     */
    private $tRecordNo;

    /**
     * @var string
     */
    private $tTermNo;

    /**
     * @var string
     */
    private $statusCode;

    /**
     * @var string
     */
    private $statusName;

    /**
     * @var string
     */
    private $statusNameWelsh;

    /**
     * @var \DateTime
     */
    private $notifiedDate;

    /**
     * @var string
     */
    private $extLength;

    /**
     * @var integer
     */
    private $extUnitId;

    /**
     * @var string
     */
    private $extUnit;

    /**
     * @var string
     */
    private $extUnitWelsh;

    /**
     * @var integer
     */
    private $tEmployerId;

    /**
     * @var string
     */
    private $tEmployerName;

    /**
     * @var string
     */
    private $tEmployerNameWelsh;

    /**
     * @var string
     */
    private $fullPartTime;

    /**
     * @var string
     */
    private $fullPartTimeWelsh;

    /**
     * @var string
     */
    private $proportion;

    /**
     * @var integer
     */
    private $contractId;

    /**
     * @var string
     */
    private $contractName;

    /**
     * @var string
     */
    private $contractNameWelsh;

    /**
     * @var \DateTime
     */
    private $contractDate;

    /**
     * @var integer
     */
    private $minKeystageId;

    /**
     * @var string
     */
    private $minKeystage;

    /**
     * @var string
     */
    private $minKeystageWelsh;

    /**
     * @var integer
     */
    private $maxKeystageId;

    /**
     * @var string
     */
    private $maxKeystage;

    /**
     * @var string
     */
    private $maxKeystageWelsh;

    /**
     * @var integer
     */
    private $tutorContactId;

    /**
     * @var integer
     */
    private $headContactId;

    /**
     * @var integer
     */
    private $extmentContactId;

    /**
     * @var integer
     */
    private $minAgerangeId;

    /**
     * @var string
     */
    private $minAgerange;

    /**
     * @var string
     */
    private $minAgerangeWelsh;

    /**
     * @var integer
     */
    private $maxAgerangeId;

    /**
     * @var string
     */
    private $maxAgerange;

    /**
     * @var string
     */
    private $maxAgerangeWelsh;

    /**
     * @var string
     */
    private $routeName;

    /**
     * @var string
     */
    private $routeNameWelsh;

    /**
     * @var string
     */
    private $totalSessions;

    /**
     * @var integer
     */
    private $tRouteId;

    /**
     * @var string
     */
    private $tRouteCode;

    /**
     * @var string
     */
    private $tRouteName;

    /**
     * @var string
     */
    private $tRouteNameWelsh;

    /**
     * @var integer
     */
    private $mentorContactId;


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
     * @return GtcwVExtMentSts
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
     * Set firstName
     *
     * @param string $firstName
     * @return GtcwVExtMentSts
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
     * @return GtcwVExtMentSts
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
     * Set referenceNo
     *
     * @param string $referenceNo
     * @return GtcwVExtMentSts
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
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     * @return GtcwVExtMentSts
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
     * Set inductionCommenced
     *
     * @param \DateTime $inductionCommenced
     * @return GtcwVExtMentSts
     */
    public function setInductionCommenced($inductionCommenced)
    {
        $this->inductionCommenced = $inductionCommenced;

        return $this;
    }

    /**
     * Get inductionCommenced
     *
     * @return \DateTime 
     */
    public function getInductionCommenced()
    {
        return $this->inductionCommenced;
    }
    
    /**
     * Set employerId
     *
     * @param integer $employerId
     * @return GtcwVExtMentSts
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
     * Set schoolName
     *
     * @param string $schoolName
     * @return GtcwVExtMentSts
     */
    public function setSchoolName($schoolName)
    {
        $this->schoolName = $schoolName;

        return $this;
    }

    /**
     * Get schoolName
     *
     * @return string 
     */
    public function getSchoolName()
    {
        return $this->schoolName;
    }

    /**
     * Set schoolNameWelsh
     *
     * @param string $schoolNameWelsh
     * @return GtcwVExtMentSts
     */
    public function setSchoolNameWelsh($schoolNameWelsh)
    {
        $this->schoolNameWelsh = $schoolNameWelsh;

        return $this;
    }

    /**
     * Get schoolNameWelsh
     *
     * @return string 
     */
    public function getSchoolNameWelsh()
    {
        return $this->schoolNameWelsh;
    }

    /**
     * Set tStartDate
     *
     * @param \DateTime $tStartDate
     * @return GtcwVExtMentSts
     */
    public function setTStartDate($tStartDate)
    {
        $this->tStartDate = $tStartDate;

        return $this;
    }

    /**
     * Get tStartDate
     *
     * @return \DateTime 
     */
    public function getTStartDate()
    {
        return $this->tStartDate;
    }

    /**
     * Set tRecordNo
     *
     * @param string $tRecordNo
     * @return GtcwVExtMentSts
     */
    public function setTRecordNo($tRecordNo)
    {
        $this->tRecordNo = $tRecordNo;

        return $this;
    }

    /**
     * Get tRecordNo
     *
     * @return string 
     */
    public function getTRecordNo()
    {
        return $this->tRecordNo;
    }

    /**
     * Set tTermNo
     *
     * @param string $tTermNo
     * @return GtcwVExtMentSts
     */
    public function setTTermNo($tTermNo)
    {
        $this->tTermNo = $tTermNo;

        return $this;
    }

    /**
     * Get tTermNo
     *
     * @return string 
     */
    public function getTTermNo()
    {
        return $this->tTermNo;
    }

    /**
     * Set statusCode
     *
     * @param string $statusCode
     * @return GtcwVExtMentSts
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Get statusCode
     *
     * @return string 
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set statusName
     *
     * @param string $statusName
     * @return GtcwVExtMentSts
     */
    public function setStatusName($statusName)
    {
        $this->statusName = $statusName;

        return $this;
    }

    /**
     * Get statusName
     *
     * @return string 
     */
    public function getStatusName()
    {
        return $this->statusName;
    }

    /**
     * Set statusNameWelsh
     *
     * @param string $statusNameWelsh
     * @return GtcwVExtMentSts
     */
    public function setStatusNameWelsh($statusNameWelsh)
    {
        $this->statusNameWelsh = $statusNameWelsh;

        return $this;
    }

    /**
     * Get statusNameWelsh
     *
     * @return string 
     */
    public function getStatusNameWelsh()
    {
        return $this->statusNameWelsh;
    }

    /**
     * Set notifiedDate
     *
     * @param \DateTime $notifiedDate
     * @return GtcwVExtMentSts
     */
    public function setNotifiedDate($notifiedDate)
    {
        $this->notifiedDate = $notifiedDate;

        return $this;
    }

    /**
     * Get notifiedDate
     *
     * @return \DateTime 
     */
    public function getNotifiedDate()
    {
        return $this->notifiedDate;
    }

    /**
     * Set extLength
     *
     * @param string $extLength
     * @return GtcwVExtMentSts
     */
    public function setExtLength($extLength)
    {
        $this->extLength = $extLength;

        return $this;
    }

    /**
     * Get extLength
     *
     * @return string 
     */
    public function getExtLength()
    {
        return $this->extLength;
    }

    /**
     * Set extUnitId
     *
     * @param integer $extUnitId
     * @return GtcwVExtMentSts
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
     * Set extUnit
     *
     * @param string $extUnit
     * @return GtcwVExtMentSts
     */
    public function setExtUnit($extUnit)
    {
        $this->extUnit = $extUnit;

        return $this;
    }

    /**
     * Get extUnit
     *
     * @return string 
     */
    public function getExtUnit()
    {
        return $this->extUnit;
    }

    /**
     * Set extUnitWelsh
     *
     * @param string $extUnitWelsh
     * @return GtcwVExtMentSts
     */
    public function setExtUnitWelsh($extUnitWelsh)
    {
        $this->extUnitWelsh = $extUnitWelsh;

        return $this;
    }

    /**
     * Get extUnitWelsh
     *
     * @return string 
     */
    public function getExtUnitWelsh()
    {
        return $this->extUnitWelsh;
    }

    /**
     * Set tEmployerId
     *
     * @param integer $tEmployerId
     * @return GtcwVExtMentSts
     */
    public function setTEmployerId($tEmployerId)
    {
        $this->tEmployerId = $tEmployerId;

        return $this;
    }

    /**
     * Get tEmployerId
     *
     * @return integer 
     */
    public function getTEmployerId()
    {
        return $this->tEmployerId;
    }

    /**
     * Set tEmployerName
     *
     * @param string $tEmployerName
     * @return GtcwVExtMentSts
     */
    public function setTEmployerName($tEmployerName)
    {
        $this->tEmployerName = $tEmployerName;

        return $this;
    }

    /**
     * Get tEmployerName
     *
     * @return string 
     */
    public function getTEmployerName()
    {
        return $this->tEmployerName;
    }

    /**
     * Set tEmployerNameWelsh
     *
     * @param string $tEmployerNameWelsh
     * @return GtcwVExtMentSts
     */
    public function setTEmployerNameWelsh($tEmployerNameWelsh)
    {
        $this->tEmployerNameWelsh = $tEmployerNameWelsh;

        return $this;
    }

    /**
     * Get tEmployerNameWelsh
     *
     * @return string 
     */
    public function getTEmployerNameWelsh()
    {
        return $this->tEmployerNameWelsh;
    }

    /**
     * Set fullPartTime
     *
     * @param string $fullPartTime
     * @return GtcwVExtMentSts
     */
    public function setFullPartTime($fullPartTime)
    {
        $this->fullPartTime = $fullPartTime;

        return $this;
    }

    /**
     * Get fullPartTime
     *
     * @return string 
     */
    public function getFullPartTime()
    {
        return $this->fullPartTime;
    }

    /**
     * Set fullPartTimeWelsh
     *
     * @param string $fullPartTimeWelsh
     * @return GtcwVExtMentSts
     */
    public function setFullPartTimeWelsh($fullPartTimeWelsh)
    {
        $this->fullPartTimeWelsh = $fullPartTimeWelsh;

        return $this;
    }

    /**
     * Get fullPartTimeWelsh
     *
     * @return string 
     */
    public function getFullPartTimeWelsh()
    {
        return $this->fullPartTimeWelsh;
    }

    /**
     * Set proportion
     *
     * @param string $proportion
     * @return GtcwVExtMentSts
     */
    public function setProportion($proportion)
    {
        $this->proportion = $proportion;

        return $this;
    }

    /**
     * Get proportion
     *
     * @return string 
     */
    public function getProportion()
    {
        return $this->proportion;
    }

    /**
     * Set contractId
     *
     * @param integer $contractId
     * @return GtcwVExtMentSts
     */
    public function setContractId($contractId)
    {
        $this->contractId = $contractId;

        return $this;
    }

    /**
     * Get contractId
     *
     * @return integer 
     */
    public function getContractId()
    {
        return $this->contractId;
    }

    /**
     * Set contractName
     *
     * @param string $contractName
     * @return GtcwVExtMentSts
     */
    public function setContractName($contractName)
    {
        $this->contractName = $contractName;

        return $this;
    }

    /**
     * Get contractName
     *
     * @return string 
     */
    public function getContractName()
    {
        return $this->contractName;
    }

    /**
     * Set contractNameWelsh
     *
     * @param string $contractNameWelsh
     * @return GtcwVExtMentSts
     */
    public function setContractNameWelsh($contractNameWelsh)
    {
        $this->contractNameWelsh = $contractNameWelsh;

        return $this;
    }

    /**
     * Get contractNameWelsh
     *
     * @return string 
     */
    public function getContractNameWelsh()
    {
        return $this->contractNameWelsh;
    }

    /**
     * Set contractDate
     *
     * @param \DateTime $contractDate
     * @return GtcwVExtMentSts
     */
    public function setContractDate($contractDate)
    {
        $this->contractDate = $contractDate;

        return $this;
    }

    /**
     * Get contractDate
     *
     * @return \DateTime 
     */
    public function getContractDate()
    {
        return $this->contractDate;
    }

    /**
     * Set minKeystageId
     *
     * @param integer $minKeystageId
     * @return GtcwVExtMentSts
     */
    public function setMinKeystageId($minKeystageId)
    {
        $this->minKeystageId = $minKeystageId;

        return $this;
    }

    /**
     * Get minKeystageId
     *
     * @return integer 
     */
    public function getMinKeystageId()
    {
        return $this->minKeystageId;
    }

    /**
     * Set minKeystage
     *
     * @param string $minKeystage
     * @return GtcwVExtMentSts
     */
    public function setMinKeystage($minKeystage)
    {
        $this->minKeystage = $minKeystage;

        return $this;
    }

    /**
     * Get minKeystage
     *
     * @return string 
     */
    public function getMinKeystage()
    {
        return $this->minKeystage;
    }

    /**
     * Set minKeystageWelsh
     *
     * @param string $minKeystageWelsh
     * @return GtcwVExtMentSts
     */
    public function setMinKeystageWelsh($minKeystageWelsh)
    {
        $this->minKeystageWelsh = $minKeystageWelsh;

        return $this;
    }

    /**
     * Get minKeystageWelsh
     *
     * @return string 
     */
    public function getMinKeystageWelsh()
    {
        return $this->minKeystageWelsh;
    }

    /**
     * Set maxKeystageId
     *
     * @param integer $maxKeystageId
     * @return GtcwVExtMentSts
     */
    public function setMaxKeystageId($maxKeystageId)
    {
        $this->maxKeystageId = $maxKeystageId;

        return $this;
    }

    /**
     * Get maxKeystageId
     *
     * @return integer 
     */
    public function getMaxKeystageId()
    {
        return $this->maxKeystageId;
    }

    /**
     * Set maxKeystage
     *
     * @param string $maxKeystage
     * @return GtcwVExtMentSts
     */
    public function setMaxKeystage($maxKeystage)
    {
        $this->maxKeystage = $maxKeystage;

        return $this;
    }

    /**
     * Get maxKeystage
     *
     * @return string 
     */
    public function getMaxKeystage()
    {
        return $this->maxKeystage;
    }

    /**
     * Set maxKeystageWelsh
     *
     * @param string $maxKeystageWelsh
     * @return GtcwVExtMentSts
     */
    public function setMaxKeystageWelsh($maxKeystageWelsh)
    {
        $this->maxKeystageWelsh = $maxKeystageWelsh;

        return $this;
    }

    /**
     * Get maxKeystageWelsh
     *
     * @return string 
     */
    public function getMaxKeystageWelsh()
    {
        return $this->maxKeystageWelsh;
    }

    /**
     * Set tutorContactId
     *
     * @param integer $tutorContactId
     * @return GtcwVExtMentSts
     */
    public function setTutorContactId($tutorContactId)
    {
        $this->tutorContactId = $tutorContactId;

        return $this;
    }

    /**
     * Get tutorContactId
     *
     * @return integer 
     */
    public function getTutorContactId()
    {
        return $this->tutorContactId;
    }

    /**
     * Set headContactId
     *
     * @param integer $headContactId
     * @return GtcwVExtMentSts
     */
    public function setHeadContactId($headContactId)
    {
        $this->headContactId = $headContactId;

        return $this;
    }

    /**
     * Get headContactId
     *
     * @return integer 
     */
    public function getHeadContactId()
    {
        return $this->headContactId;
    }

    /**
     * Set extmentContactId
     *
     * @param integer $extmentContactId
     * @return GtcwVExtMentSts
     */
    public function setExtmentContactId($extmentContactId)
    {
        $this->extmentContactId = $extmentContactId;

        return $this;
    }

    /**
     * Get extmentContactId
     *
     * @return integer 
     */
    public function getExtmentContactId()
    {
        return $this->extmentContactId;
    }

    /**
     * Set minAgerangeId
     *
     * @param integer $minAgerangeId
     * @return GtcwVExtMentSts
     */
    public function setMinAgerangeId($minAgerangeId)
    {
        $this->minAgerangeId = $minAgerangeId;

        return $this;
    }

    /**
     * Get minAgerangeId
     *
     * @return integer 
     */
    public function getMinAgerangeId()
    {
        return $this->minAgerangeId;
    }

    /**
     * Set minAgerange
     *
     * @param string $minAgerange
     * @return GtcwVExtMentSts
     */
    public function setMinAgerange($minAgerange)
    {
        $this->minAgerange = $minAgerange;

        return $this;
    }

    /**
     * Get minAgerange
     *
     * @return string 
     */
    public function getMinAgerange()
    {
        return $this->minAgerange;
    }

    /**
     * Set minAgerangeWelsh
     *
     * @param string $minAgerangeWelsh
     * @return GtcwVExtMentSts
     */
    public function setMinAgerangeWelsh($minAgerangeWelsh)
    {
        $this->minAgerangeWelsh = $minAgerangeWelsh;

        return $this;
    }

    /**
     * Get minAgerangeWelsh
     *
     * @return string 
     */
    public function getMinAgerangeWelsh()
    {
        return $this->minAgerangeWelsh;
    }

    /**
     * Set maxAgerangeId
     *
     * @param integer $maxAgerangeId
     * @return GtcwVExtMentSts
     */
    public function setMaxAgerangeId($maxAgerangeId)
    {
        $this->maxAgerangeId = $maxAgerangeId;

        return $this;
    }

    /**
     * Get maxAgerangeId
     *
     * @return integer 
     */
    public function getMaxAgerangeId()
    {
        return $this->maxAgerangeId;
    }

    /**
     * Set maxAgerange
     *
     * @param string $maxAgerange
     * @return GtcwVExtMentSts
     */
    public function setMaxAgerange($maxAgerange)
    {
        $this->maxAgerange = $maxAgerange;

        return $this;
    }

    /**
     * Get maxAgerange
     *
     * @return string 
     */
    public function getMaxAgerange()
    {
        return $this->maxAgerange;
    }

    /**
     * Set maxAgerangeWelsh
     *
     * @param string $maxAgerangeWelsh
     * @return GtcwVExtMentSts
     */
    public function setMaxAgerangeWelsh($maxAgerangeWelsh)
    {
        $this->maxAgerangeWelsh = $maxAgerangeWelsh;

        return $this;
    }

    /**
     * Get maxAgerangeWelsh
     *
     * @return string 
     */
    public function getMaxAgerangeWelsh()
    {
        return $this->maxAgerangeWelsh;
    }

    /**
     * Set routeName
     *
     * @param string $routeName
     * @return GtcwVExtMentSts
     */
    public function setRouteName($routeName)
    {
        $this->routeName = $routeName;

        return $this;
    }

    /**
     * Get routeName
     *
     * @return string 
     */
    public function getRouteName()
    {
        return $this->routeName;
    }

    /**
     * Set routeNameWelsh
     *
     * @param string $routeNameWelsh
     * @return GtcwVExtMentSts
     */
    public function setRouteNameWelsh($routeNameWelsh)
    {
        $this->routeNameWelsh = $routeNameWelsh;

        return $this;
    }

    /**
     * Get routeNameWelsh
     *
     * @return string 
     */
    public function getRouteNameWelsh()
    {
        return $this->routeNameWelsh;
    }

    /**
     * Set totalSessions
     *
     * @param string $totalSessions
     * @return GtcwVExtMentSts
     */
    public function setTotalSessions($totalSessions)
    {
        $this->totalSessions = $totalSessions;

        return $this;
    }

    /**
     * Get totalSessions
     *
     * @return string 
     */
    public function getTotalSessions()
    {
        return $this->totalSessions;
    }

    /**
     * Set tRouteId
     *
     * @param integer $tRouteId
     * @return GtcwVExtMentSts
     */
    public function setTRouteId($tRouteId)
    {
        $this->tRouteId = $tRouteId;

        return $this;
    }

    /**
     * Get tRouteId
     *
     * @return integer 
     */
    public function getTRouteId()
    {
        return $this->tRouteId;
    }

    /**
     * Set tRouteCode
     *
     * @param string $tRouteCode
     * @return GtcwVExtMentSts
     */
    public function setTRouteCode($tRouteCode)
    {
        $this->tRouteCode = $tRouteCode;

        return $this;
    }

    /**
     * Get tRouteCode
     *
     * @return string 
     */
    public function getTRouteCode()
    {
        return $this->tRouteCode;
    }

    /**
     * Set tRouteName
     *
     * @param string $tRouteName
     * @return GtcwVExtMentSts
     */
    public function setTRouteName($tRouteName)
    {
        $this->tRouteName = $tRouteName;

        return $this;
    }

    /**
     * Get tRouteName
     *
     * @return string 
     */
    public function getTRouteName()
    {
        return $this->tRouteName;
    }

    /**
     * Set tRouteNameWelsh
     *
     * @param string $tRouteNameWelsh
     * @return GtcwVExtMentSts
     */
    public function setTRouteNameWelsh($tRouteNameWelsh)
    {
        $this->tRouteNameWelsh = $tRouteNameWelsh;

        return $this;
    }

    /**
     * Get tRouteNameWelsh
     *
     * @return string 
     */
    public function getTRouteNameWelsh()
    {
        return $this->tRouteNameWelsh;
    }

    /**
     * Set mentorContactId
     *
     * @param integer $mentorContactId
     * @return GtcwVExtMentSts
     */
    public function setMentorContactId($mentorContactId)
    {
        $this->mentorContactId = $mentorContactId;

        return $this;
    }

    /**
     * Get mentorContactId
     *
     * @return integer 
     */
    public function getMentorContactId()
    {
        return $this->mentorContactId;
    }
}
