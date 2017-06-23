<?php

namespace ESERV\MAIN\MembershipBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Workplace
 */
class Workplace
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
    private $workplaceType;


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
     * @return Workplace
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
     * @return Workplace
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
     * @return Workplace
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
     * @return Workplace
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
     * @return Workplace
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
     * @return Workplace
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
     * @return Workplace
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
     * @return Workplace
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
     * @return Workplace
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
     * @return Workplace
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
     * @return Workplace
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
     * @return Workplace
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
     * Set workplaceType
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $workplaceType
     * @return Workplace
     */
    public function setWorkplaceType(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $workplaceType = null)
    {
        $this->workplaceType = $workplaceType;

        return $this;
    }

    /**
     * Get workplaceType
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getWorkplaceType()
    {
        return $this->workplaceType;
    }
    
    public function getAllByOrganisationId($em,$organisationId)
    {
        $qb1 = $em->createQueryBuilder();
        $result1 = $qb1->select('wt.id','p.potentialMembers','p.potentialMembersDate',
                'p.noMembers','p.noMembersDate','p.noEmployees','p.noEmployeesDate')
                ->from('ESERVMAINMembershipBundle:Workplace', 'p')
                ->leftJoin('p.workplaceType','wt')
                ->leftJoin('p.organisation','o')
                ->where('o.id = :oid')                
                ->setParameter('oid', $organisationId)
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
        return $result1;
    } 
    /**
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $denom;


    /**
     * Set denom
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $denom
     * @return Workplace
     */
    public function setDenom(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $denom = null)
    {
        $this->denom = $denom;

        return $this;
    }

    /**
     * Get denom
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getDenom()
    {
        return $this->denom;
    }
}
