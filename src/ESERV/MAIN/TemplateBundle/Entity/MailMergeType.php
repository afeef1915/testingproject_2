<?php

namespace ESERV\MAIN\TemplateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MailMergeType
 */
class MailMergeType
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $value;

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
     * Set value
     *
     * @param string $value
     * @return MailMergeType
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return MailMergeType
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
     * @return MailMergeType
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
     * @return MailMergeType
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
     * @return MailMergeType
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
     * @var \ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList
     */
    private $contactSubtypeList;


    /**
     * Set contactSubtypeList
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList $contactSubtypeList
     * @return MailMergeType
     */
    public function setContactSubtypeList(\ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList $contactSubtypeList = null)
    {
        $this->contactSubtypeList = $contactSubtypeList;

        return $this;
    }

    /**
     * Get contactSubtypeList
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\ContactSubtypeList 
     */
    public function getContactSubtypeList()
    {
        return $this->contactSubtypeList;
    }
}
