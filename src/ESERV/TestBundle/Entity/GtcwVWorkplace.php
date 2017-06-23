<?php

namespace ESERV\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GtcwVWorkplace
 */
class GtcwVWorkplace
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
     * @var string
     */
    private $address_line1;

    /**
     * @var string
     */
    private $address_line2;

    /**
     * @var string
     */
    private $address_line3;

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
     * @var \DateTime
     */
    private $wp_date_closed;


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
     * @return GtcwVWorkplace
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
     * @return GtcwVWorkplace
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
     * @return GtcwVWorkplace
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
     * Set address_line1
     *
     * @param string $addressLine1
     * @return GtcwVWorkplace
     */
    public function setAddressLine1($addressLine1)
    {
        $this->address_line1 = $addressLine1;

        return $this;
    }

    /**
     * Get address_line1
     *
     * @return string 
     */
    public function getAddressLine1()
    {
        return $this->address_line1;
    }

    /**
     * Set address_line2
     *
     * @param string $addressLine2
     * @return GtcwVWorkplace
     */
    public function setAddressLine2($addressLine2)
    {
        $this->address_line2 = $addressLine2;

        return $this;
    }

    /**
     * Get address_line2
     *
     * @return string 
     */
    public function getAddressLine2()
    {
        return $this->address_line2;
    }

    /**
     * Set address_line3
     *
     * @param string $addressLine3
     * @return GtcwVWorkplace
     */
    public function setAddressLine3($addressLine3)
    {
        $this->address_line3 = $addressLine3;

        return $this;
    }

    /**
     * Get address_line3
     *
     * @return string 
     */
    public function getAddressLine3()
    {
        return $this->address_line3;
    }

    /**
     * Set town
     *
     * @param string $town
     * @return GtcwVWorkplace
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
     * @return GtcwVWorkplace
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
     * @return GtcwVWorkplace
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
     * Set wp_date_closed
     *
     * @param \DateTime $wpDateClosed
     * @return GtcwVWorkplace
     */
    public function setWpDateClosed($wpDateClosed)
    {
        $this->wp_date_closed = $wpDateClosed;

        return $this;
    }

    /**
     * Get wp_date_closed
     *
     * @return \DateTime 
     */
    public function getWpDateClosed()
    {
        return $this->wp_date_closed;
    }
    /**
     * @var \DateTime
     */
    private $wp_date_opened;

    /**
     * @var string
     */
    private $previous_name;

    /**
     * @var string
     */
    private $reference_no;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var integer
     */
    private $created_by;

    /**
     * @var integer
     */
    private $updated_by;


    /**
     * Set wp_date_opened
     *
     * @param \DateTime $wpDateOpened
     * @return GtcwVWorkplace
     */
    public function setWpDateOpened($wpDateOpened)
    {
        $this->wp_date_opened = $wpDateOpened;

        return $this;
    }

    /**
     * Get wp_date_opened
     *
     * @return \DateTime 
     */
    public function getWpDateOpened()
    {
        return $this->wp_date_opened;
    }

    /**
     * Set previous_name
     *
     * @param string $previousName
     * @return GtcwVWorkplace
     */
    public function setPreviousName($previousName)
    {
        $this->previous_name = $previousName;

        return $this;
    }

    /**
     * Get previous_name
     *
     * @return string 
     */
    public function getPreviousName()
    {
        return $this->previous_name;
    }

    /**
     * Set reference_no
     *
     * @param string $referenceNo
     * @return GtcwVWorkplace
     */
    public function setReferenceNo($referenceNo)
    {
        $this->reference_no = $referenceNo;

        return $this;
    }

    /**
     * Get reference_no
     *
     * @return string 
     */
    public function getReferenceNo()
    {
        return $this->reference_no;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return GtcwVWorkplace
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return GtcwVWorkplace
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set created_by
     *
     * @param integer $createdBy
     * @return GtcwVWorkplace
     */
    public function setCreatedBy($createdBy)
    {
        $this->created_by = $createdBy;

        return $this;
    }

    /**
     * Get created_by
     *
     * @return integer 
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Set updated_by
     *
     * @param integer $updatedBy
     * @return GtcwVWorkplace
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updated_by = $updatedBy;

        return $this;
    }

    /**
     * Get updated_by
     *
     * @return integer 
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }
    /**
     * @var integer
     */
    private $workplaceTypeId;

    /**
     * @var string
     */
    private $workplaceTypeCode;

    /**
     * @var string
     */
    private $workplaceTypeName;

    /**
     * @var integer
     */
    private $denomId;

    /**
     * @var string
     */
    private $denomCode;

    /**
     * @var string
     */
    private $denomName;

    /**
     * @var string
     */
    private $welshName;


    /**
     * Set workplaceTypeId
     *
     * @param integer $workplaceTypeId
     * @return GtcwVWorkplace
     */
    public function setWorkplaceTypeId($workplaceTypeId)
    {
        $this->workplaceTypeId = $workplaceTypeId;

        return $this;
    }

    /**
     * Get workplaceTypeId
     *
     * @return integer 
     */
    public function getWorkplaceTypeId()
    {
        return $this->workplaceTypeId;
    }

    /**
     * Set workplaceTypeCode
     *
     * @param string $workplaceTypeCode
     * @return GtcwVWorkplace
     */
    public function setWorkplaceTypeCode($workplaceTypeCode)
    {
        $this->workplaceTypeCode = $workplaceTypeCode;

        return $this;
    }

    /**
     * Get workplaceTypeCode
     *
     * @return string 
     */
    public function getWorkplaceTypeCode()
    {
        return $this->workplaceTypeCode;
    }

    /**
     * Set workplaceTypeName
     *
     * @param string $workplaceTypeName
     * @return GtcwVWorkplace
     */
    public function setWorkplaceTypeName($workplaceTypeName)
    {
        $this->workplaceTypeName = $workplaceTypeName;

        return $this;
    }

    /**
     * Get workplaceTypeName
     *
     * @return string 
     */
    public function getWorkplaceTypeName()
    {
        return $this->workplaceTypeName;
    }

    /**
     * Set denomId
     *
     * @param integer $denomId
     * @return GtcwVWorkplace
     */
    public function setDenomId($denomId)
    {
        $this->denomId = $denomId;

        return $this;
    }

    /**
     * Get denomId
     *
     * @return integer 
     */
    public function getDenomId()
    {
        return $this->denomId;
    }

    /**
     * Set denomCode
     *
     * @param string $denomCode
     * @return GtcwVWorkplace
     */
    public function setDenomCode($denomCode)
    {
        $this->denomCode = $denomCode;

        return $this;
    }

    /**
     * Get denomCode
     *
     * @return string 
     */
    public function getDenomCode()
    {
        return $this->denomCode;
    }

    /**
     * Set denomName
     *
     * @param string $denomName
     * @return GtcwVWorkplace
     */
    public function setDenomName($denomName)
    {
        $this->denomName = $denomName;

        return $this;
    }

    /**
     * Get denomName
     *
     * @return string 
     */
    public function getDenomName()
    {
        return $this->denomName;
    }

    /**
     * Set welshName
     *
     * @param string $welshName
     * @return GtcwVWorkplace
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
     * @var integer
     */
    private $employerId;

    /**
     * @var string
     */
    private $employerCode;

    /**
     * @var string
     */
    private $employerName;


    /**
     * Set employerId
     *
     * @param integer $employerId
     * @return GtcwVWorkplace
     */
    public function setEmployerId($employerId)
    {
        $this->employerId = $employerId;

        return $this;
    }

    /**
     * Get employerId
     *
     * @return integer 
     */
    public function getEmployerId()
    {
        return $this->employerId;
    }

    /**
     * Set employerCode
     *
     * @param string $employerCode
     * @return GtcwVWorkplace
     */
    public function setEmployerCode($employerCode)
    {
        $this->employerCode = $employerCode;

        return $this;
    }

    /**
     * Get employerCode
     *
     * @return string 
     */
    public function getEmployerCode()
    {
        return $this->employerCode;
    }

    /**
     * Set employerName
     *
     * @param string $employerName
     * @return GtcwVWorkplace
     */
    public function setEmployerName($employerName)
    {
        $this->employerName = $employerName;

        return $this;
    }

    /**
     * Get employerName
     *
     * @return string 
     */
    public function getEmployerName()
    {
        return $this->employerName;
    }
}
