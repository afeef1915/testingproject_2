<?php

namespace ESERV\MAIN\HelpersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AltLanguageEquivalent
 */
class AltLanguageEquivalent
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $entityName;

    /**
     * @var integer
     */
    private $entityId;

    /**
     * @var string
     */
    private $altName;

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
     * @var \ESERV\MAIN\HelpersBundle\Entity\AltLanguage
     */
    private $altLanguage;


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
     * Set entityName
     *
     * @param string $entityName
     * @return AltLanguageEquivalent
     */
    public function setEntityName($entityName)
    {
        $this->entityName = $entityName;

        return $this;
    }

    /**
     * Get entityName
     *
     * @return string 
     */
    public function getEntityName()
    {
        return $this->entityName;
    }

    /**
     * Set entityId
     *
     * @param integer $entityId
     * @return AltLanguageEquivalent
     */
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;

        return $this;
    }

    /**
     * Get entityId
     *
     * @return integer 
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * Set altName
     *
     * @param string $altName
     * @return AltLanguageEquivalent
     */
    public function setAltName($altName)
    {
        $this->altName = $altName;

        return $this;
    }

    /**
     * Get altName
     *
     * @return string 
     */
    public function getAltName()
    {
        return $this->altName;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return AltLanguageEquivalent
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
     * @return AltLanguageEquivalent
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
     * @return AltLanguageEquivalent
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
     * @return AltLanguageEquivalent
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
     * Set altLanguage
     *
     * @param \ESERV\MAIN\HelpersBundle\Entity\AltLanguage $altLanguage
     * @return AltLanguageEquivalent
     */
    public function setAltLanguage(\ESERV\MAIN\HelpersBundle\Entity\AltLanguage $altLanguage = null)
    {
        $this->altLanguage = $altLanguage;

        return $this;
    }

    /**
     * Get altLanguage
     *
     * @return \ESERV\MAIN\HelpersBundle\Entity\AltLanguage 
     */
    public function getAltLanguage()
    {
        return $this->altLanguage;
    }
    
    public function getAllByEntityIdAndEntityName($em,$entityId,$entityName)
    {
        $qb1 = $em->createQueryBuilder();
        $result1 = $qb1->select('p.id','p.altName','p.createdAt','p.updatedAt','p.createdBy','p.updatedBy')
                ->from('ESERVMAINHelpersBundle:AltLanguageEquivalent', 'p')                
                ->where('p.entityId = :eid')
                ->setParameter('eid', $entityId)
                ->andWhere('p.entityName = :ename')
                ->setParameter('ename', $entityName)
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
        return $result1;
    }
}
