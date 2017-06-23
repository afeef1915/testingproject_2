<?php

namespace ESERV\MAIN\HelpersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AltLanguageMmhelpEquiv
 */
class AltLanguageMmhelpEquiv
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $altTitle;

    /**
     * @var string
     */
    private $altDescription;

    /**
     * @var \ESERV\MAIN\HelpersBundle\Entity\AltLanguage
     */
    private $altLanguage;

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
     * Set altTitle
     *
     * @param string $altTitle
     * @return AltLanguageMmhelpEquiv
     */
    public function setAltTitle($altTitle)
    {
        $this->altTitle = $altTitle;

        return $this;
    }

    /**
     * Get altTitle
     *
     * @return string 
     */
    public function getAltTitle()
    {
        return $this->altTitle;
    }

    /**
     * Set altDescription
     *
     * @param string $altDescription
     * @return AltLanguageMmhelpEquiv
     */
    public function setAltDescription($altDescription)
    {
        $this->altDescription = $altDescription;

        return $this;
    }

    /**
     * Get altDescription
     *
     * @return string 
     */
    public function getAltDescription()
    {
        return $this->altDescription;
    }

    /**
     * Set altLanguage
     *
     * @param \ESERV\MAIN\HelpersBundle\Entity\AltLanguage $altLanguage
     * @return AltLanguageMmhelpEquiv
     */
    public function setAltLanguage(\ESERV\MAIN\HelpersBundle\Entity\AltLanguage $altLanguage = null)
    {
        $this->altLanguage = $altLanguage;

        return $this;
    }

    /**
     * Get altLanguage
     *
     * @return \ESERV\MAIN\HelpersBundle\Entity\AltLanguage 
     */
    public function getAltLanguage()
    {
        return $this->altLanguage;
    }

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return AltLanguageMmhelpEquiv
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
     * @return AltLanguageMmhelpEquiv
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
     * @return AltLanguageMmhelpEquiv
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
     * @return AltLanguageMmhelpEquiv
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
     * @var \ESERV\MAIN\ProfileBundle\Entity\MmHelpMessage
     */
    private $mmHelpMessage;


    /**
     * Set mmHelpMessage
     *
     * @param \ESERV\MAIN\ProfileBundle\Entity\MmHelpMessage $mmHelpMessage
     * @return AltLanguageMmhelpEquiv
     */
    public function setMmHelpMessage(\ESERV\MAIN\ProfileBundle\Entity\MmHelpMessage $mmHelpMessage = null)
    {
        $this->mmHelpMessage = $mmHelpMessage;

        return $this;
    }

    /**
     * Get mmHelpMessage
     *
     * @return \ESERV\MAIN\ProfileBundle\Entity\MmHelpMessage 
     */
    public function getMmHelpMessage()
    {
        return $this->mmHelpMessage;
    }
}
