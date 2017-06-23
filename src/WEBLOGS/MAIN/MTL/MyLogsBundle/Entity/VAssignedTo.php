<?php

namespace WEBLOGS\MAIN\MTL\MyLogsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VAssignedTo
 */
class VAssignedTo
{
    /**
     * @var string
     */
    private $user_display_name;

    /**
     * @var string
     */
    private $user_id;

    /**
     * @var string
     */
    private $csev_mtlgroup;


    /**
     * Set user_display_name
     *
     * @param string $userDisplayName
     * @return VAssignedTo
     */
    public function setUserDisplayName($userDisplayName)
    {
        $this->user_display_name = $userDisplayName;

        return $this;
    }

    /**
     * Get user_display_name
     *
     * @return string 
     */
    public function getUserDisplayName()
    {
        return $this->user_display_name;
    }

    /**
     * Set user_id
     *
     * @param string $userId
     * @return VAssignedTo
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get user_id
     *
     * @return string 
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set csev_mtlgroup
     *
     * @param string $csevMtlgroup
     * @return VAssignedTo
     */
    public function setCsevMtlgroup($csevMtlgroup)
    {
        $this->csev_mtlgroup = $csevMtlgroup;

        return $this;
    }

    /**
     * Get csev_mtlgroup
     *
     * @return string 
     */
    public function getCsevMtlgroup()
    {
        return $this->csev_mtlgroup;
    }
}
