<?php

namespace WEBLOGS\MAIN\MTL\DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserCustomer
 */
class UserCustomer
{
    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $customer_id;


    /**
     * Set userId
     *
     * @param string $userId
     * @return UserCustomer
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return string 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set customer_id
     *
     * @param string $customerId
     * @return UserCustomer
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
}
