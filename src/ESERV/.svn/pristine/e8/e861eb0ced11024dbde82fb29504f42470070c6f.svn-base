<?php

namespace ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Phone
 */
class Phone
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $phoneStd;

    /**
     * @var string
     */
    private $phoneNumber;

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
    private $phoneType;


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
     * Set phoneStd
     *
     * @param string $phoneStd
     * @return Phone
     */
    public function setPhoneStd($phoneStd)
    {
        $this->phoneStd = $phoneStd;

        return $this;
    }

    /**
     * Get phoneStd
     *
     * @return string 
     */
    public function getPhoneStd()
    {
        return $this->phoneStd;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return Phone
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set primaryRecord
     *
     * @param string $primaryRecord
     * @return Phone
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
     * @return Phone
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
     * @return Phone
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
     * @return Phone
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
     * @return Phone
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
     * @return Phone
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
     * Set phoneType
     *
     * @param \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $phoneType
     * @return Phone
     */
    public function setPhoneType(\ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode $phoneType = null)
    {
        $this->phoneType = $phoneType;

        return $this;
    }

    /**
     * Get phoneType
     *
     * @return \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode 
     */
    public function getPhoneType()
    {
        return $this->phoneType;
    }
    
    public function getAllByContactId($em,$contactId)
    {
        $qb1 = $em->createQueryBuilder();
        $result1 = $qb1->select('pt.id','p.phoneStd','p.phoneNumber','p.primaryRecord',
                'p.createdAt','p.updatedAt','p.createdBy','p.updatedBy')
                ->from('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone', 'p')
                ->leftJoin('p.contact','c')
                ->leftJoin('p.phoneType','pt')
                ->where('c.id = :id')
                ->setParameter('id', $contactId)
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        
        return $result1;
    }  
}
