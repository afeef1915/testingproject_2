<?php

namespace WEBLOGS\MAIN\MTL\MyLogsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Customers
 */
class Customers
{
    /**
     * @var string
     */
    private $customer_id;

    /**
     * @var string
     */
    private $name;


    /**
     * Set customer_id
     *
     * @param string $customerId
     * @return Customers
     */
    public function setCustomerId($customerId)
    {
        $this->customer_id = $customerId;

        return $this;
    }

    /**
     * Get customer_id
     *
     * @return string 
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Customers
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
