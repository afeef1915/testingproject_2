<?php

namespace ESERV\MAIN\TemplateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EservVTemplate
 */
class EservVTemplate
{
   
    /**
     * @var integer
     */
    private $templateId;

    /**
     * @var integer
     */
    private $dtindex;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $templateType;

    /**
     * @var string
     */
    private $templateDocumentType;

    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $version;

    /**
     * @var string
     */
    private $mailMergeType;


    /**
     * Get templateId
     *
     * @return integer 
     */
    public function getTemplateId()
    {
        return $this->templateId;
    }

    /**
     * Set dtindex
     *
     * @param integer $dtindex
     * @return EservVTemplate
     */
    public function setDtindex($dtindex)
    {
        $this->dtindex = $dtindex;

        return $this;
    }

    /**
     * Get dtindex
     *
     * @return integer 
     */
    public function getDtindex()
    {
        return $this->dtindex;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return EservVTemplate
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return EservVTemplate
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
     * @return EservVTemplate
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
     * Set templateType
     *
     * @param string $templateType
     * @return EservVTemplate
     */
    public function setTemplateType($templateType)
    {
        $this->templateType = $templateType;

        return $this;
    }

    /**
     * Get templateType
     *
     * @return string 
     */
    public function getTemplateType()
    {
        return $this->templateType;
    }

    /**
     * Set templateDocumentType
     *
     * @param string $templateDocumentType
     * @return EservVTemplate
     */
    public function setTemplateDocumentType($templateDocumentType)
    {
        $this->templateDocumentType = $templateDocumentType;

        return $this;
    }

    /**
     * Get templateDocumentType
     *
     * @return string 
     */
    public function getTemplateDocumentType()
    {
        return $this->templateDocumentType;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return EservVTemplate
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set version
     *
     * @param string $version
     * @return EservVTemplate
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set mailMergeType
     *
     * @param string $mailMergeType
     * @return EservVTemplate
     */
    public function setMailMergeType($mailMergeType)
    {
        $this->mailMergeType = $mailMergeType;

        return $this;
    }

    /**
     * Get mailMergeType
     *
     * @return string 
     */
    public function getMailMergeType()
    {
        return $this->mailMergeType;
    }
    /**
     * @var string
     */
    private $createdBy;

    /**
     * @var \DateTime
     */
    private $createdAt;


    /**
     * Set createdBy
     *
     * @param string $createdBy
     * @return EservVTemplate
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return string 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return EservVTemplate
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
     * @var string
     */
    private $gotoUrl;


    /**
     * Set gotoUrl
     *
     * @param string $gotoUrl
     * @return EservVTemplate
     */
    public function setGotoUrl($gotoUrl)
    {
        $this->gotoUrl = $gotoUrl;

        return $this;
    }

    /**
     * Get gotoUrl
     *
     * @return string 
     */
    public function getGotoUrl()
    {
        return $this->gotoUrl;
    }
}
