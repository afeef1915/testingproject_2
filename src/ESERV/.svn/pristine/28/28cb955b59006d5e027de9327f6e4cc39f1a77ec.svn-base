<?php

namespace ESERV\MAIN\QualificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QualMand
 */
class QualMand
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $qualMandValue;

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
     * @var \ESERV\MAIN\QualificationBundle\Entity\Qualification
     */
    private $qualification;

    /**
     * @var \ESERV\MAIN\QualificationBundle\Entity\QualMandControl
     */
    private $qualMandControl;


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
     * Set qualMandValue
     *
     * @param string $qualMandValue
     * @return QualMand
     */
    public function setQualMandValue($qualMandValue)
    {
        $this->qualMandValue = $qualMandValue;

        return $this;
    }

    /**
     * Get qualMandValue
     *
     * @return string 
     */
    public function getQualMandValue()
    {
        return $this->qualMandValue;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return QualMand
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
     * @return QualMand
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
     * @return QualMand
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
     * @return QualMand
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
     * Set qualification
     *
     * @param \ESERV\MAIN\QualificationBundle\Entity\Qualification $qualification
     * @return QualMand
     */
    public function setQualification(\ESERV\MAIN\QualificationBundle\Entity\Qualification $qualification = null)
    {
        $this->qualification = $qualification;

        return $this;
    }

    /**
     * Get qualification
     *
     * @return \ESERV\MAIN\QualificationBundle\Entity\Qualification 
     */
    public function getQualification()
    {
        return $this->qualification;
    }

    /**
     * Set qualMandControl
     *
     * @param \ESERV\MAIN\QualificationBundle\Entity\QualMandControl $qualMandControl
     * @return QualMand
     */
    public function setQualMandControl(\ESERV\MAIN\QualificationBundle\Entity\QualMandControl $qualMandControl = null)
    {
        $this->qualMandControl = $qualMandControl;

        return $this;
    }

    /**
     * Get qualMandControl
     *
     * @return \ESERV\MAIN\QualificationBundle\Entity\QualMandControl 
     */
    public function getQualMandControl()
    {
        return $this->qualMandControl;
    }
}
