<?php
            
/*
    This file has been generated using MTL ESERV:BUILD command. Contact Anjana on anjana@millertech.co.uk for more
    information. Thanks.
*/

namespace ESERV\MAIN\MembershipBundle\Entity;

use Doctrine\ORM\EntityRepository;

//use Doctrine\ORM\EntityManager;
//use Symfony\Component\DependencyInjection\Container;

/**
 * ActivityRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */  
class WorkplaceRepository extends EntityRepository
{              
    public function getWorkplaceByemployerID($employer_id = 0) {                
        $qb = $this->createQueryBuilder('w')
                ->select('w.id', 'w.code', 'o.name')
                ->leftJoin('w.organisation', 'o')
                ->leftJoin('o.contact', 'c')
                ->where('o.dateClosed IS NULL')                         
            ;

        if ($employer_id >= 1) {                    
            $emp_contact_id = $this->getEntityManager()->getRepository('ESERVMAINMembershipBundle:Employer')->getContactIdOfEmployer($employer_id);
            $wp_contact_id_array = $this->getEntityManager()->getRepository('ESERVMAINMembershipBundle:Relationship')->getWPContactIdsFromEMPContactId($emp_contact_id);
            $qb->andWhere('c.id IN (:cid)')
                    ->setParameter('cid', $wp_contact_id_array)
            ;
        }

        $qb->orderBy('o.name', 'ASC');
        $qb->addOrderBy('w.code', 'ASC');    

        $emp_data = $qb->getQuery()
                       ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY); 

        $employers = array();                 
        foreach($emp_data as $ed){                     
            $employers[$ed['id']] = $ed['name'].' ('.$ed['code'].')';
        }
        return $employers;                
    }
    
    public function getWorkplaceByContact($contact_id) {
        $qb = $this->createQueryBuilder('w')
                    ->select('w', 'o')
                    ->leftJoin('w.organisation', 'o')
                    ->leftJoin('o.contact', 'c')
                    ->where('o.dateClosed IS NULL')
                    ->where('c.id = :con_id')
                    ->setParameter('con_id', $contact_id);
        $data = $qb->getQuery()->getSingleResult();
        
        return $data;
    }

    public function getContactByWorkplaceId($workplace_id) {
        $qb = $this->createQueryBuilder('w')
                    ->select('w', 'o', 'c')
                    ->innerJoin('w.organisation', 'o')
                    ->innerJoin('o.contact', 'c')
                    ->where('w.id = :WorkplaceId')
                    ->setParameter('WorkplaceId', $workplace_id);
        $data = $qb->getQuery()->getOneOrNullResult();
        
        return $data;
    }
}