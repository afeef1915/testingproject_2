<?php

namespace ESERV\MAIN\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActivityLink
 */
class ActivityLink
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $createdBy;

    /**
     * @var integer
     */
    private $updatedBy;

    /**
     * @var \ESERV\MAIN\ActivityBundle\Entity\Activity
     */
    private $originalActivity;

    /**
     * @var \ESERV\MAIN\ActivityBundle\Entity\Activity
     */
    private $linkedActivity;


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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ActivityLink
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return ActivityLink
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
     * Set createdBy
     *
     * @param integer $createdBy
     * @return ActivityLink
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
     * Set updatedBy
     *
     * @param integer $updatedBy
     * @return ActivityLink
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
     * Set originalActivity
     *
     * @param \ESERV\MAIN\ActivityBundle\Entity\Activity $originalActivity
     * @return ActivityLink
     */
    public function setOriginalActivity(\ESERV\MAIN\ActivityBundle\Entity\Activity $originalActivity = null)
    {
        $this->originalActivity = $originalActivity;

        return $this;
    }

    /**
     * Get originalActivity
     *
     * @return \ESERV\MAIN\ActivityBundle\Entity\Activity 
     */
    public function getOriginalActivity()
    {
        return $this->originalActivity;
    }

    /**
     * Set linkedActivity
     *
     * @param \ESERV\MAIN\ActivityBundle\Entity\Activity $linkedActivity
     * @return ActivityLink
     */
    public function setLinkedActivity(\ESERV\MAIN\ActivityBundle\Entity\Activity $linkedActivity = null)
    {
        $this->linkedActivity = $linkedActivity;

        return $this;
    }

    /**
     * Get linkedActivity
     *
     * @return \ESERV\MAIN\ActivityBundle\Entity\Activity 
     */
    public function getLinkedActivity()
    {
        return $this->linkedActivity;
    }
}
