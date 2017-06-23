<?php

namespace ESERV\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GtcwVMemMepDetail
 */
class GtcwVMemMepDetail
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
    private $gtcwMemMepDetailId;

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
     * @var integer
     */
    private $bodyId;
    
    /**
     * @var integer
     */
    private $bodyContactId;
    
    /**
     * @var string
     */
    private $bodyName;
        
    /**
     * @var integer
     */    
    private $schoolId;
    
    /**
     * @var integer
     */
    private $schoolContactId;
    
    /**
     * @var string
     */
    private $schoolName;

    /**
     * @var string
     */
    private $externalMentor;

    /**
     * @var integer
     */
    private $externalMentorContactId;


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
     * @return GtcwVMemMepDetail
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
     * Set gtcwMemMepDetailId
     *
     * @param integer $gtcwMemMepDetailId
     * @return GtcwVMemMepDetail
     */
    public function setGtcwMemMepDetailId($gtcwMemMepDetailId)
    {
        $this->gtcwMemMepDetailId = $gtcwMemMepDetailId;

        return $this;
    }

    /**
     * Get gtcwMemMepDetailId
     *
     * @return integer 
     */
    public function getGtcwMemMepDetailId()
    {
        return $this->gtcwMemMepDetailId;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return GtcwVMemMepDetail
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
     * @return GtcwVMemMepDetail
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
     * @return GtcwVMemMepDetail
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
     * Set bodyId
     *
     * @param integer $bodyId
     * @return GtcwVMemMepDetail
     */
    public function setBodyId($bodyId)
    {
        $this->bodyId = $bodyId;

        return $this;
    }

    /**
     * Get bodyId
     *
     * @return integer 
     */
    public function getBodyId()
    {
        return $this->bodyId;
    }
    
    /**
     * Set bodyId
     *
     * @param integer $bodyId
     * @return GtcwVMemMepDetail
     */
    public function setBodyContactId($bodyContactId)
    {
        $this->bodyContactId = $bodyContactId;

        return $this;
    }

    /**
     * Get bodyContactId
     *
     * @return integer 
     */
    public function getBodyContactId()
    {
        return $this->bodyContactId;
    }
    
    /**
     * Set bodyName
     *
     * @param string $bodyName
     * @return GtcwVMemMepDetail
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
     * Set schoolId
     *
     * @param integer $schoolId
     * @return GtcwVMemMepDetail
     */
    public function setSchoolId($schoolId)
    {
        $this->schoolId = $schoolId;

        return $this;
    }

    /**
     * Get schoolId
     *
     * @return integer 
     */
    public function getSchoolId()
    {
        return $this->schoolId;
    }
    
    /**
     * Set schoolContactId
     *
     * @param integer $schoolContactId
     * @return GtcwVMemMepDetail
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
     * Set schoolName
     *
     * @param string $schoolName
     * @return GtcwVMemMepDetail
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
     * Set externalMentor
     *
     * @param string $externalMentor
     * @return GtcwVMemMepDetail
     */
    public function setExternalMentor($externalMentor)
    {
        $this->externalMentor = $externalMentor;

        return $this;
    }

    /**
     * Get externalMentor
     *
     * @return string 
     */
    public function getExternalMentor()
    {
        return $this->externalMentor;
    }

    /**
     * Set externalMentorContactId
     *
     * @param integer $externalMentorContactId
     * @return GtcwVMemMepDetail
     */
    public function setExternalMentorContactId($externalMentorContactId)
    {
        $this->externalMentorContactId = $externalMentorContactId;

        return $this;
    }

    /**
     * Get externalMentorContactId
     *
     * @return integer 
     */
    public function getExternalMentorContactId()
    {
        return $this->externalMentorContactId;
    }
}
