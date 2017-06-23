<?php

namespace ESERV\MAIN\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActivityComment
 */
class ActivityComment
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $actNote;

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
     * @var \ESERV\MAIN\ActivityBundle\Entity\Activity
     */
    private $activity;

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
     * Set actNote
     *
     * @param string $actNote
     * @return ActivityComment
     */
    public function setActNote($actNote)
    {
        $this->actNote = $actNote;

        return $this;
    }

    /**
     * Get actNote
     *
     * @return string 
     */
    public function getActNote()
    {
        return $this->actNote;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ActivityComment
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
     * @return ActivityComment
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
     * @return ActivityComment
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
     * Set activity
     *
     * @param \ESERV\MAIN\ActivityBundle\Entity\Activity $activity
     * @return ActivityComment
     */
    public function setActivity(\ESERV\MAIN\ActivityBundle\Entity\Activity $activity = null)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return \ESERV\MAIN\ActivityBundle\Entity\Activity 
     */
    public function getActivity()
    {
        return $this->activity;
    }
    /**
     * @var integer
     */
    private $updatedBy;


    /**
     * Set updatedBy
     *
     * @param integer $updatedBy
     * @return ActivityComment
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
}
