<?php

namespace ESERV\MAIN\WizardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WzType
 */
class WzType
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $code;

    /**
     * @var integer
     */
    private $numOfPages;

    /**
     * @var string
     */
    private $confirmationPage;

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
     * Set description
     *
     * @param string $description
     * @return WzType
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return WzType
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set numOfPages
     *
     * @param integer $numOfPages
     * @return WzType
     */
    public function setNumOfPages($numOfPages)
    {
        $this->numOfPages = $numOfPages;

        return $this;
    }

    /**
     * Get numOfPages
     *
     * @return integer 
     */
    public function getNumOfPages()
    {
        return $this->numOfPages;
    }

    /**
     * Set confirmationPage
     *
     * @param string $confirmationPage
     * @return WzType
     */
    public function setConfirmationPage($confirmationPage)
    {
        $this->confirmationPage = $confirmationPage;

        return $this;
    }

    /**
     * Get confirmationPage
     *
     * @return string 
     */
    public function getConfirmationPage()
    {
        return $this->confirmationPage;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return WzType
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
     * @return WzType
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
     * @return WzType
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
     * @return WzType
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
