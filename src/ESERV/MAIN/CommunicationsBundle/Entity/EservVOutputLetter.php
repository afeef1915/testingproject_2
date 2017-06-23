<?php

namespace ESERV\MAIN\CommunicationsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EservVOutputLetter
 */
class EservVOutputLetter
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $shortDescription;

    /**
     * @var integer
     */
    private $statusId;

    /**
     * @var string
     */
    private $status;

    /**
     * @var integer
     */
    private $templateVersionId;

    /**
     * @var integer
     */
    private $ajDocumentJobId;

    /**
     * @var integer
     */
    private $fosUserId;

    /**
     * @var string
     */
    private $templateVerName;

    /**
     * @var string
     */
    private $username;

    /**
     * @var integer
     */
    private $countActivityTarget;


    /**
     * Set code
     *
     * @param string $code
     * @return EservVOutputLetter
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
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return EservVOutputLetter
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string 
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set statusId
     *
     * @param integer $statusId
     * @return EservVOutputLetter
     */
    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;

        return $this;
    }

    /**
     * Get statusId
     *
     * @return integer 
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return EservVOutputLetter
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set templateVersionId
     *
     * @param integer $templateVersionId
     * @return EservVOutputLetter
     */
    public function setTemplateVersionId($templateVersionId)
    {
        $this->templateVersionId = $templateVersionId;

        return $this;
    }

    /**
     * Get templateVersionId
     *
     * @return integer 
     */
    public function getTemplateVersionId()
    {
        return $this->templateVersionId;
    }

    /**
     * Set ajDocumentJobId
     *
     * @param integer $ajDocumentJobId
     * @return EservVOutputLetter
     */
    public function setAjDocumentJobId($ajDocumentJobId)
    {
        $this->ajDocumentJobId = $ajDocumentJobId;

        return $this;
    }

    /**
     * Get ajDocumentJobId
     *
     * @return integer 
     */
    public function getAjDocumentJobId()
    {
        return $this->ajDocumentJobId;
    }

    /**
     * Set fosUserId
     *
     * @param integer $fosUserId
     * @return EservVOutputLetter
     */
    public function setFosUserId($fosUserId)
    {
        $this->fosUserId = $fosUserId;

        return $this;
    }

    /**
     * Get fosUserId
     *
     * @return integer 
     */
    public function getFosUserId()
    {
        return $this->fosUserId;
    }

    /**
     * Set templateVerName
     *
     * @param string $templateVerName
     * @return EservVOutputLetter
     */
    public function setTemplateVerName($templateVerName)
    {
        $this->templateVerName = $templateVerName;

        return $this;
    }

    /**
     * Get templateVerName
     *
     * @return string 
     */
    public function getTemplateVerName()
    {
        return $this->templateVerName;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return EservVOutputLetter
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set countActivityTarget
     *
     * @param integer $countActivityTarget
     * @return EservVOutputLetter
     */
    public function setCountActivityTarget($countActivityTarget)
    {
        $this->countActivityTarget = $countActivityTarget;

        return $this;
    }

    /**
     * Get countActivityTarget
     *
     * @return integer 
     */
    public function getCountActivityTarget()
    {
        return $this->countActivityTarget;
    }
}
