<?php

namespace ESERV\MAIN\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 */
class Person
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $middleName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $initials;

    /**
     * @var \DateTime
     */
    private $dateOfBirth;

    /**
     * @var string
     */
    private $jobTitle;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $createdBy;

    /**
     * @var integer
     */
    private $updatedBy;

    /**
     * @var \ESERV\MAIN\ContactBundle\Entity\Contact
     */
    private $contact;

    /**
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $titleAppCode;


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
     * Set firstName
     *
     * @param string $firstName
     * @return Person
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
     * Set middleName
     *
     * @param string $middleName
     * @return Person
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
     * Set lastName
     *
     * @param string $lastName
     * @return Person
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
     * Set initials
     *
     * @param string $initials
     * @return Person
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
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     * @return Person
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
     * Set jobTitle
     *
     * @param string $jobTitle
     * @return Person
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
     * @return Person
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Person
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Person
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
     * Set createdBy
     *
     * @param integer $createdBy
     * @return Person
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
     * Set updatedBy
     *
     * @param integer $updatedBy
     * @return Person
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
     * Set contact
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\Contact $contact
     * @return Person
     */
    public function setContact(\ESERV\MAIN\ContactBundle\Entity\Contact $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\Contact 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set titleAppCode
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $titleAppCode
     * @return Person
     */
    public function setTitleAppCode(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $titleAppCode = null)
    {
        $this->titleAppCode = $titleAppCode;

        return $this;
    }

    /**
     * Get titleAppCode
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getTitleAppCode()
    {
        return $this->titleAppCode;
    }
    /**
     * @var string
     */
    private $lastNameSearch;

    /**
     * @var string
     */
    private $previousLastName;

    /**
     * @var string
     */
    private $referenceNo;

    /**
     * @var string
     */
    private $disabled;

    /**
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $title;

    /**
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $nationality;

    /**
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $nationalen;

    /**
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $ethnicGroup;


    /**
     * Set lastNameSearch
     *
     * @param string $lastNameSearch
     * @return Person
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
     * Set previousLastName
     *
     * @param string $previousLastName
     * @return Person
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
     * Set referenceNo
     *
     * @param string $referenceNo
     * @return Person
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
     * Set disabled
     *
     * @param string $disabled
     * @return Person
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
     * Set title
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\Title $title
     * @return Person
     */
    public function setTitle(\ESERV\MAIN\SystemConfigBundle\Entity\Title $title = null)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\Title 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set nationality
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $nationality
     * @return Person
     */
    public function setNationality(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $nationality = null)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set nationalen
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $nationalen
     * @return Person
     */
    public function setNationalen(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $nationalen = null)
    {
        $this->nationalen = $nationalen;

        return $this;
    }

    /**
     * Get nationalen
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getNationalen()
    {
        return $this->nationalen;
    }

    /**
     * Set ethnicGroup
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $ethnicGroup
     * @return Person
     */
    public function setEthnicGroup(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $ethnicGroup = null)
    {
        $this->ethnicGroup = $ethnicGroup;

        return $this;
    }

    /**
     * Get ethnicGroup
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getEthnicGroup()
    {
        return $this->ethnicGroup;
    }
    
    /**
     * @var \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Address
     */
    public $address;
    
    /**
     * Get address
     *
     * @return \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Address
     */
    public function getAddress()
    {
        return $this->address;
    }
    
    /**
     * Set address
     *
     * @param \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Address $address
     * @return Address
     */
    public function setAddress(\ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Address $address = null)
    {
        $this->address = $address;
        
        return $this;
    }
    
    
    /**
     * @var \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone
     */
    public $phone;
    
    /**
     * Get phone
     *
     * @return \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone
     */
    public function getPhone()
    {
        return $this->phone;
    }
    
    /**
     * Set phone
     *
     * @param \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone $phone
     * @return Phone
     */
    public function setPhone(\ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone $phone = null)
    {
        $this->phone = $phone;
        
        return $this;
    }
    
    /**
     * @var \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Email
     */
    public $email;
    
    /**
     * Get email
     *
     * @return \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Email
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Set email
     *
     * @param \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Email $email
     * @return Email
     */
    public function setEmail(\ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Email $email = null)
    {
        $this->email = $email;
        
        return $this;
    }
    
    public function getPersonByReferenceNo($em, $ref_no){
          $qb = $em->createQueryBuilder();
          $result = $qb->select('p.referenceNo')
             ->from('ESERVMAINContactBundle:Person', 'p')
             ->where('p.referenceNo = :ref_no')   
             ->setParameter('ref_no', $ref_no)
             ->getQuery()
             ->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_ARRAY); 
          return $result;
    }
    
    /**
     * @var \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone
     */
    public $mobile;
    
    /**
     * Get phone
     *
     * @return \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone
     */
    public function getMobile()
    {
        return $this->mobile;
    }
    
    /**
     * Set phone
     *
     * @param \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone $mobile
     * @return Phone
     */
    public function setMobile(\ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone $mobile = null)
    {
        $this->mobile = $mobile;
        
        return $this;
    }
        /**
     * @var string
     */
    private $niNumber;


    /**
     * Set niNumber
     *
     * @param string $niNumber
     * @return Person
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
}
