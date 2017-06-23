<?php

namespace WEBLOGS\MAIN\COMMON\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VmediaStore
 */
class VmediaStore
{
    /**
     * @var string
     */
    private $media_id;

    /**
     * @var string
     */
    private $media_type_id;

    /**
     * @var string
     */
    private $file_name;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \DateTime
     */
    private $created_by;

    /**
     * @var \DateTime
     */
    private $updated_by;

    /**
     * @var string
     */
    private $display_name;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $job_no;


    /**
     * Set media_id
     *
     * @param string $mediaId
     * @return VmediaStore
     */
    public function setMediaId($mediaId)
    {
        $this->media_id = $mediaId;

        return $this;
    }

    /**
     * Get media_id
     *
     * @return string 
     */
    public function getMediaId()
    {
        return $this->media_id;
    }

    /**
     * Set media_type_id
     *
     * @param string $mediaTypeId
     * @return VmediaStore
     */
    public function setMediaTypeId($mediaTypeId)
    {
        $this->media_type_id = $mediaTypeId;

        return $this;
    }

    /**
     * Get media_type_id
     *
     * @return string 
     */
    public function getMediaTypeId()
    {
        return $this->media_type_id;
    }

    /**
     * Set file_name
     *
     * @param string $fileName
     * @return VmediaStore
     */
    public function setFileName($fileName)
    {
        $this->file_name = $fileName;

        return $this;
    }

    /**
     * Get file_name
     *
     * @return string 
     */
    public function getFileName()
    {
        return $this->file_name;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return VmediaStore
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
     * @return VmediaStore
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
     * @param \DateTime $createdBy
     * @return VmediaStore
     */
    public function setCreatedBy($createdBy)
    {
        $this->created_by = $createdBy;

        return $this;
    }

    /**
     * Get created_by
     *
     * @return \DateTime 
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Set updated_by
     *
     * @param \DateTime $updatedBy
     * @return VmediaStore
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updated_by = $updatedBy;

        return $this;
    }

    /**
     * Get updated_by
     *
     * @return \DateTime 
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }

    /**
     * Set display_name
     *
     * @param string $displayName
     * @return VmediaStore
     */
    public function setDisplayName($displayName)
    {
        $this->display_name = $displayName;

        return $this;
    }

    /**
     * Get display_name
     *
     * @return string 
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return VmediaStore
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set job_no
     *
     * @param string $jobNo
     * @return VmediaStore
     */
    public function setJobNo($jobNo)
    {
        $this->job_no = $jobNo;

        return $this;
    }

    /**
     * Get job_no
     *
     * @return string 
     */
    public function getJobNo()
    {
        return $this->job_no;
    }
}
