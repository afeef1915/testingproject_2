<?php

namespace ESERV\MAIN\QualificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Establishment
 */
class Establishment
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
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $qualType;

    /**
     * @var \ESERV\MAIN\ContactBundle\Entity\Organisation
     */
    private $organisation;


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
     * @return Establishment
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Establishment
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
     * @return Establishment
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
     * @return Establishment
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
     * @return Establishment
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
     * Set qualType
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $qualType
     * @return Establishment
     */
    public function setQualType(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $qualType = null)
    {
        $this->qualType = $qualType;

        return $this;
    }

    /**
     * Get qualType
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getQualType()
    {
        return $this->qualType;
    }

    /**
     * Set organisation
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\Organisation $organisation
     * @return Establishment
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
}
