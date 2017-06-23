<?php

namespace ESERV\TestBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ESERVTestBundleTeacherServices extends Controller {

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
    public function ListTeachers($type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                        ->from('ESERVTestBundle:GtcwVTeacher', $alias)
//                        ->where($alias.'.code = :eservMoCode')
//                        ->setParameter('eservMoCode', 'TEA')
                        ;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Teachers found-- Function "ListTeachers"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    //list fe lectures
    public function ListFELecturers($type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                        ->from('ESERVTestBundle:GtcwVTeacher', $alias)
                        ->where($alias.'.code = :eservMoCode')
                        ->setParameter('eservMoCode', 'FE');

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Teachers found-- Function "ListTeachers"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }

    public function ListProfessionalDevelopment($type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                        ->from('ESERVTestBundle:GtcwVProfDevTeachers', $alias)
                ;

//        if (isset($contact_status_code)) 
//        {
//            if($contact_status_code != ""){
//                if($contact_status_code == 'teacher'){
//                    $qb->where($alias . '.membership_id IS NOT NULL')
//                       ->andWhere($alias . '.system_code = :sc')
//                       ->setParameter('sc', 'A')
//                    ;
//                }
//                else{
//                    $qb->where($alias . '.contact_status_code = :csd')
//                       ->setParameter('csd', $contact_status_code) 
//                    ;   
//                }                
//            }
//        }
        
        if (!$result) {
            throw $this->createNotFoundException(
                    'No Teachers found-- Function "ListProfessionalDevelopment"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }

    public function ListTeachersBySchoolOrgId($organisation_id, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();
        $result = $qb->select($alias)
                        ->from('ESERVTestBundle:GtcwVSchoolTeachers', $alias)
                        ->where($alias.'.organisation_id = :school_org_id')
                        ->setParameter('school_org_id', $organisation_id);

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Teachers found-- Function "ListTeachersBySchoolOrgId"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    public function ListTeachersAndLSWBySchoolOrgId($organisation_id, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();
        $result = $qb->select($alias)
                        ->from('GTCWGTCWBundle:GtcwVSchoolTeaLsw', $alias)
                        ->where($alias.'.organisation_id = :school_org_id')
                        ->setParameter('school_org_id', $organisation_id);

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Teachers found-- Function "ListTeachersAndLSWBySchoolOrgId"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    public function ListEmpDetailsByContactId($params, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();
        $result = $qb->select($alias)
                        ->from('ESERVTestBundle:GtcwVEmpDetail', $alias)
                        ->where($alias.'.contactId = :contact_id')
                        ->setParameter('contact_id', $params['contact_id'])
                ;
        
        if (!array_key_exists('ignore_where_conditions',  $params)) {
            if (isset($params['end_date']) && $params['end_date'] == 'Y') {
                $qb->orderBy($alias. '.startDate', 'DESC');
            } else if (isset($params['end_date']) && $params['end_date'] == 'NOTNULL') {
                $qb->andWhere($alias . '.endDate IS NOT NULL')
                    ->orderBy($alias. '.endDate', 'DESC');
            } else {
                $qb->andWhere($alias . '.endDate IS NULL')
                    ->orderBy($alias. '.startDate', 'DESC');
            }
        }else if(array_key_exists('ignore_where_conditions',  $params) && !$params['ignore_where_conditions']){
            if (isset($params['end_date']) && $params['end_date'] == 'Y') {
                $qb->orderBy($alias. '.startDate', 'DESC');
            } else if (isset($params['end_date']) && $params['end_date'] == 'NOTNULL') {
                $qb->andWhere($alias . '.endDate IS NOT NULL')
                    ->orderBy($alias. '.endDate', 'DESC');
            } else {
                $qb->andWhere($alias . '.endDate IS NULL')
                    ->orderBy($alias. '.startDate', 'DESC');
            }
        }       
        
        
        if (!$result) {
            throw $this->createNotFoundException(
                    'No Teachers found-- Function "ListEmpDetailsByContactId"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }
    
    public function ListEmpHistDetailsByEmpDetailsId($emp_detail_id, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();
        $result = $qb->select($alias)
                        ->from('ESERVTestBundle:GtcwVEmpDetailHist', $alias)
                        ->where($alias.'.employmentDetailId = :emp_detail_id')
                        ->setParameter('emp_detail_id', $emp_detail_id)
                        ->orderBy($alias. '.createdAt', 'DESC')
                ;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Teachers found-- Function "ListEmpHistDetailsByEmpDetailsId"'
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
