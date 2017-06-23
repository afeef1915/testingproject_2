<?php

namespace ESERV\TestBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ESERVTestBundleMentorAdminServices extends Controller {

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

    //list teacher list
    public function ListMentorAdmins($type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                ->from('ESERVTestBundle:GtcwVMentorAdmin', $alias);

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Mentor Admins found-- Function "ListMentorAdmins"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }

    //list mentor mentees
    public function ListMentorMentees($params, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                ->from('ESERVTestBundle:GtcwVMentorAdminMentee', $alias)
                ->where($alias . '.gtcwMentorContactId = :gtcwMentorContactId')
                ->setParameter('gtcwMentorContactId', $params['gtcw_mentor_contact_id'])
        ;

        if (isset($params['end_date']) && $params['end_date'] == 'Y') {
//            $qb->andWhere($alias . '.endDate IS NOT NULL');
        } else {
            $qb->andWhere($alias . '.endDate IS NULL');
        }

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Mentor Admins found-- Function "ListMentorMentees"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    //list employment history list
    public function ListEmpHists($gtcw_mentor_id, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                ->from('ESERVTestBundle:GtcwVMentorEmpHist', $alias)
                ->where($alias.'.gtcwMentorId = :gmid')
                ->setParameter('gmid', $gtcw_mentor_id)
        ;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Mentor Admins found-- Function "ListEmpAndPayments"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    //list payments
    public function ListPayments($gtcw_mentor_emp_hist_id, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                ->from('ESERVTestBundle:GtcwVMentorPayment', $alias)
                ->where($alias.'.gtcwMentorEmpHistId = :gmid')
                ->setParameter('gmid', $gtcw_mentor_emp_hist_id)
//                ->andWhere($alias.'.endDate IS NULL')
        ;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Mentor Admins found-- Function "ListPayments"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    //list School payments
    public function ListSchoolPayments($gtcw_mentor_emp_hist_id, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();
        
        $payType = $this->em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')
                            ->getBySystemCodeTypeAndCode(\ESERV\MAIN\Services\AppConstants::ACT_MENTOR_PAYMENT_TYPE, \ESERV\MAIN\Services\AppConstants::SC_MENTOR_PAYMENT_TYPE_SCHOOL_PAYMENTS);
        $result = $qb->select($alias)
                ->from('ESERVTestBundle:GtcwVMentorPayment', $alias)
                ->where($alias.'.gtcwMentorEmpHistId = :gmid')
                ->setParameter('gmid', $gtcw_mentor_emp_hist_id)
                ->andWhere($alias.'.payTypeId = :ptId')
                ->setParameter('ptId', $payType->getId())
//                ->andWhere($alias.'.endDate IS NULL')
        ;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Mentor Admins found-- Function "ListSchoolPayments"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    //list travel and consultant payments
    public function ListTravelAndConsultantPayments($gtcw_mentor_emp_hist_id, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();
        
        $payType = $this->em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')
                ->getBySystemCodeTypeAndCode(\ESERV\MAIN\Services\AppConstants::ACT_MENTOR_PAYMENT_TYPE, \ESERV\MAIN\Services\AppConstants::SC_MENTOR_PAYMENT_TYPE_TRAVEL_AND_CONSULTANT_PAYMENTS);
        
        $result = $qb->select($alias)
                ->from('ESERVTestBundle:GtcwVMentorPayment', $alias)
                ->where($alias.'.gtcwMentorEmpHistId = :gmid')
                ->setParameter('gmid', $gtcw_mentor_emp_hist_id)
                ->andWhere($alias.'.payTypeId = :ptId')
                ->setParameter('ptId', $payType->getId())
//                ->andWhere($alias.'.endDate IS NULL')
        ;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Mentor Admins found-- Function "ListTravelAndConsultantPayments"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    public function ListMentorCapacityCounts($contact_id, $type = 'doctrine', $alias = 'p', $query_only = false) 
    {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                ->from('ESERVTestBundle:GtcwVMentorCapacityCounts', $alias)
                ->where($alias.'.contactId = :cid')
                ->setParameter('cid', $contact_id)               
        ;
        
        if (!$result) {
            throw $this->rceateNotFoundException(
                    'No counts found-- Function "ListMentorCapacityCounts"'
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
