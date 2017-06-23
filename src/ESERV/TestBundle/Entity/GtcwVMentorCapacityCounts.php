<?php

namespace ESERV\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GtcwVMentorCapacityCounts
 */
class GtcwVMentorCapacityCounts
{
    /**
     * @var integer
     */
    private $dtindex;

    /**
     * @var integer
     */
    private $contactId;

    /**
     * @var integer
     */
    private $gtcwMentorId;

    /**
     * @var string
     */
    private $noOfMenteesIndOnly;

    /**
     * @var string
     */
    private $noOfMenteesIndAndMep;

    /**
     * @var string
     */
    private $noOfMenteesMepOnly;

    /**
     * @var string
     */
    private $noOfMenteesShortTerm;


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
     * Set contactId
     *
     * @param integer $contactId
     * @return GtcwVMentorCapacityCounts
     */
    public function setContactId($contactId)
    {
        $this->contactId = $contactId;

        return $this;
    }

    /**
     * Get contactId
     *
     * @return integer 
     */
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * Set gtcwMentorId
     *
     * @param integer $gtcwMentorId
     * @return GtcwVMentorCapacityCounts
     */
    public function setGtcwMentorId($gtcwMentorId)
    {
        $this->gtcwMentorId = $gtcwMentorId;

        return $this;
    }

    /**
     * Get gtcwMentorId
     *
     * @return integer 
     */
    public function getGtcwMentorId()
    {
        return $this->gtcwMentorId;
    }

    /**
     * Set noOfMenteesIndOnly
     *
     * @param string $noOfMenteesIndOnly
     * @return GtcwVMentorCapacityCounts
     */
    public function setNoOfMenteesIndOnly($noOfMenteesIndOnly)
    {
        $this->noOfMenteesIndOnly = $noOfMenteesIndOnly;

        return $this;
    }

    /**
     * Get noOfMenteesIndOnly
     *
     * @return string 
     */
    public function getNoOfMenteesIndOnly()
    {
        return $this->noOfMenteesIndOnly;
    }

    /**
     * Set noOfMenteesIndAndMep
     *
     * @param string $noOfMenteesIndAndMep
     * @return GtcwVMentorCapacityCounts
     */
    public function setNoOfMenteesIndAndMep($noOfMenteesIndAndMep)
    {
        $this->noOfMenteesIndAndMep = $noOfMenteesIndAndMep;

        return $this;
    }

    /**
     * Get noOfMenteesIndAndMep
     *
     * @return string 
     */
    public function getNoOfMenteesIndAndMep()
    {
        return $this->noOfMenteesIndAndMep;
    }

    /**
     * Set noOfMenteesMepOnly
     *
     * @param string $noOfMenteesMepOnly
     * @return GtcwVMentorCapacityCounts
     */
    public function setNoOfMenteesMepOnly($noOfMenteesMepOnly)
    {
        $this->noOfMenteesMepOnly = $noOfMenteesMepOnly;

        return $this;
    }

    /**
     * Get noOfMenteesMepOnly
     *
     * @return string 
     */
    public function getNoOfMenteesMepOnly()
    {
        return $this->noOfMenteesMepOnly;
    }

    /**
     * Set noOfMenteesShortTerm
     *
     * @param string $noOfMenteesShortTerm
     * @return GtcwVMentorCapacityCounts
     */
    public function setNoOfMenteesShortTerm($noOfMenteesShortTerm)
    {
        $this->noOfMenteesShortTerm = $noOfMenteesShortTerm;

        return $this;
    }

    /**
     * Get noOfMenteesShortTerm
     *
     * @return string 
     */
    public function getNoOfMenteesShortTerm()
    {
        return $this->noOfMenteesShortTerm;
    }
}
