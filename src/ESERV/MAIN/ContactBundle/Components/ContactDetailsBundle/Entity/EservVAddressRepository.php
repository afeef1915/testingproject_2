<?php

namespace ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections;
use Symfony\Component\DependencyInjection\Container;

class EservVAddressRepository extends EntityRepository
{
    public function getPrimaryAddressByContactId($contact_id) {
        $address = '';
        
        $query = $this->createQueryBuilder('a')
                      ->Where('a.contactId = :c_id')
                      ->setParameter('c_id', $contact_id) 
                      ->andWhere('a.primaryRecord = :pr')
                      ->setParameter('pr', 'Y') 
                      ->getQuery();   
        try {
            $address = $query->getSingleResult();
        } catch (\Doctrine\ORM\NonUniqueResultException $e) { 
            $address = null;
        }
        catch (\Doctrine\ORM\NoResultException  $e) { 
            $address = null;
        }
        
        return $address;
    } #getPrimaryAddressByContactId end
}