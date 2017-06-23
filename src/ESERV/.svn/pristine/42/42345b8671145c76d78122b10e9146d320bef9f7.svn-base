<?php

namespace ESERV\MAIN\MembershipBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MemberHist
 */
class MemberHist
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $statusDate;

    /**
     * @var string
     */
    private $primaryRecord;

    /**
     * @var string
     */
    private $membershipNo;

    /**
     * @var \DateTime
     */
    private $registrationDate;

    /**
     * @var \DateTime
     */
    private $reinstateDate;

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
     * @var \ESERV\MAIN\MembershipBundle\Entity\Member
     */
    private $member;

    /**
     * @var \ESERV\MAIN\MembershipBundle\Entity\Workplace
     */
    private $workplace;

    /**
     * @var \ESERV\MAIN\MembershipBundle\Entity\Branch
     */
    private $branch;

    /**
     * @var \ESERV\MAIN\MembershipBundle\Entity\MembershipOrg
     */
    private $membershipOrg;

    /**
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $votingCategory;

    /**
     * @var \ESERV\MAIN\MembershipBundle\Entity\MemberStatus
     */
    private $memberStatus;

    /**
     * @var \ESERV\MAIN\MembershipBundle\Entity\MemberStatusReason
     */
    private $statusReason;


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
     * Set statusDate
     *
     * @param \DateTime $statusDate
     * @return MemberHist
     */
    public function setStatusDate($statusDate)
    {
        $this->statusDate = $statusDate;

        return $this;
    }

    /**
     * Get statusDate
     *
     * @return \DateTime 
     */
    public function getStatusDate()
    {
        return $this->statusDate;
    }

    /**
     * Set primaryRecord
     *
     * @param string $primaryRecord
     * @return MemberHist
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
     * Set membershipNo
     *
     * @param string $membershipNo
     * @return MemberHist
     */
    public function setMembershipNo($membershipNo)
    {
        $this->membershipNo = $membershipNo;

        return $this;
    }

    /**
     * Get membershipNo
     *
     * @return string 
     */
    public function getMembershipNo()
    {
        return $this->membershipNo;
    }

    /**
     * Set registrationDate
     *
     * @param \DateTime $registrationDate
     * @return MemberHist
     */
    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * Get registrationDate
     *
     * @return \DateTime 
     */
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    /**
     * Set reinstateDate
     *
     * @param \DateTime $reinstateDate
     * @return MemberHist
     */
    public function setReinstateDate($reinstateDate)
    {
        $this->reinstateDate = $reinstateDate;

        return $this;
    }

    /**
     * Get reinstateDate
     *
     * @return \DateTime 
     */
    public function getReinstateDate()
    {
        return $this->reinstateDate;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return MemberHist
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
     * @return MemberHist
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
     * @return MemberHist
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
     * @return MemberHist
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
     * Set member
     *
     * @param \ESERV\MAIN\MembershipBundle\Entity\Member $member
     * @return MemberHist
     */
    public function setMember(\ESERV\MAIN\MembershipBundle\Entity\Member $member = null)
    {
        $this->member = $member;

        return $this;
    }

    /**
     * Get member
     *
     * @return \ESERV\MAIN\MembershipBundle\Entity\Member 
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * Set workplace
     *
     * @param \ESERV\MAIN\MembershipBundle\Entity\Workplace $workplace
     * @return MemberHist
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
     * @return MemberHist
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
     * Set membershipOrg
     *
     * @param \ESERV\MAIN\MembershipBundle\Entity\MembershipOrg $membershipOrg
     * @return MemberHist
     */
    public function setMembershipOrg(\ESERV\MAIN\MembershipBundle\Entity\MembershipOrg $membershipOrg = null)
    {
        $this->membershipOrg = $membershipOrg;

        return $this;
    }

    /**
     * Get membershipOrg
     *
     * @return \ESERV\MAIN\MembershipBundle\Entity\MembershipOrg 
     */
    public function getMembershipOrg()
    {
        return $this->membershipOrg;
    }

    /**
     * Set votingCategory
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $votingCategory
     * @return MemberHist
     */
    public function setVotingCategory(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $votingCategory = null)
    {
        $this->votingCategory = $votingCategory;

        return $this;
    }

    /**
     * Get votingCategory
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getVotingCategory()
    {
        return $this->votingCategory;
    }

    /**
     * Set memberStatus
     *
     * @param \ESERV\MAIN\MembershipBundle\Entity\MemberStatus $memberStatus
     * @return MemberHist
     */
    public function setMemberStatus(\ESERV\MAIN\MembershipBundle\Entity\MemberStatus $memberStatus = null)
    {
        $this->memberStatus = $memberStatus;

        return $this;
    }

    /**
     * Get memberStatus
     *
     * @return \ESERV\MAIN\MembershipBundle\Entity\MemberStatus 
     */
    public function getMemberStatus()
    {
        return $this->memberStatus;
    }

    /**
     * Set statusReason
     *
     * @param \ESERV\MAIN\MembershipBundle\Entity\MemberStatusReason $statusReason
     * @return MemberHist
     */
    public function setStatusReason(\ESERV\MAIN\MembershipBundle\Entity\MemberStatusReason $statusReason = null)
    {
        $this->statusReason = $statusReason;

        return $this;
    }

    /**
     * Get statusReason
     *
     * @return \ESERV\MAIN\MembershipBundle\Entity\MemberStatusReason 
     */
    public function getStatusReason()
    {
        return $this->statusReason;
    }
}
