<?php

namespace ESERV\MAIN\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActivityJob
 */
class ActivityJob
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
    private $activity;

    /**
     * @var \ESERV\MAIN\CommunicationsBundle\Entity\DocumentJob
     */
    private $documentJob;


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
     * @return ActivityJob
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
     * @return ActivityJob
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
     * @return ActivityJob
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
     * @return ActivityJob
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
     * Set activity
     *
     * @param \ESERV\MAIN\ActivityBundle\Entity\Activity $activity
     * @return ActivityJob
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
     * Set documentJob
     *
     * @param \ESERV\MAIN\CommunicationsBundle\Entity\DocumentJob $documentJob
     * @return ActivityJob
     */
    public function setDocumentJob(\ESERV\MAIN\CommunicationsBundle\Entity\DocumentJob $documentJob = null)
    {
        $this->documentJob = $documentJob;

        return $this;
    }

    /**
     * Get documentJob
     *
     * @return \ESERV\MAIN\CommunicationsBundle\Entity\DocumentJob 
     */
    public function getDocumentJob()
    {
        return $this->documentJob;
    }
}
