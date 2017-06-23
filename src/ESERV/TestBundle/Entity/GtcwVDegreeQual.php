<?php

namespace ESERV\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GtcwVDegreeQual
 */
class GtcwVDegreeQual
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
     * @var integer
     */
    private $yearOfAward;

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
     * @return GtcwVDegreeQual
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
     * @return GtcwVDegreeQual
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
     * Set yearOfAward
     *
     * @param \DateTime $yearOfAward
     * @return GtcwVDegreeQual
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
     * Set qualification
     *
     * @param string $qualification
     * @return GtcwVDegreeQual
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
     * @return GtcwVDegreeQual
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
     * @return GtcwVDegreeQual
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
     * @return GtcwVDegreeQual
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
     * @return GtcwVDegreeQual
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
     * @var string
     */
    private $verified;
    
    /**
     * Set verified
     *
     * @param string $verified
     * @return GtcwVDegreeQual
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
     * @return GtcwVDegreeQual
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
}
