<?php

namespace ESERV\MAIN\HelpersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AltLanguageReltypeEquiv
 */
class AltLanguageReltypeEquiv
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $altNameAB;

    /**
     * @var string
     */
    private $altNameBA;

    /**
     * @var \ESERV\MAIN\HelpersBundle\Entity\AltLanguage
     */
    private $altLanguage;

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
     * Set altNameAB
     *
     * @param string $altNameAB
     * @return AltLanguageReltypeEquiv
     */
    public function setAltNameAB($altNameAB)
    {
        $this->altNameAB = $altNameAB;

        return $this;
    }

    /**
     * Get altNameAB
     *
     * @return string 
     */
    public function getAltNameAB()
    {
        return $this->altNameAB;
    }

    /**
     * Set altNameBA
     *
     * @param string $altNameBA
     * @return AltLanguageReltypeEquiv
     */
    public function setAltNameBA($altNameBA)
    {
        $this->altNameBA = $altNameBA;

        return $this;
    }

    /**
     * Get altNameBA
     *
     * @return string 
     */
    public function getAltNameBA()
    {
        return $this->altNameBA;
    }

    /**
     * Set altLanguage
     *
     * @param \ESERV\MAIN\HelpersBundle\Entity\AltLanguage $altLanguage
     * @return AltLanguageReltypeEquiv
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

    /**
     * Set relationshipType
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\RelationshipType $relationshipType
     * @return AltLanguageReltypeEquiv
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return AltLanguageReltypeEquiv
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
     * @return AltLanguageReltypeEquiv
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
     * @return AltLanguageReltypeEquiv
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
     * @return AltLanguageReltypeEquiv
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
}
