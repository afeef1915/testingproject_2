<?php

namespace ESERV\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GtcwVSubject
 */
class GtcwVSubject
{
    /**
     * @var integer
     */
    private $subject_id;

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
     * Get subject_id
     *
     * @return integer 
     */
    public function getSubjectId()
    {
        return $this->subject_id;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return GtcwVSubject
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
     * @return GtcwVSubject
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
     * @return GtcwVSubject
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
     * @return GtcwVSubject
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
     * @return GtcwVSubject
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
}
