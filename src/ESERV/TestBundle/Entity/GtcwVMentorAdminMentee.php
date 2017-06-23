<?php

namespace ESERV\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GtcwVMentorAdminMentee
 */
class GtcwVMentorAdminMentee
{
    /**
     * @var integer
     */
    private $dtindex;

    /**
     * @var integer
     */
    private $gtcwMentorTeacherId;

    /**
     * @var integer
     */
    private $gtcwMentorContactId;

    /**
     * @var integer
     */
    private $gtcwMentorTeachConId;
    
    /**
     * @var integer
     */
    private $menteeContactId;

    /**
     * @var string
     */
    private $referenceNo;

    /**
     * @var string
     */
    private $fullName;
    
    /**
     * @var integer
     */
    private $laContactId;

    /**
     * @var string
     */
    private $la;
    
    /**
     * @var integer
     */
    private $schoolContactId;

    /**
     * @var string
     */
    private $school;
    
    /**
     * @var integer
     */
    private $indRouteId;
    
    /**
     * @var string
     */
    private $indRouteName;

    /**
     * @var \DateTime
     */
    private $startDate;

    /**
     * @var \DateTime
     */
    private $endDate;


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
     * Set gtcwMentorTeacherId
     *
     * @param integer $gtcwMentorTeacherId
     * @return GtcwVMentorAdminMentee
     */
    public function setGtcwMentorTeacherId($gtcwMentorTeacherId)
    {
        $this->gtcwMentorTeacherId = $gtcwMentorTeacherId;

        return $this;
    }

    /**
     * Get gtcwMentorTeacherId
     *
     * @return integer 
     */
    public function getGtcwMentorTeacherId()
    {
        return $this->gtcwMentorTeacherId;
    }

    /**
     * Set gtcwMentorContactId
     *
     * @param integer $gtcwMentorContactId
     * @return GtcwVMentorAdminMentee
     */
    public function setGtcwMentorContactId($gtcwMentorContactId)
    {
        $this->gtcwMentorContactId = $gtcwMentorContactId;

        return $this;
    }

    /**
     * Get gtcwMentorContactId
     *
     * @return integer 
     */
    public function getGtcwMentorContactId()
    {
        return $this->gtcwMentorContactId;
    }

    /**
     * Set gtcwMentorTeachConId
     *
     * @param integer $gtcwMentorTeachConId
     * @return GtcwVMentorAdminMentee
     */
    public function setGtcwMentorTeachConId($gtcwMentorTeachConId)
    {
        $this->gtcwMentorTeachConId = $gtcwMentorTeachConId;

        return $this;
    }

    /**
     * Get gtcwMentorTeachConId
     *
     * @return integer 
     */
    public function getGtcwMentorTeachConId()
    {
        return $this->gtcwMentorTeachConId;
    }
    
    /**
     * Set menteeContactId
     *
     * @param integer $menteeContactId
     * @return GtcwVMentorAdminMentee
     */
    public function setMenteeContactId($menteeContactId)
    {
        $this->menteeContactId = $menteeContactId;

        return $this;
    }

    /**
     * Get menteeContactId
     *
     * @return integer 
     */
    public function getMenteeContactId()
    {
        return $this->menteeContactId;
    }

    /**
     * Set referenceNo
     *
     * @param string $referenceNo
     * @return GtcwVMentorAdminMentee
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
     * Set fullName
     *
     * @param string $fullName
     * @return GtcwVMentorAdminMentee
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
     * Set laContactId
     *
     * @param integer $laContactId
     * @return GtcwVMentorAdminMentee
     */
    public function setLaContactId($laContactId)
    {
        $this->laContactId = $laContactId;

        return $this;
    }

    /**
     * Get laContactId
     *
     * @return integer 
     */
    public function getLaContactId()
    {
        return $this->laContactId;
    }

    /**
     * Set la
     *
     * @param string $la
     * @return GtcwVMentorAdminMentee
     */
    public function setLa($la)
    {
        $this->la = $la;

        return $this;
    }

    /**
     * Get la
     *
     * @return string 
     */
    public function getLa()
    {
        return $this->la;
    }
    
    /**
     * Set schoolContactId
     *
     * @param integer $schoolContactId
     * @return GtcwVMentorAdminMentee
     */
    public function setSchoolContactId($schoolContactId)
    {
        $this->schoolContactId = $schoolContactId;

        return $this;
    }

    /**
     * Get schoolContactId
     *
     * @return integer 
     */
    public function getSchoolContactId()
    {
        return $this->schoolContactId;
    }

    /**
     * Set school
     *
     * @param string $school
     * @return GtcwVMentorAdminMentee
     */
    public function setSchool($school)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school
     *
     * @return string 
     */
    public function getSchool()
    {
        return $this->school;
    }
    
    /**
     * Set indRouteId
     *
     * @param integer $indRouteId
     * @return GtcwVMentorAdminMentee
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
     * Set indRouteName
     *
     * @param string $indRouteName
     * @return GtcwVMentorAdminMentee
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
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return GtcwVMentorAdminMentee
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
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return GtcwVMentorAdminMentee
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
}
