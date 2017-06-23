<?php

namespace ESERV\MAIN\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FosUserGroup
 */
class ESERVUserGroup
{ 
    /**
     * @var integer
     */
    private $userId;

    /**
     * @var \ESERV\MAIN\SecurityBundle\Entity\User
     */
    private $user;

    /**
     * @var \ESERV\MAIN\SecurityBundle\Entity\Group
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
     * @param \ESERV\MAIN\SecurityBundle\Entity\User $user
     * @return FosUserGroup
     */
    public function setUser(\ESERV\MAIN\SecurityBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \ESERV\MAIN\SecurityBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set group
     *
     * @param \ESERV\MAIN\SecurityBundle\Entity\Group $group
     * @return FosUserGroup
     */
    public function setGroup(\ESERV\MAIN\SecurityBundle\Entity\Group $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \ESERV\MAIN\SecurityBundle\Entity\Group 
     */
    public function getGroup()
    {
        return $this->group;
    }
}
