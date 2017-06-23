<?php

namespace ESERV\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GtcwVMemSubjectTaught
 */
class GtcwVMemSubjectTaught
{
    /**
     * @var integer
     */
    private $dtindex;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $contactId;

    /**
     * @var integer
     */
    private $memberId;

    /**
     * @var integer
     */
    private $memberSubjectId;

    /**
     * @var string
     */
    private $subjectCode;

    /**
     * @var string
     */
    private $subjectName;

    /**
     * @var string
     */
    private $membershipOrgCode;

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
     * Set id
     *
     * @param integer $id
     * @return GtcwVMemSubjectTaught
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set contactId
     *
     * @param integer $contactId
     * @return GtcwVMemSubjectTaught
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
     * Set memberId
     *
     * @param integer $memberId
     * @return GtcwVMemSubjectTaught
     */
    public function setMemberId($memberId)
    {
        $this->memberId = $memberId;

        return $this;
    }

    /**
     * Get memberId
     *
     * @return integer 
     */
    public function getMemberId()
    {
        return $this->memberId;
    }

    /**
     * Set memberSubjectId
     *
     * @param integer $memberSubjectId
     * @return GtcwVMemSubjectTaught
     */
    public function setMemberSubjectId($memberSubjectId)
    {
        $this->memberSubjectId = $memberSubjectId;

        return $this;
    }

    /**
     * Get memberSubjectId
     *
     * @return integer 
     */
    public function getMemberSubjectId()
    {
        return $this->memberSubjectId;
    }

    /**
     * Set subjectCode
     *
     * @param string $subjectCode
     * @return GtcwVMemSubjectTaught
     */
    public function setSubjectCode($subjectCode)
    {
        $this->subjectCode = $subjectCode;

        return $this;
    }

    /**
     * Get subjectCode
     *
     * @return string 
     */
    public function getSubjectCode()
    {
        return $this->subjectCode;
    }

    /**
     * Set subjectName
     *
     * @param string $subjectName
     * @return GtcwVMemSubjectTaught
     */
    public function setSubjectName($subjectName)
    {
        $this->subjectName = $subjectName;

        return $this;
    }

    /**
     * Get subjectName
     *
     * @return string 
     */
    public function getSubjectName()
    {
        return $this->subjectName;
    }

    /**
     * Set membershipOrgCode
     *
     * @param string $membershipOrgCode
     * @return GtcwVMemSubjectTaught
     */
    public function setMembershipOrgCode($membershipOrgCode)
    {
        $this->membershipOrgCode = $membershipOrgCode;

        return $this;
    }

    /**
     * Get membershipOrgCode
     *
     * @return string 
     */
    public function getMembershipOrgCode()
    {
        return $this->membershipOrgCode;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return GtcwVMemSubjectTaught
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
     * @return GtcwVMemSubjectTaught
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
