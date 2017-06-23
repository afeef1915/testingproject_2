<?php

namespace ESERV\HelpBundle\Components\KnowledgeBaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentReviews
 */
class DocumentReviews
{
    /**
     * @var integer
     */
    private $document_id;

    /**
     * @var integer
     */
    private $item_seq;

    /**
     * @var string
     */
    private $person_id;

    /**
     * @var string
     */
    private $date_created;

    /**
     * @var string
     */
    private $review_text;

    /**
     * @var string
     */
    private $date_archived;

    /**
     * @var string
     */
    private $status_code;

    /**
     * @var string
     */
    private $status_date;

    /**
     * @var string
     */
    private $status_change_by_id;

    /**
     * @var string
     */
    private $reason_code;


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
     * Set item_seq
     *
     * @param integer $itemSeq
     * @return DocumentReviews
     */
    public function setItemSeq($itemSeq)
    {
        $this->item_seq = $itemSeq;

        return $this;
    }

    /**
     * Get item_seq
     *
     * @return integer 
     */
    public function getItemSeq()
    {
        return $this->item_seq;
    }

    /**
     * Set person_id
     *
     * @param string $personId
     * @return DocumentReviews
     */
    public function setPersonId($personId)
    {
        $this->person_id = $personId;

        return $this;
    }

    /**
     * Get person_id
     *
     * @return string 
     */
    public function getPersonId()
    {
        return $this->person_id;
    }

    /**
     * Set date_created
     *
     * @param string $dateCreated
     * @return DocumentReviews
     */
    public function setDateCreated($dateCreated)
    {
        $this->date_created = $dateCreated;

        return $this;
    }

    /**
     * Get date_created
     *
     * @return string 
     */
    public function getDateCreated()
    {
        return $this->date_created;
    }

    /**
     * Set review_text
     *
     * @param string $reviewText
     * @return DocumentReviews
     */
    public function setReviewText($reviewText)
    {
        $this->review_text = $reviewText;

        return $this;
    }

    /**
     * Get review_text
     *
     * @return string 
     */
    public function getReviewText()
    {
        return $this->review_text;
    }

    /**
     * Set date_archived
     *
     * @param string $dateArchived
     * @return DocumentReviews
     */
    public function setDateArchived($dateArchived)
    {
        $this->date_archived = $dateArchived;

        return $this;
    }

    /**
     * Get date_archived
     *
     * @return string 
     */
    public function getDateArchived()
    {
        return $this->date_archived;
    }

    /**
     * Set status_code
     *
     * @param string $statusCode
     * @return DocumentReviews
     */
    public function setStatusCode($statusCode)
    {
        $this->status_code = $statusCode;

        return $this;
    }

    /**
     * Get status_code
     *
     * @return string 
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     * Set status_date
     *
     * @param string $statusDate
     * @return DocumentReviews
     */
    public function setStatusDate($statusDate)
    {
        $this->status_date = $statusDate;

        return $this;
    }

    /**
     * Get status_date
     *
     * @return string 
     */
    public function getStatusDate()
    {
        return $this->status_date;
    }

    /**
     * Set status_change_by_id
     *
     * @param string $statusChangeById
     * @return DocumentReviews
     */
    public function setStatusChangeById($statusChangeById)
    {
        $this->status_change_by_id = $statusChangeById;

        return $this;
    }

    /**
     * Get status_change_by_id
     *
     * @return string 
     */
    public function getStatusChangeById()
    {
        return $this->status_change_by_id;
    }

    /**
     * Set reason_code
     *
     * @param string $reasonCode
     * @return DocumentReviews
     */
    public function setReasonCode($reasonCode)
    {
        $this->reason_code = $reasonCode;

        return $this;
    }

    /**
     * Get reason_code
     *
     * @return string 
     */
    public function getReasonCode()
    {
        return $this->reason_code;
    }
}
