<?php

namespace ESERV\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GtcwVActivitySubCategory
 */
class GtcwVActivitySubCategory
{
    /**
     * @var integer
     */
    private $activity_sub_category_id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $activity_category;


    /**
     * Get activity_sub_category_id
     *
     * @return integer 
     */
    public function getActivitySubCategoryId()
    {
        return $this->activity_sub_category_id;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return GtcwVActivitySubCategory
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return GtcwVActivitySubCategory
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set activity_category
     *
     * @param string $activityCategory
     * @return GtcwVActivitySubCategory
     */
    public function setActivityCategory($activityCategory)
    {
        $this->activity_category = $activityCategory;

        return $this;
    }

    /**
     * Get activity_category
     *
     * @return string 
     */
    public function getActivityCategory()
    {
        return $this->activity_category;
    }
}
