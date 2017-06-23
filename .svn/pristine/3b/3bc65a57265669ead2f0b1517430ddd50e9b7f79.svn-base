<?php

namespace Security\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FosUserGroup
 */
class FosUserGroup
{ 
    /**
     * @var integer
     */
    private $userId;

    /**
     * @var \Security\UserBundle\Entity\User
     */
    private $user;

    /**
     * @var \Security\UserBundle\Entity\Group
     */
    private $group;


    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set user
     *
     * @param \Security\UserBundle\Entity\User $user
     * @return FosUserGroup
     */
    public function setUser(\Security\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Security\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set group
     *
     * @param \Security\UserBundle\Entity\Group $group
     * @return FosUserGroup
     */
    public function setGroup(\Security\UserBundle\Entity\Group $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \Security\UserBundle\Entity\Group 
     */
    public function getGroup()
    {
        return $this->group;
    }
}
