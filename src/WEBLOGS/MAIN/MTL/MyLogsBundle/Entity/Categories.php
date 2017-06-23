<?php

namespace WEBLOGS\MAIN\MTL\MyLogsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 */
class Categories
{
    /**
     * @var string
     */
    private $CATEGORY_CODE;

    /**
     * @var string
     */
    private $NAME;

    /**
     * @var string
     */
    private $SHORT_NAME;


    /**
     * Set CATEGORY_CODE
     *
     * @param string $cATEGORYCODE
     * @return Categories
     */
    public function setCATEGORYCODE($cATEGORYCODE)
    {
        $this->CATEGORY_CODE = $cATEGORYCODE;

        return $this;
    }

    /**
     * Get CATEGORY_CODE
     *
     * @return string 
     */
    public function getCATEGORYCODE()
    {
        return $this->CATEGORY_CODE;
    }

    /**
     * Set NAME
     *
     * @param string $nAME
     * @return Categories
     */
    public function setNAME($nAME)
    {
        $this->NAME = $nAME;

        return $this;
    }

    /**
     * Get NAME
     *
     * @return string 
     */
    public function getNAME()
    {
        return $this->NAME;
    }

    /**
     * Set SHORT_NAME
     *
     * @param string $sHORTNAME
     * @return Categories
     */
    public function setSHORTNAME($sHORTNAME)
    {
        $this->SHORT_NAME = $sHORTNAME;

        return $this;
    }

    /**
     * Get SHORT_NAME
     *
     * @return string 
     */
    public function getSHORTNAME()
    {
        return $this->SHORT_NAME;
    }
}
