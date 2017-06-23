<?php

namespace ESERV\MAIN\QualificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QualMandControl
 */
class QualMandControl
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $dateOpened;

    /**
     * @var \DateTime
     */
    private $dateClosed;

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
     * @var \ESERV\MAIN\MembershipBundle\Entity\MembershipOrg
     */
    private $membershipOrg;


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
     * Set dateOpened
     *
     * @param \DateTime $dateOpened
     * @return QualMandControl
     */
    public function setDateOpened($dateOpened)
    {
        $this->dateOpened = $dateOpened;

        return $this;
    }

    /**
     * Get dateOpened
     *
     * @return \DateTime 
     */
    public function getDateOpened()
    {
        return $this->dateOpened;
    }

    /**
     * Set dateClosed
     *
     * @param \DateTime $dateClosed
     * @return QualMandControl
     */
    public function setDateClosed($dateClosed)
    {
        $this->dateClosed = $dateClosed;

        return $this;
    }

    /**
     * Get dateClosed
     *
     * @return \DateTime 
     */
    public function getDateClosed()
    {
        return $this->dateClosed;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return QualMandControl
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
     * @return QualMandControl
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
     * @return QualMandControl
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
     * @return QualMandControl
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
     * Set membershipOrg
     *
     * @param \ESERV\MAIN\MembershipBundle\Entity\MembershipOrg $membershipOrg
     * @return QualMandControl
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
}
