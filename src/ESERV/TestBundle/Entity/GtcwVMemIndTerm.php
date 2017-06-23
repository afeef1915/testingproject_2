<?php

namespace ESERV\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GtcwVMemIndTerm
 */
class GtcwVMemIndTerm
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
    private $gtcwMemIndTermId;

    /**
     * @var \DateTime
     */
    private $startDate;

    /**
     * @var \DateTime
     */
    private $completionDate;

    /**
     * @var \DateTime
     */
    private $leaveDate;

    /**
     * @var string
     */
    private $agencyName;

    /**
     * @var string
     */
    private $bodyName;

    /**
     * @var string
     */
    private $schoolName;

    /**
     * @var integer
     */
    private $sessionsCompleted;

    /**
     * @var string
     */
    private $inductionRoute;
    
    /**
     * @var float
     */
    private $fundingAmount;


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
     * @return GtcwVMemIndTerm
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
     * Set gtcwMemIndTermId
     *
     * @param integer $gtcwMemIndTermId
     * @return GtcwVMemIndTerm
     */
    public function setGtcwMemIndTermId($gtcwMemIndTermId)
    {
        $this->gtcwMemIndTermId = $gtcwMemIndTermId;

        return $this;
    }

    /**
     * Get gtcwMemIndTermId
     *
     * @return integer 
     */
    public function getGtcwMemIndTermId()
    {
        return $this->gtcwMemIndTermId;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return GtcwVMemIndTerm
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set completionDate
     *
     * @param \DateTime $completionDate
     * @return GtcwVMemIndTerm
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
     * Set leaveDate
     *
     * @param \DateTime $leaveDate
     * @return GtcwVMemIndTerm
     */
    public function setLeaveDate($leaveDate)
    {
        $this->leaveDate = $leaveDate;

        return $this;
    }

    /**
     * Get leaveDate
     *
     * @return \DateTime 
     */
    public function getLeaveDate()
    {
        return $this->leaveDate;
    }

    /**
     * Set agencyName
     *
     * @param string $agencyName
     * @return GtcwVMemIndTerm
     */
    public function setAgencyName($agencyName)
    {
        $this->agencyName = $agencyName;

        return $this;
    }

    /**
     * Get agencyName
     *
     * @return string 
     */
    public function getAgencyName()
    {
        return $this->agencyName;
    }

    /**
     * Set bodyName
     *
     * @param string $bodyName
     * @return GtcwVMemIndTerm
     */
    public function setBodyName($bodyName)
    {
        $this->bodyName = $bodyName;

        return $this;
    }

    /**
     * Get bodyName
     *
     * @return string 
     */
    public function getBodyName()
    {
        return $this->bodyName;
    }

    /**
     * Set schoolName
     *
     * @param string $schoolName
     * @return GtcwVMemIndTerm
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
     * Set sessionsCompleted
     *
     * @param integer $sessionsCompleted
     * @return GtcwVMemIndTerm
     */
    public function setSessionsCompleted($sessionsCompleted)
    {
        $this->sessionsCompleted = $sessionsCompleted;

        return $this;
    }

    /**
     * Get sessionsCompleted
     *
     * @return integer 
     */
    public function getSessionsCompleted()
    {
        return $this->sessionsCompleted;
    }

    /**
     * Set inductionRoute
     *
     * @param string $inductionRoute
     * @return GtcwVMemIndTerm
     */
    public function setInductionRoute($inductionRoute)
    {
        $this->inductionRoute = $inductionRoute;

        return $this;
    }

    /**
     * Get inductionRoute
     *
     * @return string 
     */
    public function getInductionRoute()
    {
        return $this->inductionRoute;
    }
    /**
     * @var string
     */
    private $extLength;


    /**
     * Set extLength
     *
     * @param string $extLength
     * @return GtcwVMemIndTerm
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
     * Set fundingAmount
     *
     * @param float $fundingAmount
     * @return GtcwVMemIndTerm
     */
    public function setFundingAmount($fundingAmount)
    {
        $this->fundingAmount = $fundingAmount;

        return $this;
    }

    /**
     * Get fundingAmount
     *
     * @return float 
     */
    public function getFundingAmount()
    {
        return $this->fundingAmount;
    }
    /**
     * @var integer
     */
    private $abscenses;


    /**
     * Set abscenses
     *
     * @param integer $abscenses
     * @return GtcwVMemIndTerm
     */
    public function setAbscenses($abscenses)
    {
        $this->abscenses = $abscenses;

        return $this;
    }

    /**
     * Get abscenses
     *
     * @return integer 
     */
    public function getAbscenses()
    {
        return $this->abscenses;
    }
}
