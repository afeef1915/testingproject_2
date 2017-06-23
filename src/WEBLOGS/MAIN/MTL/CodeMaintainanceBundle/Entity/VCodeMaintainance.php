<?php

namespace WEBLOGS\MAIN\MTL\CodeMaintainanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VCodeMaintainance
 */
class VCodeMaintainance
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
    private $task_name;

    /**
     * @var string
     */
    private $customer_name;


    /**
     * Set ctk_customer_id
     *
     * @param string $ctkCustomerId
     * @return VCodeMaintainance
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
     * @return VCodeMaintainance
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
     * Set task_name
     *
     * @param string $taskName
     * @return VCodeMaintainance
     */
    public function setTaskName($taskName)
    {
        $this->task_name = $taskName;

        return $this;
    }

    /**
     * Get task_name
     *
     * @return string 
     */
    public function getTaskName()
    {
        return $this->task_name;
    }

    /**
     * Set customer_name
     *
     * @param string $customerName
     * @return VCodeMaintainance
     */
    public function setCustomerName($customerName)
    {
        $this->customer_name = $customerName;

        return $this;
    }

    /**
     * Get customer_name
     *
     * @return string 
     */
    public function getCustomerName()
    {
        return $this->customer_name;
    }
    /**
     * @var string
     */
    private $ctk_budget_code;


    /**
     * Set ctk_budget_code
     *
     * @param string $ctkBudgetCode
     * @return VCodeMaintainance
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
