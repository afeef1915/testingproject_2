<?php

namespace ESERV\MAIN\CommunicationsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentJob
 */
class DocumentJob
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $processedDate;

    /**
     * @var \DateTime
     */
    private $queuedDate;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set processedDate
     *
     * @param \DateTime $processedDate
     * @return DocumentJob
     */
    public function setProcessedDate($processedDate)
    {
        $this->processedDate = $processedDate;

        return $this;
    }

    /**
     * Get processedDate
     *
     * @return \DateTime 
     */
    public function getProcessedDate()
    {
        return $this->processedDate;
    }

    /**
     * Set queuedDate
     *
     * @param \DateTime $queuedDate
     * @return DocumentJob
     */
    public function setQueuedDate($queuedDate)
    {
        $this->queuedDate = $queuedDate;

        return $this;
    }

    /**
     * Get queuedDate
     *
     * @return \DateTime 
     */
    public function getQueuedDate()
    {
        return $this->queuedDate;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return DocumentJob
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
     * @return DocumentJob
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
     * @return DocumentJob
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
     * @return DocumentJob
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
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\SystemPrinter
     */
    private $systemPrinter;


    /**
     * Set systemPrinter
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\SystemPrinter $systemPrinter
     * @return DocumentJob
     */
    public function setSystemPrinter(\ESERV\MAIN\SystemConfigBundle\Entity\SystemPrinter $systemPrinter = null)
    {
        $this->systemPrinter = $systemPrinter;

        return $this;
    }

    /**
     * Get systemPrinter
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\SystemPrinter 
     */
    public function getSystemPrinter()
    {
        return $this->systemPrinter;
    }
}
