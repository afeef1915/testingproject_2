<?php

namespace WEBLOGS\MAIN\MTL\MyLogsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogClientStatus
 */
class LogClientStatus
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
     * @return LogClientStatus
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
     * @return LogClientStatus
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
}
