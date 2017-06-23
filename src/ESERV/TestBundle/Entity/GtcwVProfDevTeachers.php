<?php

namespace ESERV\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GtcwVSchoolTeachers
 */
class GtcwVProfDevTeachers
{   
    
    /**
     * @var integer
     */
    private $person_id;

    /**
     * @var integer
     */
    private $contact_id;

    /**
     * @var string
     */
    private $first_name;

    /**
     * @var string
     */
    private $last_name;

    /**
     * @var string
     */
    private $reference_no;

    /**
     * @var \DateTime
     */
    private $qts_date;

    /**
     * @var \DateTime
     */
    private $date_of_birth;

    /**
     * @var string
     */
    private $address_line1;

    /**
     * @var string
     */
    private $postcode;

    /**
     * @var string
     */
    private $contact_status;

    /**
     * @var string
     */
    private $contact_status_code;

    /**
     * @var string
     */
    private $middle_name;

    /**
     * @var string
     */
    private $last_name_search;

    /**
     * @var string
     */
    private $initials;

    /**
     * @var string
     */
    private $job_title;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var string
     */
    private $previous_last_name;

    /**
     * @var string
     */
    private $disabled;

    /**
     * @var string
     */
    private $ni_number;

    /**
     * @var string
     */
    private $address_line2;

    /**
     * @var string
     */
    private $address_line3;

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
    private $email_address;

    /**
     * @var string
     */
    private $reg_category;

    /**
     * @var string
     */
    private $reg_category_search;

    /**
     * @var string
     */
    private $reg_status;


    /**
     * Get person_id
     *
     * @return integer 
     */
    public function getPersonId()
    {
        return $this->person_id;
    }

    /**
     * Set contact_id
     *
     * @param integer $contactId
     * @return GtcwVProfDevTeachers
     */
    public function setContactId($contactId)
    {
        $this->contact_id = $contactId;

        return $this;
    }

    /**
     * Get contact_id
     *
     * @return integer 
     */
    public function getContactId()
    {
        return $this->contact_id;
    }

    /**
     * Set first_name
     *
     * @param string $firstName
     * @return GtcwVProfDevTeachers
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get first_name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return GtcwVProfDevTeachers
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get last_name
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set reference_no
     *
     * @param string $referenceNo
     * @return GtcwVProfDevTeachers
     */
    public function setReferenceNo($referenceNo)
    {
        $this->reference_no = $referenceNo;

        return $this;
    }

    /**
     * Get reference_no
     *
     * @return string 
     */
    public function getReferenceNo()
    {
        return $this->reference_no;
    }

    /**
     * Set qts_date
     *
     * @param \DateTime $qtsDate
     * @return GtcwVProfDevTeachers
     */
    public function setQtsDate($qtsDate)
    {
        $this->qts_date = $qtsDate;

        return $this;
    }

    /**
     * Get qts_date
     *
     * @return \DateTime 
     */
    public function getQtsDate()
    {
        return $this->qts_date;
    }

    /**
     * Set date_of_birth
     *
     * @param \DateTime $dateOfBirth
     * @return GtcwVProfDevTeachers
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->date_of_birth = $dateOfBirth;

        return $this;
    }

    /**
     * Get date_of_birth
     *
     * @return \DateTime 
     */
    public function getDateOfBirth()
    {
        return $this->date_of_birth;
    }

    /**
     * Set address_line1
     *
     * @param string $addressLine1
     * @return GtcwVProfDevTeachers
     */
    public function setAddressLine1($addressLine1)
    {
        $this->address_line1 = $addressLine1;

        return $this;
    }

