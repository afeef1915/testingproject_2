<?php

namespace ESERV\MAIN\DocumentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContactUploadedDocStore
 */
class ContactUploadedDocStore
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $fileContent;

    /**
     * @var integer
     */
    private $fileSize;

    /**
     * @var string
     */
    private $name;

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
     * Set fileContent
     *
     * @param string $fileContent
     * @return ContactUploadedDocStore
     */
    public function setFileContent($fileContent)
    {
        $this->fileContent = $fileContent;

        return $this;
    }

    /**
     * Get fileContent
     *
     * @return string
     */
    public function getFileContent()
    {
        return $this->fileContent;
    }

    /**
     * Set fileSize
     *
     * @param integer $fileSize
     * @return ContactUploadedDocStore
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    /**
     * Get fileSize
     *
     * @return integer
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ContactUploadedDocStore
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ContactUploadedDocStore
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
     * @return ContactUploadedDocStore
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
     * @return ContactUploadedDocStore
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
     * @return ContactUploadedDocStore
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
     * @var \ESERV\MAIN\MediaBundle\Entity\MediaType
     */
    private $mediaType;


    /**
     * Set mediaType
     *
     * @param \ESERV\MAIN\MediaBundle\Entity\MediaType $mediaType
     * @return ContactUploadedDocStore
     */
    public function setMediaType(\ESERV\MAIN\MediaBundle\Entity\MediaType $mediaType = null)
    {
        $this->mediaType = $mediaType;

        return $this;
    }

    /**
     * Get mediaType
     *
     * @return \ESERV\MAIN\MediaBundle\Entity\MediaType 
     */
    public function getMediaType()
    {
        return $this->mediaType;
    }
}
