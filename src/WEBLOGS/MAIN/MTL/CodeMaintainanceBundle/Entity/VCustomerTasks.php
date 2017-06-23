<?php

namespace WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VCustomerTasks
 */
class VCustomerTasks
{
    /**
     * @var string
     */
    private $ctk_customer_id;

    /**
     * @var string
     */
    private $ctk_code;

    /**
     * @var string
     */
    private $ctk_name;


    /**
     * Set ctk_customer_id
     *
     * @param string $ctkCustomerId
     * @return VCustomerTasks
     */
    public function setCtkCustomerId($ctkCustomerId)
    {
        $this->ctk_customer_id = $ctkCustomerId;

        return $this;
    }

    /**
     * Get ctk_customer_id
     *
     * @return string 
     */
    public function getCtkCustomerId()
    {
        return $this->ctk_customer_id;
    }

    /**
     * Set ctk_code
     *
     * @param string $ctkCode
     * @return VCustomerTasks
     */
    public function setCtkCode($ctkCode)
    {
        $this->ctk_code = $ctkCode;

        return $this;
    }

    /**
     * Get ctk_code
     *
     * @return string 
     */
    public function getCtkCode()
    {
        return $this->ctk_code;
    }

    /**
     * Set ctk_name
     *
     * @param string $ctkName
     * @return VCustomerTasks
     */
    public function setCtkName($ctkName)
    {
        $this->ctk_name = $ctkName;

        return $this;
    }

    /**
     * Get ctk_name
     *
     * @return string 
     */
    public function getCtkName()
    {
        return $this->ctk_name;
    }
    /**
     * @var string
     */
    private $ctk_budget_code;


    /**
     * Set ctk_budget_code
     *
     * @param string $ctkBudgetCode
     * @return VCustomerTasks
     */
    public function setCtkBudgetCode($ctkBudgetCode)
    {
        $this->ctk_budget_code = $ctkBudgetCode;

        return $this;
    }

    /**
     * Get ctk_budget_code
     *
     * @return string 
     */
    public function getCtkBudgetCode()
    {
        return $this->ctk_budget_code;
    }
}
