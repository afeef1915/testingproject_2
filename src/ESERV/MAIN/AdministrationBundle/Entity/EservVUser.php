<?php

namespace ESERV\MAIN\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EservVUser
 */
class EservVUser
{
    /**
     * @var integer
     */
    private $fosUserId;

    /**
     * @var integer
     */
    private $mmUserSettingId;

    /**
     * @var integer
     */
    private $contactId;

    /**
     * @var string
     */
    private $displayName;

    /**
     * @var string
     */
    private $userDeptName;

    /**
     * @var string
     */
    private $userDeptDesc;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $fosUserEmail;

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
    private $lastLogin;

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
    private $expiresAt;

    /**
     * @var string
     */
    private $roles;


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
     * Set mmUserSettingId
     *
     * @param integer $mmUserSettingId
     * @return EservVUser
     */
    public function setMmUserSettingId($mmUserSettingId)
    {
        $this->mmUserSettingId = $mmUserSettingId;

        return $this;
    }

    /**
     * Get mmUserSettingId
     *
     * @return integer 
     */
    public function getMmUserSettingId()
    {
        return $this->mmUserSettingId;
    }

    /**
     * Set contactId
     *
     * @param integer $contactId
     * @return EservVUser
     */
    public function setContactId($contactId)
    {
        $this->contactId = $contactId;

        return $this;
    }

    /**
     * Get contactId
     *
     * @return integer 
     */
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * Set displayName
     *
     * @param string $displayName
     * @return EservVUser
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get displayName
     *
     * @return string 
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set userDeptName
     *
     * @param string $userDeptName
     * @return EservVUser
     */
    public function setUserDeptName($userDeptName)
    {
        $this->userDeptName = $userDeptName;

        return $this;
    }

    /**
     * Get userDeptName
     *
     * @return string 
     */
    public function getUserDeptName()
    {
        return $this->userDeptName;
    }

    /**
     * Set userDeptDesc
     *
     * @param string $userDeptDesc
     * @return EservVUser
     */
    public function setUserDeptDesc($userDeptDesc)
    {
        $this->userDeptDesc = $userDeptDesc;

        return $this;
    }

    /**
     * Get userDeptDesc
     *
     * @return string 
     */
    public function getUserDeptDesc()
    {
        return $this->userDeptDesc;
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
     * Set fosUserEmail
     *
     * @param string $fosUserEmail
     * @return EservVUser
     */
    public function setFosUserEmail($fosUserEmail)
    {
        $this->fosUserEmail = $fosUserEmail;

        return $this;
    }

    /**
     * Get fosUserEmail
     *
     * @return string 
     */
    public function getFosUserEmail()
    {
        return $this->fosUserEmail;
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
     * Set lastLogin
     *
     * @param \DateTime $lastLogin
     * @return EservVUser
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime 
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
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
     * Set expiresAt
     *
     * @param \DateTime $expiresAt
     * @return EservVUser
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * Get expiresAt
     *
     * @return \DateTime 
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
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
     * @var string
     */
    private $fosGroupName;


    /**
     * Set fosGroupName
     *
     * @param string $fosGroupName
     * @return EservVUser
     */
    public function setFosGroupName($fosGroupName)
    {
        $this->fosGroupName = $fosGroupName;

        return $this;
    }

    /**
     * Get fosGroupName
     *
     * @return string 
     */
    public function getFosGroupName()
    {
        return $this->fosGroupName;
    }
}
