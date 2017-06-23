<?php

namespace ESERV\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GtcwVItetQual
 */
class GtcwVItetQual
{
    /**
     * @var integer
     */
    private $dtindex;

    /**
     * @var integer
     */
    private $contactQualificationId;

    /**
     * @var integer
     */
    private $contactId;

    /**
     * @var \DateTime
     */
    private $exitAcademicYear;

    /**
     * @var string
     */
    private $qualification;

    /**
     * @var string
     */
    private $establishmentCode;

    /**
     * @var string
     */
    private $organisation;

    /**
     * @var string
     */
    private $class;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $courseOutcome;

    /**
     * @var \DateTime
     */
    private $completionDate;


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
     * Set contactQualificationId
     *
     * @param integer $contactQualificationId
     * @return GtcwVItetQual
     */
    public function setContactQualificationId($contactQualificationId)
    {
        $this->contactQualificationId = $contactQualificationId;

        return $this;
    }

    /**
     * Get contactQualificationId
     *
     * @return integer 
     */
    public function getContactQualificationId()
    {
        return $this->contactQualificationId;
    }

    /**
     * Set contactId
     *
     * @param integer $contactId
     * @return GtcwVItetQual
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
     * Set exitAcademicYear
     *
     * @param \DateTime $exitAcademicYear
     * @return GtcwVItetQual
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
     * Set qualification
     *
     * @param string $qualification
     * @return GtcwVItetQual
     */
    public function setQualification($qualification)
    {
        $this->qualification = $qualification;

        return $this;
    }

    /**
     * Get qualification
     *
     * @return string 
     */
    public function getQualification()
    {
        return $this->qualification;
    }

    /**
     * Set establishmentCode
     *
     * @param string $establishmentCode
     * @return GtcwVItetQual
     */
    public function setEstablishmentCode($establishmentCode)
    {
        $this->establishmentCode = $establishmentCode;

        return $this;
    }

    /**
     * Get establishmentCode
     *
     * @return string 
     */
    public function getEstablishmentCode()
    {
        return $this->establishmentCode;
    }

    /**
     * Set organisation
     *
     * @param string $organisation
     * @return GtcwVItetQual
     */
    public function setOrganisation($organisation)
    {
        $this->organisation = $organisation;

        return $this;
    }

    /**
     * Get organisation
     *
     * @return string 
     */
    public function getOrganisation()
    {
        return $this->organisation;
    }

    /**
     * Set class
     *
     * @param string $class
     * @return GtcwVItetQual
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return string 
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return GtcwVItetQual
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set courseOutcome
     *
     * @param string $courseOutcome
     * @return GtcwVItetQual
     */
    public function setCourseOutcome($courseOutcome)
    {
        $this->courseOutcome = $courseOutcome;

        return $this;
    }

    /**
     * Get courseOutcome
     *
     * @return string 
     */
    public function getCourseOutcome()
    {
        return $this->courseOutcome;
    }

    /**
     * Set completionDate
     *
     * @param \DateTime $completionDate
     * @return GtcwVItetQual
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
     * @var string
     */
    private $verified;
    
    /**
     * Set verified
     *
     * @param string $verified
     * @return GtcwVItetQual
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }

    /**
     * Get verified
     *
     * @return string 
     */
    public function getVerified()
    {
        return $this->verified;
    }
    
    /**
     * @var \DateTime
     */
    private $verifiedDate;
    
    /**
     * Set verifiedDate
     *
     * @param \DateTime $verifiedDate
     * @return GtcwVItetQual
     */
    public function setVerifiedDate($verifiedDate)
    {
        $this->verifiedDate = $verifiedDate;

        return $this;
    }

    /**
     * Get verifiedDate
     *
     * @return \DateTime  
     */
    public function getVerifiedDate()
    {
        return $this->verifiedDate;
    }
    /**
     * @var string
     */
    private $ageFromName;

    /**
     * @var string
     */
    private $ageToName;

    /**
     * @var string
     */
    private $ageSpecFromName;

    /**
     * @var string
     */
    private $ageSpecToName;


    /**
     * Set ageFromName
     *
     * @param string $ageFromName
     * @return GtcwVItetQual
     */
    public function setAgeFromName($ageFromName)
    {
        $this->ageFromName = $ageFromName;

        return $this;
    }

    /**
     * Get ageFromName
     *
     * @return string 
     */
    public function getAgeFromName()
    {
        return $this->ageFromName;
    }

    /**
     * Set ageToName
     *
     * @param string $ageToName
     * @return GtcwVItetQual
     */
    public function setAgeToName($ageToName)
    {
        $this->ageToName = $ageToName;

        return $this;
    }

    /**
     * Get ageToName
     *
     * @return string 
     */
    public function getAgeToName()
    {
        return $this->ageToName;
    }

    /**
     * Set ageSpecFromName
     *
     * @param string $ageSpecFromName
     * @return GtcwVItetQual
     */
    public function setAgeSpecFromName($ageSpecFromName)
    {
        $this->ageSpecFromName = $ageSpecFromName;

        return $this;
    }

    /**
     * Get ageSpecFromName
     *
     * @return string 
     */
    public function getAgeSpecFromName()
    {
        return $this->ageSpecFromName;
    }

    /**
     * Set ageSpecToName
     *
     * @param string $ageSpecToName
     * @return GtcwVItetQual
     */
    public function setAgeSpecToName($ageSpecToName)
    {
        $this->ageSpecToName = $ageSpecToName;

        return $this;
    }

    /**
     * Get ageSpecToName
     *
     * @return string 
     */
    public function getAgeSpecToName()
    {
        return $this->ageSpecToName;
    }
}
