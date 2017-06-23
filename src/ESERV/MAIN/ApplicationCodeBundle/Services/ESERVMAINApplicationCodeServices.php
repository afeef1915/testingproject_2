<?php

namespace ESERV\MAIN\ApplicationCodeBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ESERVMAINApplicationCodeServices extends Controller {

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

    //list Application Codes
    public function ListApplicationCodes($params = null, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        if(is_array($params)){
            $excludeEnded = array_key_exists('exclude_ended', $params) ? $params['exclude_ended'] : false;
            $applicationCodeTypeId = array_key_exists('type_id', $params) ? $params['type_id'] : null;
        } else {
            $applicationCodeTypeId = $params;
            $excludeEnded = false;
        }
        if (!is_null($applicationCodeTypeId)) {
            $result = $qb->select($alias)
                    ->from('ESERVMAINApplicationCodeBundle:EservVApplicationCode', $alias)
                    ->where($alias . '.application_code_type_id = :application_code_type_id')
                    ->setParameter('application_code_type_id', $applicationCodeTypeId)
                ;
            if($excludeEnded){
                $currentDateTime = new \DateTime("now");
                $result->andWhere($alias . '.dateClosed is NULL OR '. $alias . '.dateClosed > :c_date')
                        ->setParameter('c_date', $currentDateTime->format('Y-m-d H:i:s'))
                ;
            }
        } else {
            $result = $qb->select($alias)
                    ->from('ESERVMAINApplicationCodeBundle:ApplicationCodeType', $alias);
        }

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Application Code found-- Function "ListApplicationCodes"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    public function getApplicationCodeNameById($applicationCodeId ) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select('ac')
                ->from('ESERVMAINApplicationCodeBundle:ApplicationCode', 'ac')
                ->where('ac.id = :application_code_id')
                ->setParameter('application_code_id', $applicationCodeId)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        if($result){
            return $result->getName();
        } else {
            return null;
        }
    }

}
