<?php

namespace ESERV\MAIN\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MediaStoreHistory
 */
class MediaStoreHistory
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $fileSize;

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var string
     */
    private $fileExtension;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $entityName;

    /**
     * @var integer
     */
    private $entityId;

    /**
     * @var integer
     */
    private $width;

    /**
     * @var integer
     */
    private $height;

    /**
     * @var integer
     */
    private $dpi;

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
     * @var \ESERV\MAIN\MediaBundle\Entity\MediaType
     */
    private $mediaType;

    /**
     * @var \ESERV\MAIN\MediaBundle\Entity\MediaStore
     */
    private $mediaStore;


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
     * Set fileSize
     *
     * @param integer $fileSize
     * @return MediaStoreHistory
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
     * Set fileName
     *
     * @param string $fileName
     * @return MediaStoreHistory
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string 
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set fileExtension
     *
     * @param string $fileExtension
     * @return MediaStoreHistory
     */
    public function setFileExtension($fileExtension)
    {
        $this->fileExtension = $fileExtension;

        return $this;
    }

    /**
     * Get fileExtension
     *
     * @return string 
     */
    public function getFileExtension()
    {
        return $this->fileExtension;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return MediaStoreHistory
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
     * Set entityName
     *
     * @param string $entityName
     * @return MediaStoreHistory
     */
    public function setEntityName($entityName)
    {
        $this->entityName = $entityName;

        return $this;
    }

    /**
     * Get entityName
     *
     * @return string 
     */
    public function getEntityName()
    {
        return $this->entityName;
    }

    /**
     * Set entityId
     *
     * @param integer $entityId
     * @return MediaStoreHistory
     */
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;

        return $this;
    }

    /**
     * Get entityId
     *
     * @return integer 
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * Set width
     *
     * @param integer $width
     * @return MediaStoreHistory
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer 
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return MediaStoreHistory
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set dpi
     *
     * @param integer $dpi
     * @return MediaStoreHistory
     */
    public function setDpi($dpi)
    {
        $this->dpi = $dpi;

        return $this;
    }

    /**
     * Get dpi
     *
     * @return integer 
     */
    public function getDpi()
    {
        return $this->dpi;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return MediaStoreHistory
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
     * @return MediaStoreHistory
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
     * @return MediaStoreHistory
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
     * @return MediaStoreHistory
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
     * Set mediaType
     *
     * @param \ESERV\MAIN\MediaBundle\Entity\MediaType $mediaType
     * @return MediaStoreHistory
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

    /**
     * Set mediaStore
     *
     * @param \ESERV\MAIN\MediaBundle\Entity\MediaStore $mediaStore
     * @return MediaStoreHistory
     */
    public function setMediaStore(\ESERV\MAIN\MediaBundle\Entity\MediaStore $mediaStore = null)
    {
        $this->mediaStore = $mediaStore;

        return $this;
    }

    /**
     * Get mediaStore
     *
     * @return \ESERV\MAIN\MediaBundle\Entity\MediaStore 
     */
    public function getMediaStore()
    {
        return $this->mediaStore;
    }
}
