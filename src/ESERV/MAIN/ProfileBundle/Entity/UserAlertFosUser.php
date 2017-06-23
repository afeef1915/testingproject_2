<?php

namespace ESERV\MAIN\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserAlertFosUser
 */
class UserAlertFosUser
{
    
    
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $createdBy;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $updatedBy;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \ESERV\MAIN\ProfileBundle\Entity\UserAlertDetail
     */
    private $userAlertDetail;

    /**
     * @var \ESERV\MAIN\SecurityBundle\Entity\User
     */
    private $fosUser;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return UserAlertFosUser
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return integer 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return UserAlertFosUser
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedBy
     *
     * @param integer $updatedBy
     * @return UserAlertFosUser
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return integer 
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return UserAlertFosUser
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set userAlertDetail
     *
     * @param \ESERV\MAIN\ProfileBundle\Entity\UserAlertDetail $userAlertDetail
     * @return UserAlertFosUser
     */
    public function setUserAlertDetail(\ESERV\MAIN\ProfileBundle\Entity\UserAlertDetail $userAlertDetail = null)
    {
        $this->userAlertDetail = $userAlertDetail;

        return $this;
    }

    /**
     * Get userAlertDetail
     *
     * @return \ESERV\MAIN\ProfileBundle\Entity\UserAlertDetail 
     */
    public function getUserAlertDetail()
    {
        return $this->userAlertDetail;
    }

    /**
     * Set fosUser
     *
     * @param \ESERV\MAIN\SecurityBundle\Entity\User $fosUser
     * @return UserAlertFosUser
     */
    public function setFosUser(\ESERV\MAIN\SecurityBundle\Entity\User $fosUser = null)
    {
        $this->fosUser = $fosUser;

        return $this;
    }

    /**
     * Get fosUser
     *
     * @return \ESERV\MAIN\SecurityBundle\Entity\User 
     */
    public function getFosUser()
    {
        return $this->fosUser;
    }
}
