<?php

namespace ESERV\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GtcwVQualification
 */
class GtcwVQualification
{
    /**
     * @var integer
     */
    private $qualification_id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $qualType;

    /**
     * @var \DateTime
     */
    private $dateOpened;

    /**
     * @var \DateTime
     */
    private $dateClosed;

    /**
     * @var string
     */
    private $qualMandMemOrg;


    /**
     * Get qualification_id
     *
     * @return integer 
     */
    public function getQualificationId()
    {
        return $this->qualification_id;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return GtcwVQualification
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
     * @return GtcwVQualification
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
     * Set qualType
     *
     * @param string $qualType
     * @return GtcwVQualification
     */
    public function setQualType($qualType)
    {
        $this->qualType = $qualType;

        return $this;
    }

    /**
     * Get qualType
     *
     * @return string 
     */
    public function getQualType()
    {
        return $this->qualType;
    }

    /**
     * Set dateOpened
     *
     * @param \DateTime $dateOpened
     * @return GtcwVQualification
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
     * @return GtcwVQualification
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
     * Set qualMandMemOrg
     *
     * @param string $qualMandMemOrg
     * @return GtcwVQualification
     */
    public function setQualMandMemOrg($qualMandMemOrg)
    {
        $this->qualMandMemOrg = $qualMandMemOrg;

        return $this;
    }

    /**
     * Get qualMandMemOrg
     *
     * @return string 
     */
    public function getQualMandMemOrg()
    {
        return $this->qualMandMemOrg;
    }
}
