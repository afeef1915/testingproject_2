<?php

namespace WEBLOGS\MAIN\MTL\MyLogsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustomerCategories
 */
class CustomerCategories
{
    /**
     * @var string
     */
    private $customer_id;

    /**
     * @var string
     */
    private $category_code;


    /**
     * Set customer_id
     *
     * @param string $customerId
     * @return CustomerCategories
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
     * Set category_code
     *
     * @param string $categoryCode
     * @return CustomerCategories
     */
    public function setCategoryCode($categoryCode)
    {
        $this->category_code = $categoryCode;

        return $this;
    }

    /**
     * Get category_code
     *
     * @return string 
     */
    public function getCategoryCode()
    {
        return $this->category_code;
    }
}
