<?php

namespace ESERV\MAIN\MembershipBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employer
 */
class Employer
{
    
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var integer
     */
    private $potentialMembers;

    /**
     * @var \DateTime
     */
    private $potentialMembersDate;

    /**
     * @var integer
     */
    private $noMembers;

    /**
     * @var \DateTime
     */
    private $noMembersDate;

    /**
     * @var integer
     */
    private $noEmployees;

    /**
     * @var \DateTime
     */
    private $noEmployeesDate;

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
     * @var \ESERV\MAIN\ContactBundle\Entity\Organisation
     */
    private $organisation;

    /**
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $employerType;


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
     * Set code
     *
     * @param string $code
     * @return Employer
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set potentialMembers
     *
     * @param integer $potentialMembers
     * @return Employer
     */
    public function setPotentialMembers($potentialMembers)
    {
        $this->potentialMembers = $potentialMembers;

        return $this;
    }

    /**
     * Get potentialMembers
     *
     * @return integer 
     */
    public function getPotentialMembers()
    {
        return $this->potentialMembers;
    }

    /**
     * Set potentialMembersDate
     *
     * @param \DateTime $potentialMembersDate
     * @return Employer
     */
    public function setPotentialMembersDate($potentialMembersDate)
    {
        $this->potentialMembersDate = $potentialMembersDate;

        return $this;
    }

    /**
     * Get potentialMembersDate
     *
     * @return \DateTime 
     */
    public function getPotentialMembersDate()
    {
        return $this->potentialMembersDate;
    }

    /**
     * Set noMembers
     *
     * @param integer $noMembers
     * @return Employer
     */
    public function setNoMembers($noMembers)
    {
        $this->noMembers = $noMembers;

        return $this;
    }

    /**
     * Get noMembers
     *
     * @return integer 
     */
    public function getNoMembers()
    {
        return $this->noMembers;
    }

    /**
     * Set noMembersDate
     *
     * @param \DateTime $noMembersDate
     * @return Employer
     */
    public function setNoMembersDate($noMembersDate)
    {
        $this->noMembersDate = $noMembersDate;

        return $this;
    }

    /**
     * Get noMembersDate
     *
     * @return \DateTime 
     */
    public function getNoMembersDate()
    {
        return $this->noMembersDate;
    }

    /**
     * Set noEmployees
     *
     * @param integer $noEmployees
     * @return Employer
     */
    public function setNoEmployees($noEmployees)
    {
        $this->noEmployees = $noEmployees;

        return $this;
    }

    /**
     * Get noEmployees
     *
     * @return integer 
     */
    public function getNoEmployees()
    {
        return $this->noEmployees;
    }

    /**
     * Set noEmployeesDate
     *
     * @param \DateTime $noEmployeesDate
     * @return Employer
     */
    public function setNoEmployeesDate($noEmployeesDate)
    {
        $this->noEmployeesDate = $noEmployeesDate;

        return $this;
    }

    /**
     * Get noEmployeesDate
     *
     * @return \DateTime 
     */
    public function getNoEmployeesDate()
    {
        return $this->noEmployeesDate;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Employer
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
     * @return Employer
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
     * @return Employer
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
     * @return Employer
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
     * Set organisation
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\Organisation $organisation
     * @return Employer
     */
    public function setOrganisation(\ESERV\MAIN\ContactBundle\Entity\Organisation $organisation = null)
    {
        $this->organisation = $organisation;

        return $this;
    }

    /**
     * Get organisation
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\Organisation 
     */
    public function getOrganisation()
    {
        return $this->organisation;
    }

    /**
     * Set employerType
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $employerType
     * @return Employer
     */
    public function setEmployerType(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $employerType = null)
    {
        $this->employerType = $employerType;

        return $this;
    }

    /**
     * Get employerType
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getEmployerType()
    {
        return $this->employerType;
    }
}
