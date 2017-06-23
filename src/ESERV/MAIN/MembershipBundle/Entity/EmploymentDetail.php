<?php

namespace ESERV\MAIN\MembershipBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmploymentDetail
 */
class EmploymentDetail
{
    /**
     * @var integer
     */
    private $id;

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
    private $job;

    /**
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $hours;

    /**
     * @var \ESERV\MAIN\MembershipBundle\Entity\Employer
     */
    private $employer;

    /**
     * @var \ESERV\MAIN\MembershipBundle\Entity\Workplace
     */
    private $workplace;

    /**
     * @var \ESERV\MAIN\MembershipBundle\Entity\Branch
     */
    private $branch;


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
     * Set primaryRecord
     *
     * @param string $primaryRecord
     * @return EmploymentDetail
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
     * @return EmploymentDetail
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
     * @return EmploymentDetail
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return EmploymentDetail
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
     * @return EmploymentDetail
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
     * @return EmploymentDetail
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
     * @return EmploymentDetail
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
     * @return EmploymentDetail
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
     * Set job
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $job
     * @return EmploymentDetail
     */
    public function setJob(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $job = null)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set hours
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $hours
     * @return EmploymentDetail
     */
    public function setHours(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $hours = null)
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * Get hours
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Set employer
     *
     * @param \ESERV\MAIN\MembershipBundle\Entity\Employer $employer
     * @return EmploymentDetail
     */
    public function setEmployer(\ESERV\MAIN\MembershipBundle\Entity\Employer $employer = null)
    {
        $this->employer = $employer;

        return $this;
    }

    /**
     * Get employer
     *
     * @return \ESERV\MAIN\MembershipBundle\Entity\Employer
     */
    public function getEmployer()
    {
        return $this->employer;
    }

    /**
     * Set workplace
     *
     * @param \ESERV\MAIN\MembershipBundle\Entity\Workplace $workplace
     * @return EmploymentDetail
     */
    public function setWorkplace(\ESERV\MAIN\MembershipBundle\Entity\Workplace $workplace = null)
    {
        $this->workplace = $workplace;

        return $this;
    }

    /**
     * Get workplace
     *
     * @return \ESERV\MAIN\MembershipBundle\Entity\Workplace 
     */
    public function getWorkplace()
    {
        return $this->workplace;
    }

    /**
     * Set branch
     *
     * @param \ESERV\MAIN\MembershipBundle\Entity\Branch $branch
     * @return EmploymentDetail
     */
    public function setBranch(\ESERV\MAIN\MembershipBundle\Entity\Branch $branch = null)
    {
        $this->branch = $branch;

        return $this;
    }

    /**
     * Get branch
     *
     * @return \ESERV\MAIN\MembershipBundle\Entity\Branch 
     */
    public function getBranch()
    {
        return $this->branch;
    }
    
    /**
     * @var string
     */
    private $empLevel;
    
    /**
     * Set empLevel
     *
     * @param string $empLevel
     * @return EmploymentDetail
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
     * @var \ESERV\MAIN\MembershipBundle\Entity\Employer
     */
    private $otherEmployer;


    /**
     * Set otherEmployer
     *
     * @param \ESERV\MAIN\MembershipBundle\Entity\Employer $otherEmployer
     * @return EmploymentDetail
     */
    public function setOtherEmployer(\ESERV\MAIN\MembershipBundle\Entity\Employer $otherEmployer = null)
    {
        $this->otherEmployer = $otherEmployer;

        return $this;
    }

    /**
     * Get otherEmployer
     *
     * @return \ESERV\MAIN\MembershipBundle\Entity\Employer 
     */
    public function getOtherEmployer()
    {
        return $this->otherEmployer;
    }
}
