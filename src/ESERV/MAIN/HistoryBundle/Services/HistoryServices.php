<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ESERV\MAIN\HistoryBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

/**
 * Description of FieldHistoryServices
 *
 * @author RTripathi
 */

class HistoryServices extends Controller {
    private $em;
    private $c;
    private $coreFunction;

    public function __construct(EntityManager $em, Container $c = null) {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
    }
    
    public function getFieldHistory($params, $type = 'doctrine', $alias = 'p', $query_only = false) 
    {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                        ->from('ESERVTestBundle:GtcwVHistory', $alias)
                        ->where($alias . '.entityId = :eid')
                        ->setParameter('eid', $params['entity_id'])
                        ->andWhere($alias . '.entityName = :eName')
                        ->setParameter('eName', $params['entity_name'])
                        ->andWhere($alias . '.fieldName = :fname')
                        ->setParameter('fname', $params['field_name'])
                        ->orderBy($alias . '.createdAt', 'desc')
                
                ;
        if (!$result) {
            throw $this->createNotFoundException(
                    'No Degree details found-- Function "getFieldHistory"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);                
            } else {
                return $result;
            }
        }
    }
    
    public function hasHistory($params) 
    {
        try 
        {
            $qb = $this->em->createQueryBuilder();        
            $result = $qb->select('h')
                            ->from('ESERVTestBundle:GtcwVHistory', 'h')
                            ->where('h.entityId = :eid')
                            ->setParameter('eid', $params['entity_id'])
                            ->andWhere('h.entityName = :eName')
                            ->setParameter('eName', $params['entity_name'])
                            ->andWhere('h.fieldName = :fname')
                            ->setParameter('fname', $params['field_name'])                
                    ;

            $record= $this->coreFunction->GetOutputFormat($result->getQuery(), 'array');            
            if(count($record)>0) {
                return true;
            } else {
                return false;
            }
        } catch (\RuntimeException $re) {
            echo 'An error occurred: ' . $re->getMessage();
        }
      
    }
    
}
