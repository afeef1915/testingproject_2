<?php

namespace ESERV\TestBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ESERVTestBundleProflDevServices extends Controller {

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

    //list teachers
    public function ListGtcwMentorTeachers($params, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                        ->from('ESERVTestBundle:GtcwVMentorTeacher', $alias)
                        ->where($alias . '.contactId = :cid')
                        ->setParameter('cid', $params['contact_id'])
                ;
        if (isset($params['end_date']) && $params['end_date'] == 'Y') {
        //Do nothing           
        } else {
            $qb->andWhere($alias . '.endDate IS NULL');
        }
        if (!$result) {
            throw $this->createNotFoundException(
                    'No Teachers found-- Function "ListGtcwMentorTeachers"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    public function ListGtcwMemIndTerms($contact_id, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                        ->from('ESERVTestBundle:GtcwVMemIndTerm', $alias)
                        ->where($alias . '.contactId = :cid')
                        ->setParameter('cid', $contact_id)
//                        ->andWhere($alias . '.endDate IS NULL')
                ;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Teachers found-- Function "ListGtcwMemIndTerms"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    public function ListGtcwMemMepDetail($contact_id, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                        ->from('ESERVTestBundle:GtcwVMemMepDetail', $alias)
                        ->where($alias . '.contactId = :cid')
                        ->setParameter('cid', $contact_id)
                ;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Teachers found-- Function "ListGtcwMemMepDetail"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    public function ListGtcwMemMepModule($mem_mep_detail_id, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                        ->from('ESERVTestBundle:GtcwVMemMepModule', $alias)
                        ->where($alias . '.gtcwMemMepDetailId = :mem_mep_detail_id')
                        ->setParameter('mem_mep_detail_id', $mem_mep_detail_id)
                ;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Teachers found-- Function "ListGtcwMemMepModule"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    public function ListGtcwMemMepPayment($mem_mep_detail_id, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                        ->from('ESERVTestBundle:GtcwVMemMepPayment', $alias)
                        ->where($alias . '.gtcwMemMepDetailId = :mem_mep_detail_id')
                        ->setParameter('mem_mep_detail_id', $mem_mep_detail_id)
                ;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Teachers found-- Function "ListGtcwMemMepPayment"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    public function ListGtcwMemEpd($contact_id, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                        ->from('ESERVTestBundle:GtcwVMemEpd', $alias)
                        ->where($alias . '.contactId = :cid')
                        ->setParameter('cid', $contact_id)
                ;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Teachers found-- Function "ListGtcwMemEpd"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    public function ListGtcwMemEpdAward($mem_epd_id, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                        ->from('ESERVTestBundle:GtcwVMemEpdCat', $alias)
                        ->where($alias . '.gtcwMemEpdId = :mem_mem_epd_id')
                        ->setParameter('mem_mem_epd_id', $mem_epd_id)
                ;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Teachers found-- Function "ListGtcwMemEpdAward"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
}
