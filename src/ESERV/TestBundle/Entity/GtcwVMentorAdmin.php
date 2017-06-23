<?php

namespace ESERV\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GtcwVMentorAdmin
 */
class GtcwVMentorAdmin
{
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
    private $gtcwMentorId;

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
    private $fullName;

    /**
     * @var \DateTime
     */
    private $dateOfBirth;

    /**
     * @var string
     */
    private $referenceNo;

    /**
     * @var string
     */
    private $addressLine1;

    /**
     * @var string
     */
    private $postcode;

    /**
     * @var string
     */
    private $middleName;

    /**
     * @var string
     */
    private $lastNameSearch;

    /**
     * @var string
     */
    private $initials;

    /**
     * @var string
     */
    private $jobTitle;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var string
     */
    private $previousLastName;

    /**
     * @var string
     */
    private $disabled;

    /**
     * @var string
     */
    private $niNumber;

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
    private $town;

    /**
     * @var string
     */
    private $county;

    /**
     * @var string
     */
    private $emailAddress;


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
     * @return GtcwVMentorAdmin
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
     * Set gtcwMentorId
     *
     * @param integer $gtcwMentorId
     * @return GtcwVMentorAdmin
     */
    public function setGtcwMentorId($gtcwMentorId)
    {
        $this->gtcwMentorId = $gtcwMentorId;

        return $this;
    }

    /**
     * Get gtcwMentorId
     *
     * @return integer 
     */
    public function getGtcwMentorId()
    {
        return $this->gtcwMentorId;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return GtcwVMentorAdmin
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
     * @return GtcwVMentorAdmin
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
     * Set fullName
     *
     * @param string $fullName
     * @return GtcwVMentorAdmin
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string 
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     * @return GtcwVMentorAdmin
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
     * Set referenceNo
     *
     * @param string $referenceNo
     * @return GtcwVMentorAdmin
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
     * Set addressLine1
     *
     * @param string $addressLine1
     * @return GtcwVMentorAdmin
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
     * Set postcode
     *
     * @param string $postcode
     * @return GtcwVMentorAdmin
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
     * Set middleName
     *
     * @param string $middleName
     * @return GtcwVMentorAdmin
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;

        return $this;
    }

    /**
     * Get middleName
     *
     * @return string 
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * Set lastNameSearch
     *
     * @param string $lastNameSearch
     * @return GtcwVMentorAdmin
     */
    public function setLastNameSearch($lastNameSearch)
    {
        $this->lastNameSearch = $lastNameSearch;

        return $this;
    }

    /**
     * Get lastNameSearch
     *
     * @return string 
     */
    public function getLastNameSearch()
    {
        return $this->lastNameSearch;
    }

    /**
     * Set initials
     *
     * @param string $initials
     * @return GtcwVMentorAdmin
     */
    public function setInitials($initials)
    {
        $this->initials = $initials;

        return $this;
    }

    /**
     * Get initials
     *
     * @return string 
     */
    public function getInitials()
    {
        return $this->initials;
    }

    /**
     * Set jobTitle
     *
     * @param string $jobTitle
     * @return GtcwVMentorAdmin
     */
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * Get jobTitle
     *
     * @return string 
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return GtcwVMentorAdmin
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set previousLastName
     *
     * @param string $previousLastName
     * @return GtcwVMentorAdmin
     */
    public function setPreviousLastName($previousLastName)
    {
        $this->previousLastName = $previousLastName;

        return $this;
    }

    /**
     * Get previousLastName
     *
     * @return string 
     */
    public function getPreviousLastName()
    {
        return $this->previousLastName;
    }

    /**
     * Set disabled
     *
     * @param string $disabled
     * @return GtcwVMentorAdmin
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * Get disabled
     *
     * @return string 
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * Set niNumber
     *
     * @param string $niNumber
     * @return GtcwVMentorAdmin
     */
    public function setNiNumber($niNumber)
    {
        $this->niNumber = $niNumber;

        return $this;
    }

    /**
     * Get niNumber
     *
     * @return string 
     */
    public function getNiNumber()
    {
        return $this->niNumber;
    }

    /**
     * Set addressLine2
     *
     * @param string $addressLine2
     * @return GtcwVMentorAdmin
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
     * @return GtcwVMentorAdmin
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
     * Set town
     *
     * @param string $town
     * @return GtcwVMentorAdmin
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
     * @return GtcwVMentorAdmin
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
     * Set emailAddress
     *
     * @param string $emailAddress
     * @return GtcwVMentorAdmin
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
     * @var integer
     */
    private $menStatusId;

    /**
     * @var string
     */
    private $menStatusCode;

    /**
     * @var string
     */
    private $menStatusName;


    /**
     * Set menStatusId
     *
     * @param integer $menStatusId
     * @return GtcwVMentorAdmin
     */
    public function setMenStatusId($menStatusId)
    {
        $this->menStatusId = $menStatusId;

        return $this;
    }

    /**
     * Get menStatusId
     *
     * @return integer 
     */
    public function getMenStatusId()
    {
        return $this->menStatusId;
    }

    /**
     * Set menStatusCode
     *
     * @param string $menStatusCode
     * @return GtcwVMentorAdmin
     */
    public function setMenStatusCode($menStatusCode)
    {
        $this->menStatusCode = $menStatusCode;

        return $this;
    }

    /**
     * Get menStatusCode
     *
     * @return string 
     */
    public function getMenStatusCode()
    {
        return $this->menStatusCode;
    }

    /**
     * Set menStatusName
     *
     * @param string $menStatusName
     * @return GtcwVMentorAdmin
     */
    public function setMenStatusName($menStatusName)
    {
        $this->menStatusName = $menStatusName;

        return $this;
    }

    /**
     * Get menStatusName
     *
     * @return string 
     */
    public function getMenStatusName()
    {
        return $this->menStatusName;
    }
}
