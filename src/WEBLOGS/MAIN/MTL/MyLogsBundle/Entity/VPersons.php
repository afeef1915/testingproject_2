<?php

namespace WEBLOGS\MAIN\MTL\MyLogsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VPersons
 */
class VPersons
{
    /**
     * @var string
     */
    private $person_id;

    /**
     * @var string
     */
    private $fullname;

    /**
     * @var string
     */
    private $forename;


    /**
     * Set person_id
     *
     * @param string $personId
     * @return VPersons
     */
    public function setPersonId($personId)
    {
        $this->person_id = $personId;

        return $this;
    }

    /**
     * Get person_id
     *
     * @return string 
     */
    public function getPersonId()
    {
        return $this->person_id;
    }

    /**
     * Set fullname
     *
     * @param string $fullname
     * @return VPersons
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string 
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set forename
     *
     * @param string $forename
     * @return VPersons
     */
    public function setForename($forename)
    {
        $this->forename = $forename;

        return $this;
    }

    /**
     * Get forename
     *
     * @return string 
     */
    public function getForename()
    {
        return $this->forename;
    }
}
