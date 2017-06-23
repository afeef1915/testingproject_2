<?php

namespace ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Website
 */
class Website
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $webAddress;

    /**
     * @var string
     */
    private $primaryRecord;

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
     * @var \ESERV\MAIN\ContactBundle\Entity\Contact
     */
    private $contact;

    /**
     * @var \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode
     */
    private $webAddType;


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
     * Set webAddress
     *
     * @param string $webAddress
     * @return Website
     */
    public function setWebAddress($webAddress)
    {
        $this->webAddress = $webAddress;

        return $this;
    }

    /**
     * Get webAddress
     *
     * @return string 
     */
    public function getWebAddress()
    {
        return $this->webAddress;
    }

    /**
     * Set primaryRecord
     *
     * @param string $primaryRecord
     * @return Website
     */
    public function setPrimaryRecord($primaryRecord)
    {
        $this->primaryRecord = $primaryRecord;

        return $this;
    }

    /**
     * Get primaryRecord
     *
     * @return string 
     */
    public function getPrimaryRecord()
    {
        return $this->primaryRecord;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Website
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
     * @return Website
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
     * @return Website
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
     * @return Website
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
     * Set contact
     *
     * @param \ESERV\MAIN\ContactBundle\Entity\Contact $contact
     * @return Website
     */
    public function setContact(\ESERV\MAIN\ContactBundle\Entity\Contact $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \ESERV\MAIN\ContactBundle\Entity\Contact 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set webAddType
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $webAddType
     * @return Website
     */
    public function setWebAddType(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $webAddType = null)
    {
        $this->webAddType = $webAddType;

        return $this;
    }

    /**
     * Get webAddType
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getWebAddType()
    {
        return $this->webAddType;
    }
    
    public function getAllByContactId($em,$contactId)
    {
        $qb1 = $em->createQueryBuilder();
        $result1 = $qb1->select('p.id','p.webAddress','p.primaryRecord','p.createdAt',
                'p.updatedAt','p.createdBy','p.updatedBy')
                ->from('ESERVMAINContactBundleComponentsContactDetailsBundle:Website', 'p')
                ->leftJoin('p.contact','c')
                ->where('c.id = :id')
                ->setParameter('id', $contactId)
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
        return $result1;
    }
}