    /**
     * Get address_line1
     *
     * @return string 
     */
    public function getAddressLine1()
    {
        return $this->address_line1;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     * @return GtcwVProfDevTeachers
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
     * Set contact_status
     *
     * @param string $contactStatus
     * @return GtcwVProfDevTeachers
     */
    public function setContactStatus($contactStatus)
    {
        $this->contact_status = $contactStatus;

        return $this;
    }

    /**
     * Get contact_status
     *
     * @return string 
     */
    public function getContactStatus()
    {
        return $this->contact_status;
    }

    /**
     * Set contact_status_code
     *
     * @param string $contactStatusCode
     * @return GtcwVProfDevTeachers
     */
    public function setContactStatusCode($contactStatusCode)
    {
        $this->contact_status_code = $contactStatusCode;

        return $this;
    }

    /**
     * Get contact_status_code
     *
     * @return string 
     */
    public function getContactStatusCode()
    {
        return $this->contact_status_code;
    }

    /**
     * Set middle_name
     *
     * @param string $middleName
     * @return GtcwVProfDevTeachers
     */
    public function setMiddleName($middleName)
    {
        $this->middle_name = $middleName;

        return $this;
    }

    /**
     * Get middle_name
     *
     * @return string 
     */
    public function getMiddleName()
    {
        return $this->middle_name;
    }

    /**
     * Set last_name_search
     *
     * @param string $lastNameSearch
     * @return GtcwVProfDevTeachers
     */
    public function setLastNameSearch($lastNameSearch)
    {
        $this->last_name_search = $lastNameSearch;

        return $this;
    }

    /**
     * Get last_name_search
     *
     * @return string 
     */
    public function getLastNameSearch()
    {
        return $this->last_name_search;
    }

    /**
     * Set initials
     *
     * @param string $initials
     * @return GtcwVProfDevTeachers
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
     * Set job_title
     *
     * @param string $jobTitle
     * @return GtcwVProfDevTeachers
     */
    public function setJobTitle($jobTitle)
    {
        $this->job_title = $jobTitle;

        return $this;
    }

    /**
     * Get job_title
     *
     * @return string 
     */
    public function getJobTitle()
    {
        return $this->job_title;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return GtcwVProfDevTeachers
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
     * Set previous_last_name
     *
     * @param string $previousLastName
     * @return GtcwVProfDevTeachers
     */
    public function setPreviousLastName($previousLastName)
    {
        $this->previous_last_name = $previousLastName;

        return $this;
    }

    /**
     * Get previous_last_name
     *
     * @return string 
     */
    public function getPreviousLastName()
    {
        return $this->previous_last_name;
    }

    /**
     * Set disabled
     *
     * @param string $disabled
     * @return GtcwVProfDevTeachers
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
     * Set ni_number
     *
     * @param string $niNumber
     * @return GtcwVProfDevTeachers
     */
    public function setNiNumber($niNumber)
    {
        $this->ni_number = $niNumber;

        return $this;
    }

    /**
     * Get ni_number
     *
     * @return string 
     */
    public function getNiNumber()
    {
        return $this->ni_number;
    }

    /**
     * Set address_line2
     *
     * @param string $addressLine2
     * @return GtcwVProfDevTeachers
     */
    public function setAddressLine2($addressLine2)
    {
        $this->address_line2 = $addressLine2;

        return $this;
    }

    /**
     * Get address_line2
     *
     * @return string 
     */
    public function getAddressLine2()
    {
        return $this->address_line2;
    }

    /**
     * Set address_line3
     *
     * @param string $addressLine3
     * @return GtcwVProfDevTeachers
     */
    public function setAddressLine3($addressLine3)
    {
        $this->address_line3 = $addressLine3;

        return $this;
    }

    /**
     * Get address_line3
     *
     * @return string 
     */
    public function getAddressLine3()
    {
        return $this->address_line3;
    }

    /**
     * Set town
     *
     * @param string $town
     * @return GtcwVProfDevTeachers
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
     * @return GtcwVProfDevTeachers
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
     * Set email_address
     *
     * @param string $emailAddress
     * @return GtcwVProfDevTeachers
     */
    public function setEmailAddress($emailAddress)
    {
        $this->email_address = $emailAddress;

        return $this;
    }

    /**
     * Get email_address
     *
     * @return string 
     */
    public function getEmailAddress()
    {
        return $this->email_address;
    }

    /**
     * Set reg_category
     *
     * @param string $regCategory
     * @return GtcwVProfDevTeachers
     */
    public function setRegCategory($regCategory)
    {
        $this->reg_category = $regCategory;

        return $this;
    }

    /**
     * Get reg_category
     *
     * @return string 
     */
    public function getRegCategory()
    {
        return $this->reg_category;
    }

    /**
     * Set reg_category_search
     *
     * @param string $regCategorySearch
     * @return GtcwVProfDevTeachers
     */
    public function setRegCategorySearch($regCategorySearch)
    {
        $this->reg_category_search = $regCategorySearch;

        return $this;
    }

    /**
     * Get reg_category_search
     *
     * @return string 
     */
    public function getRegCategorySearch()
    {
        return $this->reg_category_search;
    }

    /**
     * Set reg_status
     *
     * @param string $regStatus
     * @return GtcwVProfDevTeachers
     */
    public function setRegStatus($regStatus)
    {
        $this->reg_status = $regStatus;

        return $this;
    }

    /**
     * Get reg_status
     *
     * @return string 
     */
    public function getRegStatus()
    {
        return $this->reg_status;
    }
}
