<?php

namespace Security\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EservVUser
 */
class EservVUser
{
    

    /**
     * @var integer
     */
    private $dtindex;

    /**
     * @var integer
     */
    private $mm_user_setting_id;

    /**
     * @var integer
     */
    private $fos_user_id;

    /**
     * @var integer
     */
    private $person_id;

    /**
     * @var string
     */
    private $full_name;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $fos_user_email;

    /**
     * @var string
     */
    private $enabled;

    /**
     * @var string
     */
    private $password;

    /**
     * @var \DateTime
     */
    private $last_login;

    /**
     * @var string
     */
    private $locked;

    /**
     * @var string
     */
    private $expired;

    /**
     * @var \DateTime
     */
    private $expires_at;

    /**
     * @var string
     */
    private $roles;

    /**
     * @var string
     */
    private $fos_group_name;


    /**
     * Get dtindex
     *
     * @return integer 
     */
    public function getDtindex()
    {
        return $this->dtindex;
    }

    /**
     * Set mm_user_setting_id
     *
     * @param integer $mmUserSettingId
     * @return EservVUser
     */
    public function setMmUserSettingId($mmUserSettingId)
    {
        $this->mm_user_setting_id = $mmUserSettingId;

        return $this;
    }

    /**
     * Get mm_user_setting_id
     *
     * @return integer 
     */
    public function getMmUserSettingId()
    {
        return $this->mm_user_setting_id;
    }

    /**
     * Set fos_user_id
     *
     * @param integer $fosUserId
     * @return EservVUser
     */
    public function setFosUserId($fosUserId)
    {
        $this->fos_user_id = $fosUserId;

        return $this;
    }

    /**
     * Get fos_user_id
     *
     * @return integer 
     */
    public function getFosUserId()
    {
        return $this->fos_user_id;
    }

    /**
     * Set person_id
     *
     * @param integer $personId
     * @return EservVUser
     */
    public function setPersonId($personId)
    {
        $this->person_id = $personId;

        return $this;
    }

    /**
     * Get person_id
     *
     * @return integer 
     */
    public function getPersonId()
    {
        return $this->person_id;
    }

    /**
     * Set full_name
     *
     * @param string $fullName
     * @return EservVUser
     */
    public function setFullName($fullName)
    {
        $this->full_name = $fullName;

        return $this;
    }

    /**
     * Get full_name
     *
     * @return string 
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return EservVUser
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
     * Set fos_user_email
     *
     * @param string $fosUserEmail
     * @return EservVUser
     */
    public function setFosUserEmail($fosUserEmail)
    {
        $this->fos_user_email = $fosUserEmail;

        return $this;
    }

    /**
     * Get fos_user_email
     *
     * @return string 
     */
    public function getFosUserEmail()
    {
        return $this->fos_user_email;
    }

    /**
     * Set enabled
     *
     * @param string $enabled
     * @return EservVUser
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return string 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return EservVUser
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set last_login
     *
     * @param \DateTime $lastLogin
     * @return EservVUser
     */
    public function setLastLogin($lastLogin)
    {
        $this->last_login = $lastLogin;

        return $this;
    }

    /**
     * Get last_login
     *
     * @return \DateTime 
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }

    /**
     * Set locked
     *
     * @param string $locked
     * @return EservVUser
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * Get locked
     *
     * @return string 
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Set expired
     *
     * @param string $expired
     * @return EservVUser
     */
    public function setExpired($expired)
    {
        $this->expired = $expired;

        return $this;
    }

    /**
     * Get expired
     *
     * @return string 
     */
    public function getExpired()
    {
        return $this->expired;
    }

    /**
     * Set expires_at
     *
     * @param \DateTime $expiresAt
     * @return EservVUser
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expires_at = $expiresAt;

        return $this;
    }

    /**
     * Get expires_at
     *
     * @return \DateTime 
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    /**
     * Set roles
     *
     * @param string $roles
     * @return EservVUser
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return string 
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set fos_group_name
     *
     * @param string $fosGroupName
     * @return EservVUser
     */
    public function setFosGroupName($fosGroupName)
    {
        $this->fos_group_name = $fosGroupName;

        return $this;
    }

    /**
     * Get fos_group_name
     *
     * @return string 
     */
    public function getFosGroupName()
    {
        return $this->fos_group_name;
    }
}
