<?php

namespace ESERV\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GtcwVEmpDetailHist
 */
class GtcwVEmpDetailHist
{

    /**
     * @var integer
     */
    private $employmentDetailHistId;

    /**
     * @var integer
     */
    private $dtindex;

    /**
     * @var integer
     */
    private $employmentDetailId;

    /**
     * @var string
     */
    private $employmentDescription;

    /**
     * @var string
     */
    private $employer;

    /**
     * @var string
     */
    private $otherEmployer;

    /**
     * @var string
     */
    private $school;

    /**
     * @var string
     */
    private $hours;

    /**
     * @var string
     */
    private $primaryRecord;

    /**
     * @var \DateTime
     */
    private $startDate;

    /**
     * @var \DateTime
     */
    private $endDate;

    /**
     * @var string
     */
    private $empLevel;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $createdBy;


    /**
     * Get employmentDetailHistId
     *
     * @return integer 
     */
    public function getEmploymentDetailHistId()
    {
        return $this->employmentDetailHistId;
    }

    /**
     * Set dtindex
     *
     * @param integer $dtindex
     * @return GtcwVEmpDetailHist
     */
    public function setDtindex($dtindex)
    {
        $this->dtindex = $dtindex;

        return $this;
    }

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
     * Set employmentDetailId
     *
     * @param integer $employmentDetailId
     * @return GtcwVEmpDetailHist
     */
    public function setEmploymentDetailId($employmentDetailId)
    {
        $this->employmentDetailId = $employmentDetailId;

        return $this;
    }

    /**
     * Get employmentDetailId
     *
     * @return integer 
     */
    public function getEmploymentDetailId()
    {
        return $this->employmentDetailId;
    }

    /**
     * Set employmentDescription
     *
     * @param string $employmentDescription
     * @return GtcwVEmpDetailHist
     */
    public function setEmploymentDescription($employmentDescription)
    {
        $this->employmentDescription = $employmentDescription;

        return $this;
    }

    /**
     * Get employmentDescription
     *
     * @return string 
     */
    public function getEmploymentDescription()
    {
        return $this->employmentDescription;
    }

    /**
     * Set employer
     *
     * @param string $employer
     * @return GtcwVEmpDetailHist
     */
    public function setEmployer($employer)
    {
        $this->employer = $employer;

        return $this;
    }

    /**
     * Get employer
     *
     * @return string 
     */
    public function getEmployer()
    {
        return $this->employer;
    }

    /**
     * Set otherEmployer
     *
     * @param string $otherEmployer
     * @return GtcwVEmpDetailHist
     */
    public function setOtherEmployer($otherEmployer)
    {
        $this->otherEmployer = $otherEmployer;

        return $this;
    }

    /**
     * Get otherEmployer
     *
     * @return string 
     */
    public function getOtherEmployer()
    {
        return $this->otherEmployer;
    }

    /**
     * Set school
     *
     * @param string $school
     * @return GtcwVEmpDetailHist
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
     * Set hours
     *
     * @param string $hours
     * @return GtcwVEmpDetailHist
     */
    public function setHours($hours)
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * Get hours
     *
     * @return string 
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Set primaryRecord
     *
     * @param string $primaryRecord
     * @return GtcwVEmpDetailHist
     */
    public function setPrimaryRecord($primaryRecord)
    {
        $this->primaryRecord = $primaryRecord;

        return $this;
    }

    /**
     * Get primaryRecord
     *
     * @return string 
     */
    public function getPrimaryRecord()
    {
        return $this->primaryRecord;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return GtcwVEmpDetailHist
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
     * @return GtcwVEmpDetailHist
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

    /**
     * Set empLevel
     *
     * @param string $empLevel
     * @return GtcwVEmpDetailHist
     */
    public function setEmpLevel($empLevel)
    {
        $this->empLevel = $empLevel;

        return $this;
    }

    /**
     * Get empLevel
     *
     * @return string 
     */
    public function getEmpLevel()
    {
        return $this->empLevel;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return GtcwVEmpDetailHist
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
     * Set createdBy
     *
     * @param string $createdBy
     * @return GtcwVEmpDetailHist
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return string 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }
}
