<?php

namespace WEBLOGS\MAIN\MTL\MyLogsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VWwvLogAction
 */
class VWwvLogAction
{
    /**
     * @var string
     */
    private $ACTION_ID;

    /**
     * @var string
     */
    private $DESCRIPTION;


    /**
     * Set ACTION_ID
     *
     * @param string $aCTIONID
     * @return VWwvLogAction
     */
    public function setACTIONID($aCTIONID)
    {
        $this->ACTION_ID = $aCTIONID;

        return $this;
    }

    /**
     * Get ACTION_ID
     *
     * @return string 
     */
    public function getACTIONID()
    {
        return $this->ACTION_ID;
    }

    /**
     * Set DESCRIPTION
     *
     * @param string $dESCRIPTION
     * @return VWwvLogAction
     */
    public function setDESCRIPTION($dESCRIPTION)
    {
        $this->DESCRIPTION = $dESCRIPTION;

        return $this;
    }

    /**
     * Get DESCRIPTION
     *
     * @return string 
     */
    public function getDESCRIPTION()
    {
        return $this->DESCRIPTION;
    }
    
    
    //to solve the problem we used to string function//
    //An error occurred:: Catchable Fatal Error: Object of class WEBLOGS\MAIN\MTL\MyLogsBundle\Entity\VWwvLogAction could not be converted to string"

    public function __toString() {
       return $this->DESCRIPTION;
       }
}
