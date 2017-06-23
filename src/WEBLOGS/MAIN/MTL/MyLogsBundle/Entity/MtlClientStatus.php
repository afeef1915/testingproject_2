<?php

namespace WEBLOGS\MAIN\MTL\MyLogsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MtlClientStatus
 */
class MtlClientStatus
{
    /**
     * @var string
     */
    private $LOG_ID;

    /**
     * @var string
     */
    private $STATUS;

    /**
     * @var \DateTime
     */
    private $START_DATE;

    /**
     * @var \DateTime
     */
    private $END_DATE;


    /**
     * Set LOG_ID
     *
     * @param string $lOGID
     * @return MtlClientStatus
     */
    public function setLOGID($lOGID)
    {
        $this->LOG_ID = $lOGID;

        return $this;
    }

    /**
     * Get LOG_ID
     *
     * @return string 
     */
    public function getLOGID()
    {
        return $this->LOG_ID;
    }

    /**
     * Set STATUS
     *
     * @param string $sTATUS
     * @return MtlClientStatus
     */
    public function setSTATUS($sTATUS)
    {
        $this->STATUS = $sTATUS;

        return $this;
    }

    /**
     * Get STATUS
     *
     * @return string 
     */
    public function getSTATUS()
    {
        return $this->STATUS;
    }

    /**
     * Set START_DATE
     *
     * @param \DateTime $sTARTDATE
     * @return MtlClientStatus
     */
    public function setSTARTDATE($sTARTDATE)
    {
        $this->START_DATE = $sTARTDATE;

        return $this;
    }

    /**
     * Get START_DATE
     *
     * @return \DateTime 
     */
    public function getSTARTDATE()
    {
        return $this->START_DATE;
    }

    /**
     * Set END_DATE
     *
     * @param \DateTime $eNDDATE
     * @return MtlClientStatus
     */
    public function setENDDATE($eNDDATE)
    {
        $this->END_DATE = $eNDDATE;

        return $this;
    }

    /**
     * Get END_DATE
     *
     * @return \DateTime 
     */
    public function getENDDATE()
    {
        return $this->END_DATE;
    }
}
