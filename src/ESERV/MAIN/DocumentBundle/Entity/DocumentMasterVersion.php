<?php

namespace ESERV\MAIN\DocumentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentMasterVersion
 */
class DocumentMasterVersion
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
    private $content;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $version;

    /**
     * @var string
     */
    private $visibleOnline;

    /**
     * @var \DateTime
     */
    private $dateOpened;

    /**
     * @var \DateTime
     */
    private $dateClosed;

    /**
     * @var integer
     */
    private $orderBy;

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
     * @var \ESERV\MAIN\DocumentBundle\Entity\DocumentMaster
     */
    private $documentMaster;

    /**
     * @var \ESERV\MAIN\DocumentBundle\Entity\DocumentMasterVersion
     */
    private $headerPage1;

    /**
     * @var \ESERV\MAIN\DocumentBundle\Entity\DocumentMasterVersion
     */
    private $header;

    /**
     * @var \ESERV\MAIN\DocumentBundle\Entity\DocumentMasterVersion
     */
    private $footer;

    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\Language
     */
    private $language;

    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode
     */
    private $docCategory;

    /**
     * @var \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode
     */
    private $documentType;


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
     * @return DocumentMasterVersion
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
     * Set content
     *
     * @param string $content
     * @return DocumentMasterVersion
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
     * Set name
     *
     * @param string $name
     * @return DocumentMasterVersion
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
     * Set version
     *
     * @param integer $version
     * @return DocumentMasterVersion
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
     * Set visibleOnline
     *
     * @param string $visibleOnline
     * @return DocumentMasterVersion
     */
    public function setVisibleOnline($visibleOnline)
    {
        $this->visibleOnline = $visibleOnline;

        return $this;
    }

    /**
     * Get visibleOnline
     *
     * @return string 
     */
    public function getVisibleOnline()
    {
        return $this->visibleOnline;
    }

    /**
     * Set dateOpened
     *
     * @param \DateTime $dateOpened
     * @return DocumentMasterVersion
     */
    public function setDateOpened($dateOpened)
    {
        $this->dateOpened = $dateOpened;

        return $this;
    }

    /**
     * Get dateOpened
     *
     * @return \DateTime 
     */
    public function getDateOpened()
    {
        return $this->dateOpened;
    }

    /**
     * Set dateClosed
     *
     * @param \DateTime $dateClosed
     * @return DocumentMasterVersion
     */
    public function setDateClosed($dateClosed)
    {
        $this->dateClosed = $dateClosed;

        return $this;
    }

    /**
     * Get dateClosed
     *
     * @return \DateTime 
     */
    public function getDateClosed()
    {
        return $this->dateClosed;
    }

    /**
     * Set orderBy
     *
     * @param integer $orderBy
     * @return DocumentMasterVersion
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;

        return $this;
    }

    /**
     * Get orderBy
     *
     * @return integer 
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return DocumentMasterVersion
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
     * @return DocumentMasterVersion
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
     * @return DocumentMasterVersion
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
     * @return DocumentMasterVersion
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
     * Set documentMaster
     *
     * @param \ESERV\MAIN\DocumentBundle\Entity\DocumentMaster $documentMaster
     * @return DocumentMasterVersion
     */
    public function setDocumentMaster(\ESERV\MAIN\DocumentBundle\Entity\DocumentMaster $documentMaster = null)
    {
        $this->documentMaster = $documentMaster;

        return $this;
    }

    /**
     * Get documentMaster
     *
     * @return \ESERV\MAIN\DocumentBundle\Entity\DocumentMaster 
     */
    public function getDocumentMaster()
    {
        return $this->documentMaster;
    }

    /**
     * Set headerPage1
     *
     * @param \ESERV\MAIN\DocumentBundle\Entity\DocumentMasterVersion $headerPage1
     * @return DocumentMasterVersion
     */
    public function setHeaderPage1(\ESERV\MAIN\DocumentBundle\Entity\DocumentMasterVersion $headerPage1 = null)
    {
        $this->headerPage1 = $headerPage1;

        return $this;
    }

    /**
     * Get headerPage1
     *
     * @return \ESERV\MAIN\DocumentBundle\Entity\DocumentMasterVersion 
     */
    public function getHeaderPage1()
    {
        return $this->headerPage1;
    }

    /**
     * Set header
     *
     * @param \ESERV\MAIN\DocumentBundle\Entity\DocumentMasterVersion $header
     * @return DocumentMasterVersion
     */
    public function setHeader(\ESERV\MAIN\DocumentBundle\Entity\DocumentMasterVersion $header = null)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return \ESERV\MAIN\DocumentBundle\Entity\DocumentMasterVersion 
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set footer
     *
     * @param \ESERV\MAIN\DocumentBundle\Entity\DocumentMasterVersion $footer
     * @return DocumentMasterVersion
     */
    public function setFooter(\ESERV\MAIN\DocumentBundle\Entity\DocumentMasterVersion $footer = null)
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * Get footer
     *
     * @return \ESERV\MAIN\DocumentBundle\Entity\DocumentMasterVersion 
     */
    public function getFooter()
    {
        return $this->footer;
    }

    /**
     * Set language
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\Language $language
     * @return DocumentMasterVersion
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
     * Set docCategory
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $docCategory
     * @return DocumentMasterVersion
     */
    public function setDocCategory(\ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $docCategory = null)
    {
        $this->docCategory = $docCategory;

        return $this;
    }

    /**
     * Get docCategory
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode 
     */
    public function getDocCategory()
    {
        return $this->docCategory;
    }

    /**
     * Set documentType
     *
     * @param \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $documentType
     * @return DocumentMasterVersion
     */
    public function setDocumentType(\ESERV\MAIN\SystemConfigBundle\Entity\SystemCode $documentType = null)
    {
        $this->documentType = $documentType;

        return $this;
    }

    /**
     * Get documentType
     *
     * @return \ESERV\MAIN\SystemConfigBundle\Entity\SystemCode 
     */
    public function getDocumentType()
    {
        return $this->documentType;
    }
}
