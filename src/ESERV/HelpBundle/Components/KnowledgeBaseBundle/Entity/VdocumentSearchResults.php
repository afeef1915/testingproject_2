<?php

namespace ESERV\HelpBundle\Components\KnowledgeBaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VdocumentSearchResults
 */
class VdocumentSearchResults
{
    /**
     * @var integer
     */
    private $document_id;

    /**
     * @var integer
     */
    private $search_id;

    /**
     * @var string
     */
    private $doc_name;

    /**
     * @var integer
     */
    private $author_id;

    /**
     * @var string
     */
    private $author_name;

    /**
     * @var integer
     */
    private $source_id;

    /**
     * @var integer
     */
    private $keyword_score;

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
     * @var integer
     */
    private $session_id;

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
    private $rating;

    /**
     * @var string
     */
    private $review_date;

    /**
     * @var integer
     */
    private $rated_by_count;

    /**
     * @var integer
     */
    private $viewed_by_count;

    /**
     * @var string
     */
    private $topic_name;


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
     * Set search_id
     *
     * @param integer $searchId
     * @return VdocumentSearchResults
     */
    public function setSearchId($searchId)
    {
        $this->search_id = $searchId;

        return $this;
    }

    /**
     * Get search_id
     *
     * @return integer 
     */
    public function getSearchId()
    {
        return $this->search_id;
    }

    /**
     * Set doc_name
     *
     * @param string $docName
     * @return VdocumentSearchResults
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
     * @return VdocumentSearchResults
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
     * Set author_name
     *
     * @param string $authorName
     * @return VdocumentSearchResults
     */
    public function setAuthorName($authorName)
    {
        $this->author_name = $authorName;

        return $this;
    }

    /**
     * Get author_name
     *
     * @return string 
     */
    public function getAuthorName()
    {
        return $this->author_name;
    }

    /**
     * Set source_id
     *
     * @param integer $sourceId
     * @return VdocumentSearchResults
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
     * Set keyword_score
     *
     * @param integer $keywordScore
     * @return VdocumentSearchResults
     */
    public function setKeywordScore($keywordScore)
    {
        $this->keyword_score = $keywordScore;

        return $this;
    }

    /**
     * Get keyword_score
     *
     * @return integer 
     */
    public function getKeywordScore()
    {
        return $this->keyword_score;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return VdocumentSearchResults
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
     * @return VdocumentSearchResults
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
     * @return VdocumentSearchResults
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
     * @return VdocumentSearchResults
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
     * Set session_id
     *
     * @param integer $sessionId
     * @return VdocumentSearchResults
     */
    public function setSessionId($sessionId)
    {
        $this->session_id = $sessionId;

        return $this;
    }

    /**
     * Get session_id
     *
     * @return integer 
     */
    public function getSessionId()
    {
        return $this->session_id;
    }

    /**
     * Set size_text
     *
     * @param string $sizeText
     * @return VdocumentSearchResults
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
     * @return VdocumentSearchResults
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
     * Set rating
     *
     * @param integer $rating
     * @return VdocumentSearchResults
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
     * Set review_date
     *
     * @param string $reviewDate
     * @return VdocumentSearchResults
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

    /**
     * Set rated_by_count
     *
     * @param integer $ratedByCount
     * @return VdocumentSearchResults
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
     * Set viewed_by_count
     *
     * @param integer $viewedByCount
     * @return VdocumentSearchResults
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
     * Set topic_name
     *
     * @param string $topicName
     * @return VdocumentSearchResults
     */
    public function setTopicName($topicName)
    {
        $this->topic_name = $topicName;

        return $this;
    }

    /**
     * Get topic_name
     *
     * @return string 
     */
    public function getTopicName()
    {
        return $this->topic_name;
    }
}
