<?php

namespace ESERV\MAIN\AdministrationBundle\Components\ClientAdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientEntity
 */
class ClientEntity
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $entityName;

    /**
     * @var string
     */
    private $entityDescription;


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
     * Set entityName
     *
     * @param string $entityName
     * @return ClientEntity
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
     * Set entityDescription
     *
     * @param string $entityDescription
     * @return ClientEntity
     */
    public function setEntityDescription($entityDescription)
    {
        $this->entityDescription = $entityDescription;

        return $this;
    }

    /**
     * Get entityDescription
     *
     * @return string 
     */
    public function getEntityDescription()
    {
        return $this->entityDescription;
    }
    /**
     * @var string
     */
    private $subEntityName;

    /**
     * @var string
     */
    private $subEntityDescription;


    /**
     * Set subEntityName
     *
     * @param string $subEntityName
     * @return ClientEntity
     */
    public function setSubEntityName($subEntityName)
    {
        $this->subEntityName = $subEntityName;

        return $this;
    }

    /**
     * Get subEntityName
     *
     * @return string 
     */
    public function getSubEntityName()
    {
        return $this->subEntityName;
    }

    /**
     * Set subEntityDescription
     *
     * @param string $subEntityDescription
     * @return ClientEntity
     */
    public function setSubEntityDescription($subEntityDescription)
    {
        $this->subEntityDescription = $subEntityDescription;

        return $this;
    }

    /**
     * Get subEntityDescription
     *
     * @return string 
     */
    public function getSubEntityDescription()
    {
        return $this->subEntityDescription;
    }
    /**
     * @var string
     */
    private $entityIdTable;


    /**
     * Set entityIdTable
     *
     * @param string $entityIdTable
     * @return ClientEntity
     */
    public function setEntityIdTable($entityIdTable)
    {
        $this->entityIdTable = $entityIdTable;

        return $this;
    }

    /**
     * Get entityIdTable
     *
     * @return string 
     */
    public function getEntityIdTable()
    {
        return $this->entityIdTable;
    }
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ClientEntity
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
     * @return ClientEntity
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
     * @return ClientEntity
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
     * @return ClientEntity
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
}
