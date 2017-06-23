<?php

namespace ESERV\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GtcwVExtMent
 */
namespace ESERV\TestBundle\Entity;

/**
 * Description of GtcwVExtMent
 *
 * @author rtripathi
 */
class GtcwVExtMent {
    
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
     * @var string
     */
    private $addressLine1;

    /**
     * @var string
     */
    private $addressLine2;

    /**
     * @var string
     */
    private $addressLine3;

    /**
     * @var string
     */
    private $postcode;

    /**
     * @var string
     */
    private $town;

    /**
     * @var string
     */
    private $county;

    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * @var string
     */
    private $emailAddress;

    /**
     * @var string
     */
    private $programDetail;

    /**
     * @var \DateTime
     */
    private $inductionCommenced;

    /**
     * @var string
     */
    private $totalSessions;

    /**
     * @var \DateTime
     */
    private $tInductionStarted;

    /**
     * @var integer
     */
    private $employerId;

    /**
     * @var string
     */
    private $laCode;

    /**
     * @var string
     */
    private $laName;

    /**
     * @var string
     */
    private $laNameWelsh;

    /**
     * @var integer
     */
    private $tWorkplaceId;

    /**
     * @var string
     */
    private $schoolCode;

    /**
     * @var string
     */
    private $schoolName;

    /**
     * @var string
     */
    private $schoolNameWelsh;

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
    private $mepLaCode;

    /**
     * @var string
     */
    private $mepLaName;

    /**
     * @var string
     */
    private $mepLaNameWelsh;

    /**
     * @var string
     */
    private $mepSchoolCode;

    /**
     * @var string
     */
    private $mepSchoolName;

    /**
     * @var string
     */
    private $mepSchoolNameWelsh;

    /**
     * @var string
     */
    private $mmdRecordNo;

    /**
     * @var \DateTime
     */
    private $passDate;

    /**
     * @var integer
     */
    private $indStatusId;

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
     * @return GtcwVExtMent
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
     * @return GtcwVExtMent
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
     * @return GtcwVExtMent
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
     * @return GtcwVExtMent
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
     * @return GtcwVExtMent
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
     * Set addressLine1
     *
     * @param string $addressLine1
     * @return GtcwVExtMent
     */
    public function setAddressLine1($addressLine1)
    {
        $this->addressLine1 = $addressLine1;

        return $this;
    }

    /**
     * Get addressLine1
     *
     * @return string 
     */
    public function getAddressLine1()
    {
        return $this->addressLine1;
    }

    /**
     * Set addressLine2
     *
     * @param string $addressLine2
     * @return GtcwVExtMent
     */
    public function setAddressLine2($addressLine2)
    {
        $this->addressLine2 = $addressLine2;

        return $this;
    }

    /**
     * Get addressLine2
     *
     * @return string 
     */
    public function getAddressLine2()
    {
        return $this->addressLine2;
    }

    /**
     * Set addressLine3
     *
     * @param string $addressLine3
     * @return GtcwVExtMent
     */
    public function setAddressLine3($addressLine3)
    {
        $this->addressLine3 = $addressLine3;

        return $this;
    }

