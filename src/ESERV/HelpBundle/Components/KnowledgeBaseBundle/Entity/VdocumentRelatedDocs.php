<?php

namespace ESERV\HelpBundle\Components\KnowledgeBaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VdocumentRelatedDocs
 */
class VdocumentRelatedDocs
{
    /**
     * @var integer
     */
    private $main_document_id;

    /**
     * @var integer
     */
    private $document_id;

    /**
     * @var string
     */
    private $doc_name;

    /**
     * @var integer
     */
    private $author_id;

    /**
     * @var integer
     */
    private $source_id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $document_type;

    /**
     * @var string
     */
    private $external_text;

    /**
     * @var string
     */
    private $internal_text;

    /**
     * @var string
     */
    private $size_text;

    /**
     * @var string
     */
    private $document_extension;

    /**
     * @var integer
     */
    private $viewed_by_count;

    /**
     * @var integer
     */
    private $rating;

    /**
     * @var integer
     */
    private $rated_by_count;

    /**
     * @var string
     */
    private $review_date;


    /**
     * Get main_document_id
     *
     * @return integer 
     */
    public function getMainDocumentId()
    {
        return $this->main_document_id;
    }

    /**
     * Set document_id
     *
     * @param integer $documentId
     * @return VdocumentRelatedDocs
     */
    public function setDocumentId($documentId)
    {
        $this->document_id = $documentId;

        return $this;
    }

    /**
     * Get document_id
     *
     * @return integer 
     */
    public function getDocumentId()
    {
        return $this->document_id;
    }

    /**
     * Set doc_name
     *
     * @param string $docName
     * @return VdocumentRelatedDocs
     */
    public function setDocName($docName)
    {
        $this->doc_name = $docName;

        return $this;
    }

    /**
     * Get doc_name
     *
     * @return string 
     */
    public function getDocName()
    {
        return $this->doc_name;
    }

    /**
     * Set author_id
     *
     * @param integer $authorId
     * @return VdocumentRelatedDocs
     */
    public function setAuthorId($authorId)
    {
        $this->author_id = $authorId;

        return $this;
    }

    /**
     * Get author_id
     *
     * @return integer 
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }

    /**
     * Set source_id
     *
     * @param integer $sourceId
     * @return VdocumentRelatedDocs
     */
    public function setSourceId($sourceId)
    {
        $this->source_id = $sourceId;

        return $this;
    }

    /**
     * Get source_id
     *
     * @return integer 
     */
    public function getSourceId()
    {
        return $this->source_id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return VdocumentRelatedDocs
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set document_type
     *
     * @param string $documentType
     * @return VdocumentRelatedDocs
     */
    public function setDocumentType($documentType)
    {
        $this->document_type = $documentType;

        return $this;
    }

    /**
     * Get document_type
     *
     * @return string 
     */
    public function getDocumentType()
    {
        return $this->document_type;
    }

    /**
     * Set external_text
     *
     * @param string $externalText
     * @return VdocumentRelatedDocs
     */
    public function setExternalText($externalText)
    {
        $this->external_text = $externalText;

        return $this;
    }

    /**
     * Get external_text
     *
     * @return string 
     */
    public function getExternalText()
    {
        return $this->external_text;
    }

    /**
     * Set internal_text
     *
     * @param string $internalText
     * @return VdocumentRelatedDocs
     */
    public function setInternalText($internalText)
    {
        $this->internal_text = $internalText;

        return $this;
    }

    /**
     * Get internal_text
     *
     * @return string 
     */
    public function getInternalText()
    {
        return $this->internal_text;
    }

    /**
     * Set size_text
     *
     * @param string $sizeText
     * @return VdocumentRelatedDocs
     */
    public function setSizeText($sizeText)
    {
        $this->size_text = $sizeText;

        return $this;
    }

    /**
     * Get size_text
     *
     * @return string 
     */
    public function getSizeText()
    {
        return $this->size_text;
    }

    /**
     * Set document_extension
     *
     * @param string $documentExtension
     * @return VdocumentRelatedDocs
     */
    public function setDocumentExtension($documentExtension)
    {
        $this->document_extension = $documentExtension;

        return $this;
    }

    /**
     * Get document_extension
     *
     * @return string 
     */
    public function getDocumentExtension()
    {
        return $this->document_extension;
    }

    /**
     * Set viewed_by_count
     *
     * @param integer $viewedByCount
     * @return VdocumentRelatedDocs
     */
    public function setViewedByCount($viewedByCount)
    {
        $this->viewed_by_count = $viewedByCount;

        return $this;
    }

    /**
     * Get viewed_by_count
     *
     * @return integer 
     */
    public function getViewedByCount()
    {
        return $this->viewed_by_count;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     * @return VdocumentRelatedDocs
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set rated_by_count
     *
     * @param integer $ratedByCount
     * @return VdocumentRelatedDocs
     */
    public function setRatedByCount($ratedByCount)
    {
        $this->rated_by_count = $ratedByCount;

        return $this;
    }

    /**
     * Get rated_by_count
     *
     * @return integer 
     */
    public function getRatedByCount()
    {
        return $this->rated_by_count;
    }

    /**
     * Set review_date
     *
     * @param string $reviewDate
     * @return VdocumentRelatedDocs
     */
    public function setReviewDate($reviewDate)
    {
        $this->review_date = $reviewDate;

        return $this;
    }

    /**
     * Get review_date
     *
     * @return string 
     */
    public function getReviewDate()
    {
        return $this->review_date;
    }
}
