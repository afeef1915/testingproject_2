<?php

namespace ESERV\MAIN\ProfileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserAlertDetail
 */
class UserAlertDetail
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
     * @var \ESERV\MAIN\ProfileBundle\Entity\UserAlert
     */
    private $userAlert;

    /**
     * @var \ESERV\MAIN\TableQueryBundle\Entity\QueryMaster
     */
    private $queryMaster;


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
     * @return UserAlertDetail
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
     * @return UserAlertDetail
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
     * @return UserAlertDetail
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
     * @return UserAlertDetail
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
     * Set userAlert
     *
     * @param \ESERV\MAIN\ProfileBundle\Entity\UserAlert $userAlert
     * @return UserAlertDetail
     */
    public function setUserAlert(\ESERV\MAIN\ProfileBundle\Entity\UserAlert $userAlert = null)
    {
        $this->userAlert = $userAlert;

        return $this;
    }

    /**
     * Get userAlert
     *
     * @return \ESERV\MAIN\ProfileBundle\Entity\UserAlert 
     */
    public function getUserAlert()
    {
        return $this->userAlert;
    }

    /**
     * Set queryMaster
     *
     * @param \ESERV\MAIN\TableQueryBundle\Entity\QueryMaster $queryMaster
     * @return UserAlertDetail
     */
    public function setQueryMaster(\ESERV\MAIN\TableQueryBundle\Entity\QueryMaster $queryMaster = null)
    {
        $this->queryMaster = $queryMaster;

        return $this;
    }

    /**
     * Get queryMaster
     *
     * @return \ESERV\MAIN\TableQueryBundle\Entity\QueryMaster 
     */
    public function getQueryMaster()
    {
        return $this->queryMaster;
    }
}
