<?php

namespace ESERV\MAIN\MembershipBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 */
class Branch
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
    private $branchType;


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
     * @return Branch
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
     * @return Branch
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
     * @return Branch
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
     * @return Branch
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
     * @return Branch
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Branch
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
     * @return Branch
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
     * @return Branch
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
     * @return Branch
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
     * @return Branch
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
     * Set branchType
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $branchType
     * @return Branch
     */
    public function setBranchType(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $branchType = null)
    {
        $this->branchType = $branchType;

        return $this;
    }

    /**
     * Get branchType
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getBranchType()
    {
        return $this->branchType;
    }
}
