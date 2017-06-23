<?php

namespace ESERV\MAIN\TemplateBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Template
 */
class Template
{ 
    /**
     * @var integer
     */
    private $id;

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
    private $isDefault;

    /**
     * @var string
     */
    private $reportId;

    /**
     * @var integer
     */
    private $version;

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
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\Language
     */
    private $language;

    /**
     * @var \ESERV\MAIN\TemplateBundle\Entity\MailMergeType
     */
    private $mailMergeType;

    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode
     */
    private $templateDocumentGroup;

    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\SystemPrinter
     */
    private $systemPrinter;

    /**
     * @var \ESERV\MAIN\TemplateBundle\Entity\Template
     */
    private $header;

    /**
     * @var \ESERV\MAIN\TemplateBundle\Entity\Template
     */
    private $footer;

    /**
     * @var \ESERV\MAIN\TemplateBundle\Entity\TemplateType
     */
    private $templateType;


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
     * Set content
     *
     * @param string $content
     * @return Template
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
     * @return Template
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
     * @return Template
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
     * Set isDefault
     *
     * @param string $isDefault
     * @return Template
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    /**
     * Get isDefault
     *
     * @return string 
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }

    /**
     * Set reportId
     *
     * @param string $reportId
     * @return Template
     */
    public function setReportId($reportId)
    {
        $this->reportId = $reportId;

        return $this;
    }

    /**
     * Get reportId
     *
     * @return string 
     */
    public function getReportId()
    {
        return $this->reportId;
    }

    /**
     * Set version
     *
     * @param integer $version
     * @return Template
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Template
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
     * @return Template
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
     * @return Template
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
     * @return Template
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
     * Set language
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\Language $language
     * @return Template
     */
    public function setLanguage(\ESERV\MAIN\SystemConfigBundle\Entity\Language $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\Language 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set mailMergeType
     *
     * @param \ESERV\MAIN\TemplateBundle\Entity\MailMergeType $mailMergeType
     * @return Template
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
     * Set templateDocumentGroup
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $templateDocumentGroup
     * @return Template
     */
    public function setTemplateDocumentGroup(\ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $templateDocumentGroup = null)
    {
        $this->templateDocumentGroup = $templateDocumentGroup;

        return $this;
    }

    /**
     * Get templateDocumentGroup
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode 
     */
    public function getTemplateDocumentGroup()
    {
        return $this->templateDocumentGroup;
    }

    /**
     * Set systemPrinter
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\SystemPrinter $systemPrinter
     * @return Template
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

    /**
     * Set header
     *
     * @param \ESERV\MAIN\TemplateBundle\Entity\Template $header
     * @return Template
     */
    public function setHeader(\ESERV\MAIN\TemplateBundle\Entity\Template $header = null)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return \ESERV\MAIN\TemplateBundle\Entity\Template 
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set footer
     *
     * @param \ESERV\MAIN\TemplateBundle\Entity\Template $footer
     * @return Template
     */
    public function setFooter(\ESERV\MAIN\TemplateBundle\Entity\Template $footer = null)
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * Get footer
     *
     * @return \ESERV\MAIN\TemplateBundle\Entity\Template 
     */
    public function getFooter()
    {
        return $this->footer;
    }

    /**
     * Set templateType
     *
     * @param \ESERV\MAIN\TemplateBundle\Entity\TemplateType $templateType
     * @return Template
     */
    public function setTemplateType(\ESERV\MAIN\TemplateBundle\Entity\TemplateType $templateType = null)
    {
        $this->templateType = $templateType;

        return $this;
    }

    /**
     * Get templateType
     *
     * @return \ESERV\MAIN\TemplateBundle\Entity\TemplateType 
     */
    public function getTemplateType()
    {
        return $this->templateType;
    }
}
