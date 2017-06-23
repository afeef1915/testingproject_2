<?php

namespace WEBLOGS\MAIN\MTL\MyemailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustomerTasks
 */
class CustomerTasks
{
    /**
     * @var string
     */
    private $ctkCustomerId;

    /**
     * @var string
     */
    private $ctkCode;

    /**
     * @var string
     */
    private $ctkName;


    /**
     * Set ctkCustomerId
     *
     * @param string $ctkCustomerId
     * @return CustomerTasks
     */
    public function setCtkCustomerId($ctkCustomerId)
    {
        $this->ctkCustomerId = $ctkCustomerId;

        return $this;
    }

    /**
     * Get ctkCustomerId
     *
     * @return string 
     */
    public function getCtkCustomerId()
    {
        return $this->ctkCustomerId;
    }

    /**
     * Set ctkCode
     *
     * @param string $ctkCode
     * @return CustomerTasks
     */
    public function setCtkCode($ctkCode)
    {
        $this->ctkCode = $ctkCode;

        return $this;
    }

    /**
     * Get ctkCode
     *
     * @return string 
     */
    public function getCtkCode()
    {
        return $this->ctkCode;
    }

    /**
     * Set ctkName
     *
     * @param string $ctkName
     * @return CustomerTasks
     */
    public function setCtkName($ctkName)
    {
        $this->ctkName = $ctkName;

        return $this;
    }

    /**
     * Get ctkName
     *
     * @return string 
     */
    public function getCtkName()
    {
        return $this->ctkName;
    }
}
