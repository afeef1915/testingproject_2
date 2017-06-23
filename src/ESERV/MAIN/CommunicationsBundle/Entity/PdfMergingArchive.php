<?php

namespace ESERV\MAIN\CommunicationsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PdfMergingArchive
 */
class PdfMergingArchive
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $size;

    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $content;

    /**
     * @var integer
     */
    private $pdf_merging_lookup_archive_id;

    /**
     * @var string
     */
    private $external_id;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var integer
     */
    private $created_by;

    /**
     * @var integer
     */
    private $updated_by;


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
     * Set size
     *
     * @param integer $size
     * @return PdfMergingArchive
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return integer 
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return PdfMergingArchive
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
     * @return PdfMergingArchive
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
     * Set pdf_merging_lookup_archive_id
     *
     * @param integer $pdfMergingLookupArchiveId
     * @return PdfMergingArchive
     */
    public function setPdfMergingLookupArchiveId($pdfMergingLookupArchiveId)
    {
        $this->pdf_merging_lookup_archive_id = $pdfMergingLookupArchiveId;

        return $this;
    }

    /**
     * Get pdf_merging_lookup_archive_id
     *
     * @return integer 
     */
    public function getPdfMergingLookupArchiveId()
    {
        return $this->pdf_merging_lookup_archive_id;
    }

    /**
     * Set external_id
     *
     * @param string $externalId
     * @return PdfMergingArchive
     */
    public function setExternalId($externalId)
    {
        $this->external_id = $externalId;

        return $this;
    }

    /**
     * Get external_id
     *
     * @return string 
     */
    public function getExternalId()
    {
        return $this->external_id;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return PdfMergingArchive
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return PdfMergingArchive
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set created_by
     *
     * @param integer $createdBy
     * @return PdfMergingArchive
     */
    public function setCreatedBy($createdBy)
    {
        $this->created_by = $createdBy;

        return $this;
    }

    /**
     * Get created_by
     *
     * @return integer 
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Set updated_by
     *
     * @param integer $updatedBy
     * @return PdfMergingArchive
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updated_by = $updatedBy;

        return $this;
    }

    /**
     * Get updated_by
     *
     * @return integer 
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }
}
