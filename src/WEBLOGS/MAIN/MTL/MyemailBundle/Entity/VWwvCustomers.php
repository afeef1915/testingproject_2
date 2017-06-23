<?php

namespace WEBLOGS\MAIN\MTL\MyemailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VWwvCustomers
 */
class VWwvCustomers
{
    /**
     * @var string
     */
    private $customerId;

    /**
     * @var string
     */
    private $name;


    /**
     * Set customerId
     *
     * @param string $customerId
     * @return VWwvCustomers
     */
    
public function __toString() {
    return $this->name;
}
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return string 
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return VWwvCustomers
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
}
