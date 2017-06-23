<?php

namespace ESERV\TestBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ESERVTestBundleWorkplaceServices extends Controller {

    private $em;
    private $c;
    private $coreFunction;
    private $dBCoreFunction;

    public function __construct(EntityManager $em, Container $c) {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
        $this->dBCoreFunction = $this->c->get('db_core_function_services');
    }

    //list centre cases
    public function ListWorkplaces($type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                        ->from('ESERVTestBundle:GtcwVWorkplace', $alias);

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Workplaces found-- Function "ListWorkplaces"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    public function ListWorkplacesByEmpOragId($params, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();
        $result = $qb->select($alias)
                        ->from('ESERVTestBundle:GtcwVEmpWor', $alias)
                        ->where($alias.'.emp_org_id = :employer_organisation_id')
                        ->setParameter('employer_organisation_id', $params['organisation_id']);
        
        if (isset($params['wor_date_closed']) && $params['wor_date_closed'] == 'Y') {
            // Restrict nothing
        } else {
            $qb->andWhere($alias . '.wor_date_closed IS NULL');
        }
        
        if (!$result) {
            throw $this->createNotFoundException(
                    'No Workplaces found-- Function "ListWorkplacesByEmpOragId"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    /*
    public function ListWorkplacesByEmpOragId($organisation_id, $type = 'doctrine', $alias = 'p', $query_only = false) {
          
        $workplaces_arr = array();
        # 1. Find contact_id for given organisation
        $query_builder = $this->em->createQueryBuilder();
        $query = $query_builder->select('o')
                ->from('ESERVMAINContactBundle:Organisation', 'o')
                ->where('o.id = :org_id')
                ->setParameter('org_id', $organisation_id)
                ->getQuery();
        $employer = $query->getOneOrNullResult();
        $employer_contact_id = $employer ? $employer->getContact()->getId() : null;
        
        # 2. Get relationship type id for Employer/Workplace # change the where condition after discussion with Bren
        $query_builder = $this->em->createQueryBuilder();
        $query = $query_builder->select('rt')
                ->from('ESERVMAINContactBundle:RelationshipType', 'rt')
                ->where('rt.description = :description')
                ->setParameter('description', 'Employer/Workplace')
                ->getQuery();
        
        $relationship_type = $query->getOneOrNullResult();
        $relationship_type_id = $relationship_type ? $relationship_type->getId() :  null;                
        
        # 3. Find all 'Workplace' related to given 'Employer' using the employer contact_id
        if( $employer_contact_id && $relationship_type_id){            
            $query_builder = $this->em->createQueryBuilder();
            $query = $query_builder->select('r')
                    ->from('ESERVMAINContactBundle:Relationship', 'r')
                    ->where('r.contactA= :employer_contact_id')
                    ->orWhere('r.contactB = :employer_contact_id')
                    ->andWhere('r.relationshipType = :relationship_type_id')               
                    ->setParameter('employer_contact_id', $employer_contact_id)
                    ->setParameter('relationship_type_id', $relationship_type_id)
                    ->getQuery();
            $relationships = $query->getResult();
            
            
            foreach($relationships as $relationship){
                if($relationship->getContactA()->getId() == $employer_contact_id){
                    $workplaces_arr[] = $relationship->getContactB()->getId();
                }else{
                    $workplaces_arr[] = $relationship->getContactA()->getId();
                }
            }            
        
        }
        
        #print_r($workplaces_arr); die;                
        $qb = $this->em->createQueryBuilder();
        $result = $qb->select($alias)
                        ->from('ESERVTestBundle:GtcwVWorkplace', $alias)
                        ->where($alias.'.contact_id IN (:workplaces)')                      
                        ->setParameter('workplaces', $workplaces_arr);

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Workplaces found-- Function "ListWorkplaces"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }     
     */
}
