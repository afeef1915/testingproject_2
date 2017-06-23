<?php

namespace ESERV\MAIN\QualificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactQualification
 */
class ContactQualification
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $exitAcademicYear;

    /**
     * @var integer
     */
    private $courseLength;

    /**
     * @var \DateTime
     */
    private $yearOfAward;

    /**
     * @var \DateTime
     */
    private $completionDate;

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
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $courseOutcome;

    /**
     * @var \ESERV\MAIN\QualificationBundle\Entity\Qualification
     */
    private $qualification;

    /**
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $qualType;

    /**
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $class;

    /**
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $ageFrom;

    /**
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $ageTo;

    /**
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $ageSpecFrom;

    /**
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $ageSpecTo;

    /**
     * @var \ESERV\MAIN\ContactBundle\Entity\Contact
     */
    private $contact;

    /**
     * @var \ESERV\MAIN\QualificationBundle\Entity\Establishment
     */
    private $establishment;


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
     * Set exitAcademicYear
     *
     * @param \DateTime $exitAcademicYear
     * @return ContactQualification
     */
    public function setExitAcademicYear($exitAcademicYear)
    {
        $this->exitAcademicYear = $exitAcademicYear;

        return $this;
    }

    /**
     * Get exitAcademicYear
     *
     * @return \DateTime 
     */
    public function getExitAcademicYear()
    {
        return $this->exitAcademicYear;
    }

    /**
     * Set courseLength
     *
     * @param integer $courseLength
     * @return ContactQualification
     */
    public function setCourseLength($courseLength)
    {
        $this->courseLength = $courseLength;

        return $this;
    }

    /**
     * Get courseLength
     *
     * @return integer 
     */
    public function getCourseLength()
    {
        return $this->courseLength;
    }

    /**
     * Set yearOfAward
     *
     * @param \DateTime $yearOfAward
     * @return ContactQualification
     */
    public function setYearOfAward($yearOfAward)
    {
        $this->yearOfAward = $yearOfAward;

        return $this;
    }

    /**
     * Get yearOfAward
     *
     * @return \DateTime 
     */
    public function getYearOfAward()
    {
        return $this->yearOfAward;
    }

    /**
     * Set completionDate
     *
     * @param \DateTime $completionDate
     * @return ContactQualification
     */
    public function setCompletionDate($completionDate)
    {
        $this->completionDate = $completionDate;

        return $this;
    }

    /**
     * Get completionDate
     *
     * @return \DateTime 
     */
    public function getCompletionDate()
    {
        return $this->completionDate;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ContactQualification
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
     * @return ContactQualification
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
     * @return ContactQualification
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
     * @return ContactQualification
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
     * Set courseOutcome
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $courseOutcome
     * @return ContactQualification
     */
    public function setCourseOutcome(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $courseOutcome = null)
    {
        $this->courseOutcome = $courseOutcome;

        return $this;
    }

    /**
     * Get courseOutcome
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getCourseOutcome()
    {
        return $this->courseOutcome;
    }

    /**
     * Set qualification
     *
     * @param \ESERV\MAIN\QualificationBundle\Entity\Qualification $qualification
     * @return ContactQualification
     */
    public function setQualification(\ESERV\MAIN\QualificationBundle\Entity\Qualification $qualification = null)
    {
        $this->qualification = $qualification;

        return $this;
    }

    /**
     * Get qualification
     *
     * @return \ESERV\MAIN\QualificationBundle\Entity\Qualification 
     */
    public function getQualification()
    {
        return $this->qualification;
    }

    /**
     * Set qualType
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $qualType
     * @return ContactQualification
     */
    public function setQualType(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $qualType = null)
    {
        $this->qualType = $qualType;

        return $this;
    }

    /**
     * Get qualType
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getQualType()
    {
        return $this->qualType;
    }

    /**
     * Set class
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $class
     * @return ContactQualification
     */
    public function setClass(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $class = null)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set ageFrom
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $ageFrom
     * @return ContactQualification
     */
    public function setAgeFrom(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $ageFrom = null)
    {
        $this->ageFrom = $ageFrom;

        return $this;
    }

    /**
     * Get ageFrom
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getAgeFrom()
    {
        return $this->ageFrom;
    }

    /**
     * Set ageTo
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $ageTo
     * @return ContactQualification
     */
    public function setAgeTo(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $ageTo = null)
    {
        $this->ageTo = $ageTo;

        return $this;
    }

    /**
     * Get ageTo
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getAgeTo()
    {
        return $this->ageTo;
    }

    /**
     * Set ageSpecFrom
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $ageSpecFrom
     * @return ContactQualification
     */
    public function setAgeSpecFrom(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $ageSpecFrom = null)
    {
        $this->ageSpecFrom = $ageSpecFrom;

        return $this;
    }

    /**
     * Get ageSpecFrom
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getAgeSpecFrom()
    {
        return $this->ageSpecFrom;
    }

    /**
     * Set ageSpecTo
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $ageSpecTo
     * @return ContactQualification
     */
    public function setAgeSpecTo(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $ageSpecTo = null)
    {
        $this->ageSpecTo = $ageSpecTo;

        return $this;
    }

    /**
     * Get ageSpecTo
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getAgeSpecTo()
    {
        return $this->ageSpecTo;
    }

    /**
     * Set contact
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\Contact $contact
     * @return ContactQualification
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
     * Set establishment
     *
     * @param \ESERV\MAIN\QualificationBundle\Entity\Establishment $establishment
     * @return ContactQualification
     */
    public function setEstablishment(\ESERV\MAIN\QualificationBundle\Entity\Establishment $establishment = null)
    {
        $this->establishment = $establishment;

        return $this;
    }

    /**
     * Get establishment
     *
     * @return \ESERV\MAIN\QualificationBundle\Entity\Establishment 
     */
    public function getEstablishment()
    {
        return $this->establishment;
    }
    /**
     * @var integer
     */
    private $checkedUserId;

    /**
     * @var string
     */
    private $checked;

    /**
     * @var \DateTime
     */
    private $checkedDate;


    /**
     * Set checkedUserId
     *
     * @param integer $checkedUserId
     * @return ContactQualification
     */
    public function setCheckedUserId($checkedUserId)
    {
        $this->checkedUserId = $checkedUserId;

        return $this;
    }

    /**
     * Get checkedUserId
     *
     * @return integer 
     */
    public function getCheckedUserId()
    {
        return $this->checkedUserId;
    }

    /**
     * Set checked
     *
     * @param string $checked
     * @return ContactQualification
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;

        return $this;
    }

    /**
     * Get checked
     *
     * @return string 
     */
    public function getChecked()
    {
        return $this->checked;
    }

    /**
     * Set checkedDate
     *
     * @param \DateTime $checkedDate
     * @return ContactQualification
     */
    public function setCheckedDate($checkedDate)
    {
        $this->checkedDate = $checkedDate;

        return $this;
    }

    /**
     * Get checkedDate
     *
     * @return \DateTime 
     */
    public function getCheckedDate()
    {
        return $this->checkedDate;
    }
    
    /**
     * @var string
     */
    private $qualLevel;
    
    /**
     * Set qualLevel
     *
     * @param string $qualLevel
     * @return ContactQualification
     */
    public function setQualLevel($qualLevel)
    {
        $this->qualLevel = $qualLevel;

        return $this;
    }

    /**
     * Get qualLevel
     *
     * @return string 
     */
    public function getQualLevel()
    {
        return $this->qualLevel;
    }
}
