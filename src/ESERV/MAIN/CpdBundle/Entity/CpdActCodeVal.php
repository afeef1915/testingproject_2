<?php

namespace ESERV\MAIN\CpdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CpdActCodeVal
 */
class CpdActCodeVal
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
     * @var string
     */
    private $name;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $createdBy;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $updatedBy;

    /**
     * @var \ESERV\MAIN\CpdBundle\Entity\CpdActCodeControl
     */
    private $cpdActCodeControl;

    /**
     * @var \ESERV\MAIN\CpdBundle\Entity\CpdActCodeVal
     */
    private $cpdActCdVal;


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
     * @return CpdActCodeVal
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
     * Set name
     *
     * @param string $name
     * @return CpdActCodeVal
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return CpdActCodeVal
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
     * Set createdBy
     *
     * @param integer $createdBy
     * @return CpdActCodeVal
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return CpdActCodeVal
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
     * Set updatedBy
     *
     * @param integer $updatedBy
     * @return CpdActCodeVal
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
     * Set cpdActCodeControl
     *
     * @param \ESERV\MAIN\CpdBundle\Entity\CpdActCodeControl $cpdActCodeControl
     * @return CpdActCodeVal
     */
    public function setCpdActCodeControl(\ESERV\MAIN\CpdBundle\Entity\CpdActCodeControl $cpdActCodeControl = null)
    {
        $this->cpdActCodeControl = $cpdActCodeControl;

        return $this;
    }

    /**
     * Get cpdActCodeControl
     *
     * @return \ESERV\MAIN\CpdBundle\Entity\CpdActCodeControl 
     */
    public function getCpdActCodeControl()
    {
        return $this->cpdActCodeControl;
    }

    /**
     * Set cpdActCdVal
     *
     * @param \ESERV\MAIN\CpdBundle\Entity\CpdActCodeVal $cpdActCdVal
     * @return CpdActCodeVal
     */
    public function setCpdActCdVal(\ESERV\MAIN\CpdBundle\Entity\CpdActCodeVal $cpdActCdVal = null)
    {
        $this->cpdActCdVal = $cpdActCdVal;

        return $this;
    }

    /**
     * Get cpdActCdVal
     *
     * @return \ESERV\MAIN\CpdBundle\Entity\CpdActCodeVal 
     */
    public function getCpdActCdVal()
    {
        return $this->cpdActCdVal;
    }
}
