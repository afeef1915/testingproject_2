<?php

namespace ESERV\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GtcwVEstablishment
 */
class GtcwVEstablishment
{
    /**
     * @var integer
     */
    private $organisation_id;

    /**
     * @var integer
     */
    private $contact_id;

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
    private $dateOpened;


    /**
     * Get organisation_id
     *
     * @return integer 
     */
    public function getOrganisationId()
    {
        return $this->organisation_id;
    }

    /**
     * Set contact_id
     *
     * @param integer $contactId
     * @return GtcwVEstablishment
     */
    public function setContactId($contactId)
    {
        $this->contact_id = $contactId;

        return $this;
    }

    /**
     * Get contact_id
     *
     * @return integer 
     */
    public function getContactId()
    {
        return $this->contact_id;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return GtcwVEstablishment
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
     * @return GtcwVEstablishment
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
     * Set dateOpened
     *
     * @param \DateTime $dateOpened
     * @return GtcwVEstablishment
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
     * @var \DateTime
     */
    private $dateClosed;

    /**
     * @var string
     */
    private $previousName;

    /**
     * @var string
     */
    private $referenceNo;

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
     * Set dateClosed
     *
     * @param \DateTime $dateClosed
     * @return GtcwVEstablishment
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
     * Set previousName
     *
     * @param string $previousName
     * @return GtcwVEstablishment
     */
    public function setPreviousName($previousName)
    {
        $this->previousName = $previousName;

        return $this;
    }

    /**
     * Get previousName
     *
     * @return string 
     */
    public function getPreviousName()
    {
        return $this->previousName;
    }

    /**
     * Set referenceNo
     *
     * @param string $referenceNo
     * @return GtcwVEstablishment
     */
    public function setReferenceNo($referenceNo)
    {
        $this->referenceNo = $referenceNo;

        return $this;
    }

    /**
     * Get referenceNo
     *
     * @return string 
     */
    public function getReferenceNo()
    {
        return $this->referenceNo;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return GtcwVEstablishment
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
     * @return GtcwVEstablishment
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
     * @return GtcwVEstablishment
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
     * @return GtcwVEstablishment
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
     * @var string
     */
    private $addressLine1;

    /**
     * @var string
     */
    private $addressLine2;

    /**
     * @var string
     */
    private $addressLine3;

    /**
     * @var string
     */
    private $town;

    /**
     * @var string
     */
    private $county;

    /**
     * @var string
     */
    private $postcode;

    /**
     * @var integer
     */
    private $qualTypeId;

    /**
     * @var string
     */
    private $qualTypeCode;

    /**
     * @var string
     */
    private $qualTypeName;

    /**
     * @var string
     */
    private $welshName;


    /**
     * Set addressLine1
     *
     * @param string $addressLine1
     * @return GtcwVEstablishment
     */
    public function setAddressLine1($addressLine1)
    {
        $this->addressLine1 = $addressLine1;

        return $this;
    }

    /**
     * Get addressLine1
     *
     * @return string 
     */
    public function getAddressLine1()
    {
        return $this->addressLine1;
    }

    /**
     * Set addressLine2
     *
     * @param string $addressLine2
     * @return GtcwVEstablishment
     */
    public function setAddressLine2($addressLine2)
    {
        $this->addressLine2 = $addressLine2;

        return $this;
    }

    /**
     * Get addressLine2
     *
     * @return string 
     */
    public function getAddressLine2()
    {
        return $this->addressLine2;
    }

    /**
     * Set addressLine3
     *
     * @param string $addressLine3
     * @return GtcwVEstablishment
     */
    public function setAddressLine3($addressLine3)
    {
        $this->addressLine3 = $addressLine3;

        return $this;
    }

    /**
     * Get addressLine3
     *
     * @return string 
     */
    public function getAddressLine3()
    {
        return $this->addressLine3;
    }

    /**
     * Set town
     *
     * @param string $town
     * @return GtcwVEstablishment
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string 
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set county
     *
     * @param string $county
     * @return GtcwVEstablishment
     */
    public function setCounty($county)
    {
        $this->county = $county;

        return $this;
    }

    /**
     * Get county
     *
     * @return string 
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     * @return GtcwVEstablishment
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string 
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set qualTypeId
     *
     * @param integer $qualTypeId
     * @return GtcwVEstablishment
     */
    public function setQualTypeId($qualTypeId)
    {
        $this->qualTypeId = $qualTypeId;

        return $this;
    }

    /**
     * Get qualTypeId
     *
     * @return integer 
     */
    public function getQualTypeId()
    {
        return $this->qualTypeId;
    }

    /**
     * Set qualTypeCode
     *
     * @param string $qualTypeCode
     * @return GtcwVEstablishment
     */
    public function setQualTypeCode($qualTypeCode)
    {
        $this->qualTypeCode = $qualTypeCode;

        return $this;
    }

    /**
     * Get qualTypeCode
     *
     * @return string 
     */
    public function getQualTypeCode()
    {
        return $this->qualTypeCode;
    }

    /**
     * Set qualTypeName
     *
     * @param string $qualTypeName
     * @return GtcwVEstablishment
     */
    public function setQualTypeName($qualTypeName)
    {
        $this->qualTypeName = $qualTypeName;

        return $this;
    }

    /**
     * Get qualTypeName
     *
     * @return string 
     */
    public function getQualTypeName()
    {
        return $this->qualTypeName;
    }

    /**
     * Set welshName
     *
     * @param string $welshName
     * @return GtcwVEstablishment
     */
    public function setWelshName($welshName)
    {
        $this->welshName = $welshName;

        return $this;
    }

    /**
     * Get welshName
     *
     * @return string 
     */
    public function getWelshName()
    {
        return $this->welshName;
    }
    /**
     * @var string
     */
    private $establishmentId;


    /**
     * Set establishmentId
     *
     * @param string $establishmentId
     * @return GtcwVEstablishment
     */
    public function setEstablishmentId($establishmentId)
    {
        $this->establishmentId = $establishmentId;

        return $this;
    }

    /**
     * Get establishmentId
     *
     * @return string 
     */
    public function getEstablishmentId()
    {
        return $this->establishmentId;
    }
}
