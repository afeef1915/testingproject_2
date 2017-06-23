<?php

namespace ESERV\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GtcwVMemSubject
 */
class GtcwVMemSubject
{
    /**
     * @var integer
     */
    private $dtindex;

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
     * @var string
     */
    private $membershipOrgCode;
    
    /**
     * @var string
     */
    private $membershipOrgName;

    /**
     * @var \DateTime
     */
    private $dateOpened;

    /**
     * @var \DateTime
     */
    private $dateClosed;


    /**
     * Get dtindex
     *
     * @return integer 
     */
    public function getDtindex()
    {
        return $this->dtindex;
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return GtcwVMemSubject
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * @return GtcwVMemSubject
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
     * @return GtcwVMemSubject
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
     * Set membershipOrgCode
     *
     * @param string $membershipOrgCode
     * @return GtcwVMemSubject
     */
    public function setMembershipOrgCode($membershipOrgCode)
    {
        $this->membershipOrgCode = $membershipOrgCode;

        return $this;
    }

    /**
     * Get membershipOrgCode
     *
     * @return string 
     */
    public function getMembershipOrgCode()
    {
        return $this->membershipOrgCode;
    }
    
    /**
     * Set membershipOrgName
     *
     * @param string $membershipOrgName
     * @return GtcwVMemSubject
     */
    public function setMembershipOrgName($membershipOrgName)
    {
        $this->membershipOrgName = $membershipOrgName;

        return $this;
    }

    /**
     * Get membershipOrgName
     *
     * @return string 
     */
    public function getMembershipOrgName()
    {
        return $this->membershipOrgName;
    }

    /**
     * Set dateOpened
     *
     * @param \DateTime $dateOpened
     * @return GtcwVMemSubject
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
     * @return GtcwVMemSubject
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
