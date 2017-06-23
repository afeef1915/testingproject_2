<?php

namespace ESERV\MAIN\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Relationship
 */
class Relationship
{
    /**
     * @var integer
     */
    private $id;

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
    private $contactA;

    /**
     * @var \ESERV\MAIN\ContactBundle\Entity\Contact
     */
    private $contactB;

    /**
     * @var \ESERV\MAIN\ContactBundle\Entity\RelationshipType
     */
    private $relationshipType;


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
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Relationship
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
     * @return Relationship
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
     * @return Relationship
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
     * @return Relationship
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
     * @return Relationship
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
     * @return Relationship
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
     * Set contactA
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\Contact $contactA
     * @return Relationship
     */
    public function setContactA(\ESERV\MAIN\ContactBundle\Entity\Contact $contactA = null)
    {
        $this->contactA = $contactA;

        return $this;
    }

    /**
     * Get contactA
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\Contact 
     */
    public function getContactA()
    {
        return $this->contactA;
    }

    /**
     * Set contactB
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\Contact $contactB
     * @return Relationship
     */
    public function setContactB(\ESERV\MAIN\ContactBundle\Entity\Contact $contactB = null)
    {
        $this->contactB = $contactB;

        return $this;
    }

    /**
     * Get contactB
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\Contact 
     */
    public function getContactB()
    {
        return $this->contactB;
    }

    /**
     * Set relationshipType
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\RelationshipType $relationshipType
     * @return Relationship
     */
    public function setRelationshipType(\ESERV\MAIN\ContactBundle\Entity\RelationshipType $relationshipType = null)
    {
        $this->relationshipType = $relationshipType;

        return $this;
    }

    /**
     * Get relationshipType
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\RelationshipType 
     */
    public function getRelationshipType()
    {
        return $this->relationshipType;
    }
    
    public function getAllByContactIdB($em,$contactIdB)
    {
        $qb1 = $em->createQueryBuilder();
        $result1 = $qb1->select('c.id AS idA','p.startDate','p.endDate',
                'p.createdAt','p.updatedAt','p.createdBy','p.updatedBy')
                ->from('ESERVMAINContactBundle:Relationship', 'p')
                ->leftJoin('p.contactA','c')
                ->where('p.contactB = :idb')
                ->setParameter('idb', $contactIdB)
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
        return $result1;
    }
}
