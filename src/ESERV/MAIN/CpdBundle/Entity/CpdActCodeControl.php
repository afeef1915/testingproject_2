<?php

namespace ESERV\MAIN\CpdBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CpdActCodeControl
 */
class CpdActCodeControl
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $displayOrder;

    /**
     * @var string
     */
    private $multiRecord;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $createdBy;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $updatedBy;

    /**
     * @var \ESERV\MAIN\CpdBundle\Entity\CpdActCodeControl
     */
    private $cpdActCdCtrl;


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
     * Set code
     *
     * @param string $code
     * @return CpdActCodeControl
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
     * Set name
     *
     * @param string $name
     * @return CpdActCodeControl
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set displayOrder
     *
     * @param integer $displayOrder
     * @return CpdActCodeControl
     */
    public function setDisplayOrder($displayOrder)
    {
        $this->displayOrder = $displayOrder;

        return $this;
    }

    /**
     * Get displayOrder
     *
     * @return integer 
     */
    public function getDisplayOrder()
    {
        return $this->displayOrder;
    }

    /**
     * Set multiRecord
     *
     * @param string $multiRecord
     * @return CpdActCodeControl
     */
    public function setMultiRecord($multiRecord)
    {
        $this->multiRecord = $multiRecord;

        return $this;
    }

    /**
     * Get multiRecord
     *
     * @return string 
     */
    public function getMultiRecord()
    {
        return $this->multiRecord;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return CpdActCodeControl
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
     * Set createdBy
     *
     * @param integer $createdBy
     * @return CpdActCodeControl
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return CpdActCodeControl
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
     * Set updatedBy
     *
     * @param integer $updatedBy
     * @return CpdActCodeControl
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
     * Set cpdActCdCtrl
     *
     * @param \ESERV\MAIN\CpdBundle\Entity\CpdActCodeControl $cpdActCdCtrl
     * @return CpdActCodeControl
     */
    public function setCpdActCdCtrl(\ESERV\MAIN\CpdBundle\Entity\CpdActCodeControl $cpdActCdCtrl = null)
    {
        $this->cpdActCdCtrl = $cpdActCdCtrl;

        return $this;
    }

    /**
     * Get cpdActCdCtrl
     *
     * @return \ESERV\MAIN\CpdBundle\Entity\CpdActCodeControl 
     */
    public function getCpdActCdCtrl()
    {
        return $this->cpdActCdCtrl;
    }
}
