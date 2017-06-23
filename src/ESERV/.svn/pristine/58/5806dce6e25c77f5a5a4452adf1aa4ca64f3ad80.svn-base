<?php

namespace ESERV\MAIN\MembershipBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Member
 */
class Member
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
     * @return Member
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
     * @return Member
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
     * @return Member
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
     * @return Member
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Member
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
     * @return Member
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
     * @return Member
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
     * @return Member
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
     * @return Member
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
     * Set workplace
     *
     * @param \ESERV\MAIN\MembershipBundle\Entity\Workplace $workplace
     * @return Member
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
     * @return Member
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
     * @return Member
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
     * @return Member
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
     * @return Member
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
     * @var \DateTime
     */
    private $reinstateDate;

    /**
     * @var \ESERV\MAIN\MembershipBundle\Entity\MemberStatusReason
     */
    private $statusReason;


    /**
     * Set reinstateDate
     *
     * @param \DateTime $reinstateDate
     * @return Member
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
     * Set statusReason
     *
     * @param \ESERV\MAIN\MembershipBundle\Entity\MemberStatusReason $statusReason
     * @return Member
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
