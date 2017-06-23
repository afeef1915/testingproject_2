<?php

namespace ESERV\MAIN\TemplateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MailMergeTypeField
 */
class MailMergeTypeField
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
     * @var \ESERV\MAIN\TemplateBundle\Entity\MailMergeType
     */
    private $mailMergeType;

    /**
     * @var \ESERV\MAIN\TemplateBundle\Entity\MailMergeField
     */
    private $mailMergeField;


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
     * @return MailMergeTypeField
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
     * @return MailMergeTypeField
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
     * @return MailMergeTypeField
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
     * @return MailMergeTypeField
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
     * Set mailMergeType
     *
     * @param \ESERV\MAIN\TemplateBundle\Entity\MailMergeType $mailMergeType
     * @return MailMergeTypeField
     */
    public function setMailMergeType(\ESERV\MAIN\TemplateBundle\Entity\MailMergeType $mailMergeType = null)
    {
        $this->mailMergeType = $mailMergeType;

        return $this;
    }

    /**
     * Get mailMergeType
     *
     * @return \ESERV\MAIN\TemplateBundle\Entity\MailMergeType 
     */
    public function getMailMergeType()
    {
        return $this->mailMergeType;
    }

    /**
     * Set mailMergeField
     *
     * @param \ESERV\MAIN\TemplateBundle\Entity\MailMergeField $mailMergeField
     * @return MailMergeTypeField
     */
    public function setMailMergeField(\ESERV\MAIN\TemplateBundle\Entity\MailMergeField $mailMergeField = null)
    {
        $this->mailMergeField = $mailMergeField;

        return $this;
    }

    /**
     * Get mailMergeField
     *
     * @return \ESERV\MAIN\TemplateBundle\Entity\MailMergeField 
     */
    public function getMailMergeField()
    {
        return $this->mailMergeField;
    }
}