    /**
     * Get addressLine3
     *
     * @return string 
     */
    public function getAddressLine3()
    {
        return $this->addressLine3;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     * @return GtcwVExtMent
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string 
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set town
     *
     * @param string $town
     * @return GtcwVExtMent
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string 
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set county
     *
     * @param string $county
     * @return GtcwVExtMent
     */
    public function setCounty($county)
    {
        $this->county = $county;

        return $this;
    }

    /**
     * Get county
     *
     * @return string 
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return GtcwVExtMent
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     * @return GtcwVExtMent
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * Get emailAddress
     *
     * @return string 
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * Set programDetail
     *
     * @param string $programDetail
     * @return GtcwVExtMent
     */
    public function setProgramDetail($programDetail)
    {
        $this->programDetail = $programDetail;

        return $this;
    }

    /**
     * Get programDetail
     *
     * @return string 
     */
    public function getProgramDetail()
    {
        return $this->programDetail;
    }

    /**
     * Set inductionCommenced
     *
     * @param \DateTime $inductionCommenced
     * @return GtcwVExtMent
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
     * Set totalSessions
     *
     * @param string $totalSessions
     * @return GtcwVExtMent
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
     * Set tInductionStarted
     *
     * @param \DateTime $tInductionStarted
     * @return GtcwVExtMent
     */
    public function setTInductionStarted($tInductionStarted)
    {
        $this->tInductionStarted = $tInductionStarted;

        return $this;
    }

    /**
     * Get tInductionStarted
     *
     * @return \DateTime 
     */
    public function getTInductionStarted()
    {
        return $this->tInductionStarted;
    }

    /**
     * Set employerId
     *
     * @param integer $employerId
     * @return GtcwVExtMent
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
     * Set laCode
     *
     * @param string $laCode
     * @return GtcwVExtMent
     */
    public function setLaCode($laCode)
    {
        $this->laCode = $laCode;

        return $this;
    }

    /**
     * Get laCode
     *
     * @return string 
     */
    public function getLaCode()
    {
        return $this->laCode;
    }

    /**
     * Set laName
     *
     * @param string $laName
     * @return GtcwVExtMent
     */
    public function setLaName($laName)
    {
        $this->laName = $laName;

        return $this;
    }

    /**
     * Get laName
     *
     * @return string 
     */
    public function getLaName()
    {
        return $this->laName;
    }

    /**
     * Set laNameWelsh
     *
     * @param string $laNameWelsh
     * @return GtcwVExtMent
     */
    public function setLaNameWelsh($laNameWelsh)
    {
        $this->laNameWelsh = $laNameWelsh;

        return $this;
    }

    /**
     * Get laNameWelsh
     *
     * @return string 
     */
    public function getLaNameWelsh()
    {
        return $this->laNameWelsh;
    }

    /**
     * Set tWorkplaceId
     *
     * @param integer $tWorkplaceId
     * @return GtcwVExtMent
     */
    public function setTWorkplaceId($tWorkplaceId)
    {
        $this->tWorkplaceId = $tWorkplaceId;

        return $this;
    }

    /**
     * Get tWorkplaceId
     *
     * @return integer 
     */
    public function getTWorkplaceId()
    {
        return $this->tWorkplaceId;
    }

    /**
     * Set schoolCode
     *
     * @param string $schoolCode
     * @return GtcwVExtMent
     */
    public function setSchoolCode($schoolCode)
    {
        $this->schoolCode = $schoolCode;

        return $this;
    }

    /**
     * Get schoolCode
     *
     * @return string 
     */
    public function getSchoolCode()
    {
        return $this->schoolCode;
    }

    /**
     * Set schoolName
     *
     * @param string $schoolName
     * @return GtcwVExtMent
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
     * @return GtcwVExtMent
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
     * Set tRecordNo
     *
     * @param string $tRecordNo
     * @return GtcwVExtMent
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
     * @return GtcwVExtMent
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
     * Set mepLaCode
     *
     * @param string $mepLaCode
     * @return GtcwVExtMent
     */
    public function setMepLaCode($mepLaCode)
    {
        $this->mepLaCode = $mepLaCode;

        return $this;
    }

    /**
     * Get mepLaCode
     *
     * @return string 
     */
    public function getMepLaCode()
    {
        return $this->mepLaCode;
    }

    /**
     * Set mepLaName
     *
     * @param string $mepLaName
     * @return GtcwVExtMent
     */
    public function setMepLaName($mepLaName)
    {
        $this->mepLaName = $mepLaName;

        return $this;
    }

    /**
     * Get mepLaName
     *
     * @return string 
     */
    public function getMepLaName()
    {
        return $this->mepLaName;
    }

    /**
     * Set mepLaNameWelsh
     *
     * @param string $mepLaNameWelsh
     * @return GtcwVExtMent
     */
    public function setMepLaNameWelsh($mepLaNameWelsh)
    {
        $this->mepLaNameWelsh = $mepLaNameWelsh;

        return $this;
    }

    /**
     * Get mepLaNameWelsh
     *
     * @return string 
     */
    public function getMepLaNameWelsh()
    {
        return $this->mepLaNameWelsh;
    }

    /**
     * Set mepSchoolCode
     *
     * @param string $mepSchoolCode
     * @return GtcwVExtMent
     */
    public function setMepSchoolCode($mepSchoolCode)
    {
        $this->mepSchoolCode = $mepSchoolCode;

        return $this;
    }

    /**
     * Get mepSchoolCode
     *
     * @return string 
     */
    public function getMepSchoolCode()
    {
        return $this->mepSchoolCode;
    }

    /**
     * Set mepSchoolName
     *
     * @param string $mepSchoolName
     * @return GtcwVExtMent
     */
    public function setMepSchoolName($mepSchoolName)
    {
        $this->mepSchoolName = $mepSchoolName;

        return $this;
    }

    /**
     * Get mepSchoolName
     *
     * @return string 
     */
    public function getMepSchoolName()
    {
        return $this->mepSchoolName;
    }

    /**
     * Set mepSchoolNameWelsh
     *
     * @param string $mepSchoolNameWelsh
     * @return GtcwVExtMent
     */
    public function setMepSchoolNameWelsh($mepSchoolNameWelsh)
    {
        $this->mepSchoolNameWelsh = $mepSchoolNameWelsh;

        return $this;
    }

    /**
     * Get mepSchoolNameWelsh
     *
     * @return string 
     */
    public function getMepSchoolNameWelsh()
    {
        return $this->mepSchoolNameWelsh;
    }

    /**
     * Set mmdRecordNo
     *
     * @param string $mmdRecordNo
     * @return GtcwVExtMent
     */
    public function setMmdRecordNo($mmdRecordNo)
    {
        $this->mmdRecordNo = $mmdRecordNo;

        return $this;
    }

    /**
     * Get mmdRecordNo
     *
     * @return string 
     */
    public function getMmdRecordNo()
    {
        return $this->mmdRecordNo;
    }

    /**
     * Set passDate
     *
     * @param \DateTime $passDate
     * @return GtcwVExtMent
     */
    public function setPassDate($passDate)
    {
        $this->passDate = $passDate;

        return $this;
    }

    /**
     * Get passDate
     *
     * @return \DateTime 
     */
    public function getPassDate()
    {
        return $this->passDate;
    }

    /**
     * Set indStatusId
     *
     * @param integer $indStatusId
     * @return GtcwVExtMent
     */
    public function setIndStatusId($indStatusId)
    {
        $this->indStatusId = $indStatusId;

        return $this;
    }

    /**
     * Get indStatusId
     *
     * @return integer 
     */
    public function getIndStatusId()
    {
        return $this->indStatusId;
    }

    /**
     * Set statusCode
     *
     * @param string $statusCode
     * @return GtcwVExtMent
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
     * @return GtcwVExtMent
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
     * @return GtcwVExtMent
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
     * Set mentorContactId
     *
     * @param integer $mentorContactId
     * @return GtcwVExtMent
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
