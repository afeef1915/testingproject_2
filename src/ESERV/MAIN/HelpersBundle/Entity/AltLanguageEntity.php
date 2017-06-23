<?php

namespace ESERV\MAIN\HelpersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AltLanguageEntity
 */
class AltLanguageEntity
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
     * @return AltLanguageEntity
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return AltLanguageEntity
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
     * @return AltLanguageEntity
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
     * @return AltLanguageEntity
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
     * @return AltLanguageEntity
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
     * @return AltLanguageEntity
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
}
