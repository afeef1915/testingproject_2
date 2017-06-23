<?php

namespace ESERV\MAIN\CommunicationsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmailMergingArchive
 */
class EmailMergingArchive
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $emaSize;

    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $content;

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
     * @var \ESERV\MAIN\CommunicationsBundle\Entity\EmailMergingLookupArchive
     */
    private $archive;


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
     * Set emaSize
     *
     * @param integer $emaSize
     * @return EmailMergingArchive
     */
    public function setEmaSize($emaSize)
    {
        $this->emaSize = $emaSize;

        return $this;
    }

    /**
     * Get emaSize
     *
     * @return integer 
     */
    public function getEmaSize()
    {
        return $this->emaSize;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return EmailMergingArchive
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return EmailMergingArchive
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return EmailMergingArchive
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
     * @return EmailMergingArchive
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
     * @return EmailMergingArchive
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
     * @return EmailMergingArchive
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
     * Set archive
     *
     * @param \ESERV\MAIN\CommunicationsBundle\Entity\EmailMergingLookupArchive $archive
     * @return EmailMergingArchive
     */
    public function setArchive(\ESERV\MAIN\CommunicationsBundle\Entity\EmailMergingLookupArchive $archive = null)
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive
     *
     * @return \ESERV\MAIN\CommunicationsBundle\Entity\EmailMergingLookupArchive 
     */
    public function getArchive()
    {
        return $this->archive;
    }
}
