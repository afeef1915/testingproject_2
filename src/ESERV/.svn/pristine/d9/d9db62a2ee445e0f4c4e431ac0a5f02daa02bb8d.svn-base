<?php

namespace ESERV\MAIN\MembershipBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ESERVMAINMembershipBundleMemDiscServices extends Controller 
{

    private $em;
    private $c;
    private $coreFunction;
    private $dBCoreFunction;

    public function __construct(EntityManager $em, Container $c) 
    {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
        $this->dBCoreFunction = $this->c->get('db_core_function_services');
    }

    //list disciplinary records by member id and membership org code
    public function ListMemDiscByMemId($params_array, $type = 'doctrine', $alias = 'p', $query_only = false) 
    {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                        ->from('ESERVMAINMembershipBundle:EservVMemDisc', $alias)
                        ->where($alias . '.memberId = :eservMemId')
                        ->setParameter('eservMemId', $params_array['member_id'])
                        ->andWhere($alias . '.memOrgId = :eservMemOrgId')
                        ->setParameter('eservMemOrgId', $params_array['mem_org_id'])
                ;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Disciplinary details found-- Function "ListMemDisc"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    public function getActiveMemDiscByMemId($param, $type = 'doctrine', $alias = 'p', $query_only = false) 
    {
        $qb = $this->em->createQueryBuilder();
        
        $eservVMemDisc = $qb->select($alias.'.id')
                ->from('ESERVMAINMembershipBundle:EservVMemDisc', $alias)
                ->where($alias . '.memberId = :eservMemId')
                ->setParameter('eservMemId', $param['member_id'])
                ->andWhere($alias . '.webEnabledCode = :weCd')
                ->setParameter('weCd', \ESERV\MAIN\Services\AppConstants::SCT_RESTRICTIONS_WEB_ENABLED_LIVE)
                ->andWhere($alias . '.endDate >= :todaysDate OR '.$alias . '.endDate IS NULL')
                ->setParameter('todaysDate', new \DateTime())
                ->orderBy($alias.'.endDate', 'DESC')
                ->getQuery()
//                ->getOneOrNullResult()
                ->getArrayResult()
        ;
        
        if(count($eservVMemDisc) > 0) {
            return $this->em->getRepository('ESERVMAINMembershipBundle:MemberDisciplinary')->find($eservVMemDisc[0]['id']);
        } else {
            return null;
        }
    }   
    
}    