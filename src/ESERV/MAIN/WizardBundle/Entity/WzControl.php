<?php

namespace ESERV\MAIN\WizardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WzControl
 */
class WzControl
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $applicationId;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $started;

    /**
     * @var \DateTime
     */
    private $dateCompleted;

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
     * @var \ESERV\MAIN\WizardBundle\Entity\WzType
     */
    private $wzType;


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
     * Set applicationId
     *
     * @param string $applicationId
     * @return WzControl
     */
    public function setApplicationId($applicationId)
    {
        $this->applicationId = $applicationId;

        return $this;
    }

    /**
     * Get applicationId
     *
     * @return string 
     */
    public function getApplicationId()
    {
        return $this->applicationId;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return WzControl
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set started
     *
     * @param string $started
     * @return WzControl
     */
    public function setStarted($started)
    {
        $this->started = $started;

        return $this;
    }

    /**
     * Get started
     *
     * @return string 
     */
    public function getStarted()
    {
        return $this->started;
    }

    /**
     * Set dateCompleted
     *
     * @param \DateTime $dateCompleted
     * @return WzControl
     */
    public function setDateCompleted($dateCompleted)
    {
        $this->dateCompleted = $dateCompleted;

        return $this;
    }

    /**
     * Get dateCompleted
     *
     * @return \DateTime 
     */
    public function getDateCompleted()
    {
        return $this->dateCompleted;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return WzControl
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
     * @return WzControl
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
     * @return WzControl
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
     * @return WzControl
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
     * Set wzType
     *
     * @param \ESERV\MAIN\WizardBundle\Entity\WzType $wzType
     * @return WzControl
     */
    public function setWzType(\ESERV\MAIN\WizardBundle\Entity\WzType $wzType = null)
    {
        $this->wzType = $wzType;

        return $this;
    }

    /**
     * Get wzType
     *
     * @return \ESERV\MAIN\WizardBundle\Entity\WzType 
     */
    public function getWzType()
    {
        return $this->wzType;
    }
    
    /**
     * Set id
     *
     * @param integer $id
     * @return WzControl
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
