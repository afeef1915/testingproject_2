<?php

namespace WEBLOGS\MAIN\COMMON\CommonBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

//name of the class shoule be same as the 'name' in the $data array in above 'myDataTableDataAction' function
class CommonBundleServices extends Controller {

    private $em;
    private $c;
    private $coreFunction;
    private $dBCoreFunction;
    private $eservSecurity;

    //EntityManager and Container will be injected automatically, so you don't need to worry about passing these parameters
    public function __construct(EntityManager $em, Container $c) {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
        $this->dBCoreFunction = $this->c->get('db_core_function_services');
        $this->eservSecurity = $c->get('security_services');
    }

    //name of the following function shoule be same as the 'function_name' in the $data array in above 'myDataTableDataAction' function
    //$type needs to be 'doctrine' and $query_only needs to be 'false' all the time. $alias can be anything

    public function ListMyLogsMTL($options, $alias = 'al', $query_only = false) {

        $qb = $this->em->createQueryBuilder();
        $user_id = $this->eservSecurity->getFosUserId();
        //print_r($options);die;


        $result = $qb->select('al')
                ->from('WEBLOGSMAINCOMMONCommonBundle:VMyLogs', 'al') //We are getting data from the 'person' table
        ;
        if (array_key_exists('flag', $options) && $options['flag'] != 1) {

            if (array_key_exists('person_id', $options) && $options['person_id'] != null) {
                $qb->andWhere('al.mtl_person_id = :person_id')
                        ->setParameter('person_id', $options['person_id'])
                ;
            }
        }
//        if (array_key_exists('userGroup', $options) && $options['userGroup'] == 'CUSTOMER') {
//
//        }
        //print_r($options);die;
//        if (array_key_exists('customerCode', $options) && $options['customerCode'] != null) {
//
//            $qb->where('al.customer = :custCode')
//                    ->setParameter('custCode', $options['customerCode'])
//            ;
//        }
//        if (array_key_exists('userGroup', $options) && $options['userGroup'] == 'CUSTOMER') {
//
//            if (array_key_exists('fullname', $options) && $options['fullname'] != null) {
//                $qb->andWhere('al.assigned_to_id = :fullname')
//                        ->setParameter('fullname', $options['fullname'])
//                ;
//
//                //echo $result->getQuery()->getSql();die;
//            }
//        }
//        else
//        {
        //}
//

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Persons found -- Function "ListMyLogsMTL"'  //We are throwing an exception if there are no results
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $options['type']); //Returning the results as a doctrine object
            } else {
                return $result; //Returning the query in case you need to debug the SQL. You need to set $query_only to true
            }
        }
    }

    public function ListMyLogs($options, $alias = 'al', $query_only = false) {

        $qb = $this->em->createQueryBuilder();
        $user_id = $this->eservSecurity->getFosUserId();

        $result = $qb->select('al')
                ->from('WEBLOGSMAINCOMMONCommonBundle:VMyLogs', 'al') //We are getting data from the 'person' table
        ;

        //print_r($options);die;
        if (array_key_exists('customerCode', $options) && $options['customerCode'] != null) {

            $qb->where('al.customer = :custCode')
                    ->setParameter('custCode', $options['customerCode'])
            ;
        }


        if (array_key_exists('userGroup', $options) && $options['userGroup'] == 'CUSTOMER') {

            if (array_key_exists('flag', $options) && $options['flag'] == 1) {
                
                if (array_key_exists('assigned_to_id', $options) && $options['assigned_to_id'] != NULL) {

                    if (array_key_exists('fullname', $options) && $options['fullname'] != null) {


                        $qb->andWhere('al.assigned_to_id = :fullname')
                                ->setParameter('fullname', $options['fullname'])
                        ;

                        //echo $result->getQuery()->getSql();die;
                    }
                }
            }
        }

//

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Persons found -- Function "ListMylogs"'  //We are throwing an exception if there are no results
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $options['type']); //Returning the results as a doctrine object
            } else {
                return $result; //Returning the query in case you need to debug the SQL. You need to set $query_only to true
            }
        }
    }

    //dashboard data   mtl
    public function ListMyLogs1($type = 'doctrine', $alias = 'al', $query_only = false) {

        $qb = $this->em->createQueryBuilder();
        $user_id = $this->eservSecurity->getFosUserId();
        $result = $qb->select('al')
                ->from('WEBLOGSMAINCOMMONCommonBundle:VMyLogs', 'al') //We are getting data from the 'person' table
        ;


//          $qb->Where('al.attention_of = :fullname')
//                   ->setParameter('fullname', 'MTL')
//              ;
//        $k=$result->getQuery()->getSql();
//        print_r($k);die;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Persons found -- Function "ListMylogs1"'  //We are throwing an exception if there are no results
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type); //Returning the results as a doctrine object
            } else {
                return $result; //Returning the query in case you need to debug the SQL. You need to set $query_only to true
            }
        }
    }

    public function ListMyLogs2($type = 'doctrine', $alias = 'al', $query_only = false) {

        $qb = $this->em->createQueryBuilder();
        $user_id = $this->eservSecurity->getFosUserId();
        $result = $qb->select('al')
                ->from('WEBLOGSMAINCOMMONCommonBundle:VMyLogs', 'al') //We are getting data from the 'person' table
        ;


        $qb->Where('al.attention_of != :fullname')
                ->setParameter('fullname', 'MTL')
        ;
//        $k=$result->getQuery()->getSql();
//        print_r($k);die;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Persons found -- Function "ListMylogs2"'  //We are throwing an exception if there are no results
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type); //Returning the results as a doctrine object
            } else {
                return $result; //Returning the query in case you need to debug the SQL. You need to set $query_only to true
            }
        }
    }

    public function ListMyLogs3($type = 'doctrine', $alias = 'al', $query_only = false) {

        $qb = $this->em->createQueryBuilder();
        $user_id = $this->eservSecurity->getFosUserId();
        $result = $qb->select('al')
                ->from('WEBLOGSMAINCOMMONCommonBundle:VMyLogs', 'al') //We are getting data from the 'person' table
        ;


        $qb->Where('al.attention_of = :fullname')
                ->setParameter('fullname', 'MTL')
        ;
//        $k=$result->getQuery()->getSql();
//        print_r($k);die;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Persons found -- Function "ListMylogs1"'  //We are throwing an exception if there are no results
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type); //Returning the results as a doctrine object
            } else {
                return $result; //Returning the query in case you need to debug the SQL. You need to set $query_only to true
            }
        }
    }

    public function ListMyAttachments($options, $type = 'doctrine', $alias = 'al', $query_only = false) {
        $log_id = $options['log_id'];
        $qb = $this->em->createQueryBuilder();
        $user_id = $this->eservSecurity->getFosUserId();
        $result = $qb->select('al')
                ->from('WEBLOGSMAINCOMMONCommonBundle:VmediaStore', 'al') //We are getting data from the 'person' table
                ->where('al.job_no = :log_id')
//
                ->setParameter('log_id', $log_id);

        // $k=$result->getQuery()->getSql();
        // print_r($k);die;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No attachments found -- Function "ListMyAttachments"'  //We are throwing an exception if there are no results
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type); //Returning the results as a doctrine object
            } else {
                return $result; //Returning the query in case you need to debug the SQL. You need to set $query_only to true
            }
        }
    }

}
