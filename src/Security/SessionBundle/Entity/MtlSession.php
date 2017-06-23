<?php

namespace Security\SessionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MtlSession
 */
class MtlSession
{
    /**
     * @var string
     */
    private $sessionId;

    /**
     * @var string
     */
    private $sessionValue;

    /**
     * @var integer
     */
    private $sessionTime;


    /**
     * Get sessionId
     *
     * @return string 
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * Set sessionValue
     *
     * @param string $sessionValue
     * @return MtlSession
     */
    public function setSessionValue($sessionValue)
    {
        $this->sessionValue = $sessionValue;

        return $this;
    }

    /**
     * Get sessionValue
     *
     * @return string 
     */
    public function getSessionValue()
    {
        return $this->sessionValue;
    }

    /**
     * Set sessionTime
     *
     * @param integer $sessionTime
     * @return MtlSession
     */
    public function setSessionTime($sessionTime)
    {
        $this->sessionTime = $sessionTime;

        return $this;
    }

    /**
     * Get sessionTime
     *
     * @return integer 
     */
    public function getSessionTime()
    {
        return $this->sessionTime;
    }
}
