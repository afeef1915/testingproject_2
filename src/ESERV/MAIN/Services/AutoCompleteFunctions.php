<?php

namespace ESERV\MAIN\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class AutoCompleteFunctions extends Controller {

    private $em;
    private $c;
    private $coreFunction;
    private $qrylimit;    
    
    public function __construct(EntityManager $em, Container $c) {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');      
        $this->qrylimit = ($this->c->hasParameter('app_ac_result_limit') ? $this->c->getParameter('app_ac_result_limit') : 10);
    }
    
    public function EmployerByIdAutoComplete($param, $employerId) {
        $qb = $this->em->createQueryBuilder();
        $q = $qb->select('e.id', 'e.code', 'o.name')
            ->from('ESERVMAINMembershipBundle:Employer', 'e')
            ->leftJoin('e.organisation', 'o')
            ->andWhere('e.id =:eId')
            ->setParameter('eId', $employerId) 
        ;
        
        if ($param != ' ') {
            $qb->andWhere('e.code LIKE :code OR o.name LIKE :name')
                    ->setParameter('code', "%$param%")
                    ->setParameter('name', "%$param%")
            ;
        }
        $qb->orderBy('o.name', 'ASC');
        $qb->addOrderBy('e.code', 'ASC');
        $q->setMaxResults($this->qrylimit);
        
        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }

        $items_result = array();
        foreach ($ac_result as $obj) {
            $item = array(
                'html_result' => $obj['name'] . ' (' . $obj['code'] . ')',
                'result' => $obj['name'],
                'value' => $obj['id']
            );
            array_push($items_result, $item);
        }

        $result = array(
            'results' => $items_result
        );
        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }
    
    public function fosUserAutoComplete($param) {
        $qb = $this->em->createQueryBuilder();
        $q = $qb->select('u.id' , 'p.firstName', 'p.lastName')
                ->from('ESERVMAINProfileBundle:MmUserSetting', 'mus')
                ->leftJoin('mus.fosUser', 'u')
//                ->leftJoin('mus.user', 'u', 'WITH', 'u.id = mus.fosUser')
//                ->leftJoin('ESERVMAINSecurityBundle:User', 'u', 'WITH u.id = mus.fosUser')
                ->leftJoin('ESERVMAINContactBundle:Person', 'p', 'WITH', 'p.contact = mus.contact')
//                ->leftJoin('ESERVMAINContactBundle:Person', 'p', 'WITH p.contact = mus.contact')
        ;
        
        if ($param != ' ') {
            $qb->andWhere('p.firstName LIKE :fName OR p.lastName LIKE :lName')
                    ->setParameter('fName', "%$param%")
                    ->setParameter('lName', "%$param%")
            ;
        }
        $qb->orderBy('p.firstName', 'ASC');
        $q->setMaxResults($this->qrylimit);
        
        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }

        $items_result = array();
        foreach ($ac_result as $obj) {
            $item = array(
                'html_result' => $obj['firstName'] . " " . $obj['lastName'],
                'result' => $obj['firstName'] . " " . $obj['lastName'],
                'value' => $obj['id']
            );
            array_push($items_result, $item);
        }

        $result = array(
            'results' => $items_result
        );
        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }
    
    public function EmployerAutoComplete($param, $EmployerType = null) {
        $qb = $this->em->createQueryBuilder();
        if (is_array($EmployerType)) { 
            $q = $qb->select('e.id', 'e.code', 'o.name', 'et.code AS emp_type_code')
                ->from('ESERVMAINMembershipBundle:Employer', 'e')
                ->leftJoin('e.employerType', 'et')
                ->leftJoin('et.applicationCodeType', 'act')
                ->leftJoin('e.organisation', 'o')
                ->Where('o.dateClosed IS NULL') 
                ->andWhere('act.code = :app_type_code')
                ->setParameter('app_type_code', \ESERV\MAIN\Services\AppConstants::ACT_EMPLOYER_TYPE)
                ->andWhere('et.code IN (:emp_type_code)')
                ->setParameter('emp_type_code', $EmployerType) 
            ;        
        } else if ($EmployerType == 'CONSORTIUM') {//Add employer choosing consortium
            $q = $qb->select('e.id', 'e.code', 'o.name')
                    ->from('ESERVMAINMembershipBundle:Employer', 'e')
                    ->leftJoin('e.organisation', 'o')
                    ->leftJoin('e.employerType', 'et')
                    ->leftJoin('et.applicationCodeType', 'act')
                    ->where('o.dateClosed IS NULL')
                    ->andWhere('et.code = :emt')
                    ->setParameter('emt', \ESERV\MAIN\Services\AppConstants::AC_EMP_TYPE_CONSORTIUM_AREA)
                    ->andWhere('act.code = :act1')
                    ->setParameter('act1', \ESERV\MAIN\Services\AppConstants::ACT_EMPLOYER_TYPE)
            ;
        } else if ($EmployerType == 'School_Employer') {//Add school choosing employer in ESERV\MAIN\MembershipBundle\Controller\WorkplaceController
            $q = $qb->select('c.id', 'e.code', 'o.name')
                    ->from('ESERVMAINMembershipBundle:Employer', 'e')
                    ->leftJoin('e.organisation', 'o')
                    ->leftJoin('o.contact', 'c')
                    ->where('o.dateClosed IS NULL')
            ;
        } else if ($EmployerType == 'Agency_Employer') {//Prof _dev - Add edit Induction Term- select agency 
            $q = $qb->select('e.id', 'e.code', 'o.name')
                    ->from('ESERVMAINMembershipBundle:Employer', 'e')
                    ->leftJoin('e.organisation', 'o')
                    ->leftJoin('e.employerType', 'et')//employerType is actually applicationcode see orm
                    ->where('o.dateClosed IS NULL')
                    ->andWhere('et.code = :act_par')
                    ->setParameter('act_par', \ESERV\MAIN\Services\AppConstants::ACT_EMPLOYER_TYPE_AGENCY)
            ;
        }else if ($EmployerType == 'LA_Employer') {//Prof _dev - Add edit Induction Term- select body 
            $q = $qb->select('e.id', 'e.code', 'o.name')
                    ->from('ESERVMAINMembershipBundle:Employer', 'e')
                    ->leftJoin('e.organisation', 'o')
                    ->leftJoin('e.employerType', 'et')//employerType is actually applicationcode see orm
                    ->where('o.dateClosed IS NULL')
                    ->andWhere('et.code = :act_par')
                    ->setParameter('act_par', \ESERV\MAIN\Services\AppConstants::ACT_EMPLOYER_TYPE_LA)
            ;
        }else if ($EmployerType !== null) {
            $q = $qb->select('e.id', 'e.code', 'o.name')
                    ->from('ESERVMAINMembershipBundle:Employer', 'e')
                    ->leftJoin('e.organisation', 'o')
                    ->leftJoin('e.employerType', 'et')
                    ->leftJoin('et.applicationCodeType', 'act')
                    ->where('o.dateClosed IS NULL')
                    ->andWhere('act.code = :app_type_code')
                    ->setParameter('app_type_code', \ESERV\MAIN\Services\AppConstants::ACT_EMPLOYER_TYPE)
                    ->andWhere('et.code = :emp_type_code')
                    ->setParameter('emp_type_code', $EmployerType) 
            ;
        }
        else {
             $q = $qb->select('e.id', 'e.code', 'o.name')
                ->from('ESERVMAINMembershipBundle:Employer', 'e')
                ->leftJoin('e.organisation', 'o')
                ->Where('o.dateClosed IS NULL')
            ;           
        }
        
        if ($param != ' ') {
            $qb->andWhere('e.code LIKE :code OR o.name LIKE :name')
                    ->setParameter('code', "%$param%")
                    ->setParameter('name', "%$param%")
            ;
        }
        $qb->orderBy('o.name', 'ASC');
        $qb->addOrderBy('e.code', 'ASC');
        $q->setMaxResults($this->qrylimit);
        
//        print_r($qb->getQuery()->getArrayResult()); die;
        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }

        $items_result = array();
        foreach ($ac_result as $obj) {
            $item = array(
                'html_result' => $obj['name'] . ' (' . $obj['code'] . ')',
                'result' => $obj['name'],
                'value' => $obj['id'],                
            );
            
            if(!empty($obj['emp_type_code'])){
                $item['extra_options'] = array('emp_type_code' => $obj['emp_type_code']);
            }
            
            array_push($items_result, $item);
        }

        $result = array(
            'results' => $items_result
        );
        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }
  
    public function peopleSearchAutoComplete($array) {
//        $param_exp = explode(' ', $param);

        $qb = $this->em->createQueryBuilder();

        $q = $qb->select('p.contactId', 'p.personName', 'p.referenceNo', 'p.workplaceCode', 'p.organisationName')
                ->from('ESERVTestBundle:GtcwVPeopleSearch', 'p')
        ;

//        for ($i = 0; $i < count($param_exp); $i++) {
//            if ($param_exp[$i] != ' ') {
//                $qb->andWhere('p.personName LIKE :pname OR p.referenceNo LIKE :ref OR p.workplaceCode LIKE :wpcode OR p.organisationName LIKE :orgname')
//                        ->setParameter('pname', "%$param_exp[$i]%")
//                        ->setParameter('ref', "%$param_exp[$i]%")
//                        ->setParameter('wpcode', "%$param_exp[$i]%")
//                        ->setParameter('orgname', "%$param_exp[$i]%")
//                ;
//            }
//        }

        //See log: 9041504
        if(is_array($array)){
            if ($array['param'] != '') {
                $qb->Where('p.personName LIKE :pname OR p.referenceNo LIKE :ref OR p.workplaceCode LIKE :wpcode OR p.organisationName LIKE :orgname')
                        ->setParameter('pname', "%" . $array['param'] . "%")
                        ->setParameter('ref', "%" . $array['param'] . "%")
                        ->setParameter('wpcode', "%" . $array['param'] . "%")
                        ->setParameter('orgname', "%" . $array['param'] . "%")
                ;
            }

            if (!empty($array['contact_id'])) {
                $qb->andWhere('p.contactId <> :cid')
                        ->setParameter('cid', $array['contact_id']);
            }
        }else{
            $qb->andWhere('p.personName LIKE :pname OR p.referenceNo LIKE :ref OR p.workplaceCode LIKE :wpcode OR p.organisationName LIKE :orgname')
                    ->setParameter('pname', "%$array%")
                    ->setParameter('ref', "%$array%")
                    ->setParameter('wpcode', "%$array%")
                    ->setParameter('orgname', "%$array%")
            ;
        }
        

        $qb->orderBy('p.personName', 'ASC');
        $qb->addOrderBy('p.referenceNo', 'ASC');
        $qb->addOrderBy('p.workplaceCode', 'ASC');
        $qb->addOrderBy('p.organisationName', 'ASC');

//        if(false === $array['show_all_results'] || 'N' == $array['show_all_results']){
            $q->setMaxResults($this->qrylimit); 
//        }

        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }
        
        $items_result = array();
        foreach ($ac_result as $obj) {
            $html_result = '';
            if ($obj['workplaceCode'] != '')
//                $html_result=$obj['personName']. ' ('.$obj['referenceNo']. ') <br /><span style="font-size: 80%">School: '.$obj['organisationName'].' ('.$obj['workplaceCode'].')</span>';
                $html_result = $obj['personName'] . ' (' . $obj['referenceNo'] . ') - ' . $obj['organisationName'] . ' (' . $obj['workplaceCode'] . ')';
            else
                $html_result = $obj['personName'] . ' (' . $obj['referenceNo'] . ')';
            
            if(array_key_exists('show_name_reference', $array) && $array['show_name_reference'] == true){
                $displayResult = $obj['personName'] . ($obj['referenceNo'] ? '(' . $obj['referenceNo'] . ')' : '');
            } else {
                $displayResult = $obj['personName'];
            }
            $item = array(
                'html_result' => $html_result,
                'result' => $displayResult,
                'value' => $obj['contactId']
            );
            array_push($items_result, $item);
        }

        $result = array(
            'results' => $items_result
        );

        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }
    
    public function schoolBasedMentorSearchAutoComplete($param, $contact_id = null) {
        $param_exp = explode(' ', $param);

        $qb = $this->em->createQueryBuilder();

        $q = $qb->select('p.contactId', 'p.personName', 'p.referenceNo', 'p.workplaceCode', 'p.organisationName')
                ->from('ESERVTestBundle:GtcwVPeopleSearch', 'p')
        ;

        for ($i = 0; $i < count($param_exp); $i++) {
            if ($param_exp[$i] != ' ') {
                $qb->where('p.personName LIKE :pname')
                        ->setParameter('pname', "%$param_exp[$i]%")
                ;
            }
        }
        if ($contact_id) {
            $qb->andWhere('p.contactId <> :cid')
                    ->setParameter('cid', $contact_id);
        }
        
        $qb->orderBy('p.personName', 'ASC');
        $qb->addOrderBy('p.referenceNo', 'ASC');
        $qb->addOrderBy('p.workplaceCode', 'ASC');
        $qb->addOrderBy('p.organisationName', 'ASC');
        $q->setMaxResults($this->qrylimit);

        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }

        $items_result = array();
        foreach ($ac_result as $obj) {
            $html_result = '';
            $html_result = $obj['personName'] . ' (' . $obj['referenceNo'] . ')';
            $item = array(
                'html_result' => $html_result,
                'result' => $obj['personName'],
                'value' => $obj['contactId']
            );
            array_push($items_result, $item);
        }

        $result = array(
            'results' => $items_result
        );

        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }
    

    public function WorkplaceAutoComplete($param, $employer_id = null) {//Prof _dev - Add edit Induction Term- select school
        $qb = $this->em->createQueryBuilder();
       
        $q = $qb->select('w.id', 'w.code', 'o.name')
                ->from('ESERVMAINMembershipBundle:Workplace', 'w')
                ->leftJoin('w.organisation', 'o')
                ->leftJoin('o.contact', 'c')
                ->where('o.dateClosed IS NULL')
        ;
        if ($param != ' ') {
            $qb->andWhere('w.code LIKE :code OR o.name LIKE :name')
                    ->setParameter('code', "%$param%")->setParameter('name', "%$param%")
            ;
        } 

        if (!is_null($employer_id)) {
            $emp_services = new \ESERV\MAIN\MembershipBundle\Services\ESERVMAINMembershipBundleEmployerServices($this->em, $this->c);
            $emp_contact_id = $emp_services->getContactIdOfEmployer($employer_id);

            $rel_services = new \ESERV\MAIN\ContactBundle\Services\ContactBundleRelationshipService($this->em, $this->c);
            $wp_contact_id_array = $rel_services->getWPContactIdsFromEMPContactId($emp_contact_id);

            $qb->andWhere('c.id IN (:cid)')
                    ->setParameter('cid', $wp_contact_id_array)
            ;
        }
        
        $qb->orderBy('o.name', 'ASC');
        $qb->addOrderBy('w.code', 'ASC');
        $q->setMaxResults($this->qrylimit);
        
        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }

        $items_result = array();
        foreach ($ac_result as $obj) {
            $item = array(
                'html_result' => $obj['name'] . ' (' . $obj['code'] . ')',
                'result' => $obj['name'],
                'value' => $obj['id']
            );
            array_push($items_result, $item);
        }

        $result = array(
            'results' => $items_result
        );

        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }
    
    public function autoCompleteAllWorkplaceByEmpCode($param, $employerCode = null) {
        $qb = $this->em->createQueryBuilder();
       
        $q = $qb->select('w.wor_code as code, w.wor_name as name')
                ->from('ESERVTestBundle:GtcwVEmpWor', 'w')
                ->andWhere('w.emp_code IN (:cd)')
                ->setParameter('cd', $employerCode)
        ;
                
        if (trim($param) != '') {
            $qb->andWhere('w.wor_code LIKE :code OR w.wor_name LIKE :name')
                    ->setParameter('code', "%$param%")
                    ->setParameter('name', "%$param%")
            ;
        }
        $qb->orderBy('w.wor_name', 'ASC');
        $qb->addOrderBy('w.wor_code', 'ASC');
        $q->setMaxResults($this->qrylimit);

        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }
        $items_result = array();
        foreach ($ac_result as $obj) {
            $item = array(
                'html_result' => $obj['name'] . ' (' . $obj['code'] . ')',
                'result' => $obj['name'],
                'value' => $obj['code'],
                
            );
            array_push($items_result, $item);
        }

        return new \Symfony\Component\HttpFoundation\JsonResponse(array('results' => $items_result));
    }
    
    public function prepareAutoComplete($q, $HtmlResult, $Result, $Value = 'id') {
        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }
        $items_result = array();

        foreach ($ac_result as $obj) {
            $item = array(
                'html_result' => $obj[$HtmlResult],
                'result' => $obj[$Result],
                'value' => $obj[$Value]
            );
            array_push($items_result, $item);
        }

        $result = array(
            'results' => $items_result
        );

        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }

    public function EstablishmentAutoComplete($param, $QualificationType = \ESERV\MAIN\Services\AppConstants::AC_ITET_QUALIFICATION) {
        $qb = $this->em->createQueryBuilder();
        $q = $qb->select('o.name', 'e.code', 'e.id AS id')
                ->from('ESERVMAINQualificationBundle:Establishment', 'e')
                ->leftJoin('e.organisation', 'o')
                ->leftJoin('e.qualType', 'qt')
                ->leftJoin('qt.applicationCodeType', 'act')
                ->where('act.code = :actcode')
                ->setParameter('actcode', \ESERV\MAIN\Services\AppConstants::ACT_QUTYPE)
                ->andWhere('qt.code = :accode')
                ->setParameter('accode', $QualificationType)
        ;

//        if ($QualificationType == 'DEGREE') {
//            $q->andWhere('qt.code = :accode')
//                    ->setParameter('accode', \ESERV\MAIN\Services\AppConstants::AC_DEGREE_QUALIFICATION)
//            ;
//        } else {
//            $q->andWhere('qt.code = :accode')
//                    ->setParameter('accode', \ESERV\MAIN\Services\AppConstants::AC_ITET_QUALIFICATION)
//            ;
//        }

        if ($param != ' ') {
            $q->andWhere('e.code LIKE :code OR o.name LIKE :name')
                ->setParameter('name', "%$param%")
                ->setParameter('code', "%$param%")
            ;
        }
        
        $qb->orderBy('o.name', 'ASC');
        $q->setMaxResults($this->qrylimit);

        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }

        $items_result = array();
        foreach ($ac_result as $obj) {
            $html_result = $obj['name'] . ' (' . $obj['code'] . ')';
            $item = array(
                'html_result' => $html_result,
                'result' => $obj['name'],
                'value' => $obj['id']
            );
            array_push($items_result, $item);
        }

        $result = array(
            'results' => $items_result
        );

        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }
    
    public function allQualificationAutoComplete($param) 
    {  
        $qb = $this->em->createQueryBuilder();
        $q = $qb->select('q.id AS id', 'q.name', 'q.code', 'qt.code AS qual_type_code')
                ->from('ESERVMAINQualificationBundle:Qualification', 'q')
                ->leftJoin('q.qualType', 'qt')
                ->leftJoin('qt.applicationCodeType', 'act')
                ->where('act.code = :actcode')
                ->setParameter('actcode', \ESERV\MAIN\Services\AppConstants::ACT_QUTYPE)                
                ->andWhere('q.dateClosed IS NULL')
        ;
        
        if ($param != ' ') {
            $q->andWhere('q.name LIKE :name OR q.code LIKE :code')
                ->setParameter('name', "%$param%")
                ->setParameter('code', "%$param%")
            ;
        }
        
        $qb->orderBy('q.name', 'ASC');
        $q->setMaxResults($this->qrylimit);

        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }

        $items_result = array();
        foreach ($ac_result as $obj) {
            //$html_result = $obj['name'] . ' (' . $obj['code'] . ') - ('. $obj['qual_type_code'].')';
            $html_result = $obj['name'] . ' (' . $obj['code'] . ')';
            $item = array(
                'html_result' => $html_result,
                'result' => $obj['name'],
                'value' => $obj['id'],
                'extra_options' => array('qual_type_code' => $obj['qual_type_code'])
            );
            array_push($items_result, $item);
        }

        $result = array(
            'results' => $items_result
        );

        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }
    
    public function QualificationAutoComplete($param, $QualificationType = \ESERV\MAIN\Services\AppConstants::AC_ITET_QUALIFICATION) {  
        $qb = $this->em->createQueryBuilder();
        $q = $qb->select('q.id AS id', 'q.name', 'q.code')
                ->from('ESERVMAINQualificationBundle:Qualification', 'q')
                ->leftJoin('q.qualType', 'qt')
                ->leftJoin('qt.applicationCodeType', 'act')
                ->where('act.code = :actcode')
                ->setParameter('actcode', \ESERV\MAIN\Services\AppConstants::ACT_QUTYPE)
                ->andWhere('qt.code = :accode')
                ->setParameter('accode', $QualificationType)
                ->andWhere('q.dateClosed IS NULL')
        ;

//        if ($QualificationType == 'DEGREE') {
//            $q->andWhere('qt.code = :accode')
//                    ->setParameter('accode', \ESERV\MAIN\Services\AppConstants::AC_DEGREE_QUALIFICATION)
//            ;
//        } else {
//            $q->andWhere('qt.code = :accode')
//                    ->setParameter('accode', \ESERV\MAIN\Services\AppConstants::AC_ITET_QUALIFICATION)
//            ;
//        }

        if ($param != ' ') {
            $q->andWhere('q.name LIKE :name OR q.code LIKE :code')
                ->setParameter('name', "%$param%")
                ->setParameter('code', "%$param%")
            ;
        }
        
        $qb->orderBy('q.name', 'ASC');
        $q->setMaxResults($this->qrylimit);

        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }

        $items_result = array();
        foreach ($ac_result as $obj) {
            $html_result = $obj['name'] . ' (' . $obj['code'] . ')';
            $item = array(
                'html_result' => $html_result,
                'result' => $obj['name'],
                'value' => $obj['id']
            );
            array_push($items_result, $item);
        }

        $result = array(
            'results' => $items_result
        );

        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }
    
    public function SubjectAutoComplete($param, $extra_params = array()) {
        $qb = $this->em->createQueryBuilder();
        $q = $qb->select('s.id AS id', 's.name', 's.code')
                ->from('ESERVMAINQualificationBundle:Subject', 's')
                ->where('s.dateClosed IS NULL')
                ;
        
        if (array_key_exists('qual_type_code', $extra_params) && $extra_params['qual_type_code']) {
                $q->andWhere('a.code = :ad')
                ->setParameter('ad', $extra_params['qual_type_code']);
        }

        if ($param != ' ') {
            $q->andWhere('s.name LIKE :name OR s.code LIKE :code')
                    ->setParameter('name', "%$param%")
                    ->setParameter('code', "%$param%")
            ;
        }

        $qb->orderBy('s.name', 'ASC');
        $q->setMaxResults(40);

        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }

        $items_result = array();
        foreach ($ac_result as $obj) {
            $html_result = ' (' . $obj['code'] . ') '. $obj['name'];
            $item = array(
                'html_result' => $html_result,
                'text' => $html_result,
                'id' => $obj['id']
            );
            array_push($items_result, $item);
        }

        $result = array(
            'results' => $items_result
        );

        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }

    public function EPDAmountAwardedCategoryAutoComplete($param) {
        $qb = $this->em->createQueryBuilder();
        $searchString = array_key_exists('search_string', $param)? $param['search_string'] : '';
        $queryLimit = array_key_exists('query_limit', $param) ? $param['query_limit'] : $this->qrylimit;
        $currentDateTime = new \DateTime("now");
        $q = $qb->select('ac')
                ->from('ESERVMAINApplicationCodeBundle:ApplicationCode', 'ac')
                ->leftJoin('ac.applicationCodeType', 'act')
                ->where('act.code = :emt')
                ->setParameter('emt', \ESERV\MAIN\Services\AppConstants::ACT_PROF_DEV_CATEGORY)
//                ->andWhere('ac.dateClosed IS NULL')
                ->andWhere('ac.dateClosed IS NULL OR ac.dateClosed > :c_date')
                ->setParameter('c_date', $currentDateTime->format('Y-m-d H:i:s'))
        ;        
        if (trim($searchString) != '') {
            $qb->andWhere('ac.code LIKE :cd OR ac.name LIKE :nm')
                ->setParameter('cd', "%$searchString%")
                ->setParameter('nm', "%$searchString%")
            ;
        }
        
        $qb->orderBy('ac.name', 'ASC');
        $qb->addOrderBy('ac.code', 'ASC');
        $q->setMaxResults($queryLimit);

        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }

        $items_result = array();
        foreach ($ac_result as $obj) {
            $item = array(
                'html_result' => $obj['name'] . ' (' . $obj['code'] . ')',
                'result' => $obj['name'] . ' (' . $obj['code'] . ')',
                'value' => $obj['id']
            );
            array_push($items_result, $item);
        }

        $result = array(
            'results' => $items_result
        );

        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }
    
    /*
     * Test function to return data for select2 multiple (auto complete)
     * Please refer to the 'testAutoComplete' function in TeacherController.php under src/GTCW and
     * lines between 1554 to 1564 in DataTables.php. Routing alias is 'test_auto_complete_action' 
     * - Thanks , AJ (Anjana)
     */
    public function TestAutoComplete($param) 
    {
        $qb = $this->em->createQueryBuilder();
        $q = $qb->select('ac')
                ->from('ESERVMAINApplicationCodeBundle:ApplicationCode', 'ac')
        ;        
        if (trim($param) != '') {
            $qb->where('ac.code LIKE :cd OR ac.name LIKE :nm')
                ->setParameter('cd', "%$param%")
                ->setParameter('nm', "%$param%")
            ;
        }
        
        $qb->orderBy('ac.name', 'ASC');
        $qb->addOrderBy('ac.code', 'ASC');
        $q->setMaxResults($this->qrylimit);

        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }
        

        $items_result = array();
        foreach ($ac_result as $obj) {
            $item = array(
                'id' => $obj['id'],
                'text' => $obj['name'] . ' (' . $obj['code'] . ')',
            );
            array_push($items_result, $item);
        }

        return new \Symfony\Component\HttpFoundation\JsonResponse(array('results' => $items_result));
    }
    
    public function autoCompleteAllWorkplaceData($param, $employerId = null)
    {
        $qb = $this->em->createQueryBuilder();
        
        $q = $qb->select('w.id', 'w.code', 'o.name')
            ->from('ESERVMAINMembershipBundle:Workplace', 'w')
            ->leftJoin('w.organisation', 'o')
            ->leftJoin('o.contact', 'c')                        
        ;
        if (!is_null($employerId)) {
            $emp_services = new \ESERV\MAIN\MembershipBundle\Services\ESERVMAINMembershipBundleEmployerServices($this->em, $this->c);
            $emp_contact_id = $emp_services->getContactIdOfEmployer($employerId);

            $rel_services = new \ESERV\MAIN\ContactBundle\Services\ContactBundleRelationshipService($this->em, $this->c);
            $wp_contact_id_array = $rel_services->getWPContactIdsFromEMPContactId($emp_contact_id);

            $qb->andWhere('c.id IN (:cid)')
                    ->setParameter('cid', $wp_contact_id_array)
            ;
        }
        if (trim($param) != '') {
            $qb->andWhere('w.code LIKE :code OR o.name LIKE :name')
                    ->setParameter('code', "%$param%")->setParameter('name', "%$param%")
            ;
        }
        
        $qb->orderBy('o.name', 'ASC');
        $qb->addOrderBy('w.code', 'ASC');
        $q->setMaxResults($this->qrylimit);

        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }

        $items_result = array();
        foreach ($ac_result as $obj) {
            $item = array(
                'id' => $obj['name'],
                'text' => $obj['name'] . ' (' . $obj['code'] . ')',
            );
            array_push($items_result, $item);
        }

        return new \Symfony\Component\HttpFoundation\JsonResponse(array('results' => $items_result));
    }
    
    public function autoCompleteEmployerData($param)
    {
        $qb = $this->em->createQueryBuilder();
        $q = $qb->select('e.id', 'e.code', 'o.name')
            ->from('ESERVMAINMembershipBundle:Employer', 'e')
            ->leftJoin('e.organisation', 'o');             

        if (trim($param) != '') {
            $qb->andWhere('e.code LIKE :cd OR o.name LIKE :nm')
                ->setParameter('cd', "%$param%")
                ->setParameter('nm', "%$param%")
            ;
        }
        
        $qb->orderBy('o.name', 'ASC');
        $qb->addOrderBy('e.code', 'ASC');
        $q->setMaxResults($this->qrylimit);

        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }
        

        $items_result = array();
        foreach ($ac_result as $obj) {
            $item = array(
                'id' => $obj['name'],
                'text' => $obj['name'] . ' (' . $obj['code'] . ')',
            );
            array_push($items_result, $item);
        }

        return new \Symfony\Component\HttpFoundation\JsonResponse(array('results' => $items_result));
    }
    
    public function autoCompleteConsortiumEmployerData($param)
    {
        $qb = $this->em->createQueryBuilder();
        $q = $qb->select('e.id', 'e.code', 'o.name')
                    ->from('ESERVMAINMembershipBundle:Employer', 'e')
                    ->leftJoin('e.organisation', 'o')
                    ->leftJoin('e.employerType', 'et')
                    ->leftJoin('et.applicationCodeType', 'act')
                    ->where('o.dateClosed IS NULL')
                    ->andWhere('et.code = :emt')
                    ->setParameter('emt', \ESERV\MAIN\Services\AppConstants::AC_EMP_TYPE_CONSORTIUM_AREA)
                    ->andWhere('act.code = :act1')
                    ->setParameter('act1', \ESERV\MAIN\Services\AppConstants::ACT_EMPLOYER_TYPE)
                ;

        if (trim($param) != '') {
            $qb->andWhere('e.code LIKE :cd OR o.name LIKE :nm')
                ->setParameter('cd', "%$param%")
                ->setParameter('nm', "%$param%")
            ;
        }
        
        $qb->orderBy('o.name', 'ASC');
        $qb->addOrderBy('e.code', 'ASC');
        $q->setMaxResults($this->qrylimit);

        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }
        

        $items_result = array();
        foreach ($ac_result as $obj) {
            $item = array(
                'id' => $obj['name'],
                'text' => $obj['name'] . ' (' . $obj['code'] . ')',
            );
            array_push($items_result, $item);
        }

        return new \Symfony\Component\HttpFoundation\JsonResponse(array('results' => $items_result));
    }
       
    public function autoCompleteExternalMentorData($param) 
    {
        $qb = $this->em->createQueryBuilder();
        $q = $qb->select('ma.contactId, ma.firstName, ma.lastName, ma.referenceNo')
                ->from('ESERVTestBundle:GtcwVMentorAdmin', 'ma')
        ;
        if (trim($param) != '') {
            $qb->andWhere('ma.firstName LIKE :fname OR ma.lastName LIKE :lname')
                    ->setParameter('fname', "%$param%")->setParameter('lname', "%$param%")
            ;
        }
        $qb->orderBy('ma.firstName', 'ASC');
        $qb->addOrderBy('ma.lastName', 'ASC');
        $q->setMaxResults($this->qrylimit);
        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }
        $items_result = array();
        foreach ($ac_result as $obj) {
            $item = array(
                'id' => $obj['firstName']. ' '. $obj['lastName'],
                'text' => $obj['firstName']. ' '. $obj['lastName'],
            );
            array_push($items_result, $item);
        }
        return new \Symfony\Component\HttpFoundation\JsonResponse(array(
            'results' => $items_result
        ));
    }
    
    public function tableViewNameAutoComplete($param) {
        $databaseUser = ($this->c->hasParameter('doctrine.dbal.user') ? $this->c->getParameter('doctrine.dbal.user') : 'MERLINORA');
        $query = 'SELECT * FROM (
                    SELECT OWNER, VIEW_NAME AS TABLE_NAME, \'VIEW\' AS OBJECT_TYPE FROM ALL_VIEWS
                    UNION
                    SELECT OWNER, TABLE_NAME AS TABLE_NAME, \'TABLE\' AS OBJECT_TYPE FROM ALL_TABLES
                  ) WHERE 1=1
                  --AND OWNER = \''. $databaseUser . '\'
                ';
        if(trim($param) !== ''){
            $query .=' AND upper(TABLE_NAME) like \'%' . strtoupper($param) . '%\'';
        }
        $query .=' ORDER BY TABLE_NAME ';
        
        $query = 'SELECT * FROM (' . $query . ') Where rownum <= '. $this->qrylimit;
        $conn = $this->c->get('database_connection');        
        $data = $conn->fetchAll($query);
        $dataChoice = array();
        foreach ($data as $key => $value) {
            $item = array(
                'html_result' => $value['TABLE_NAME'],
                'result' => $value['TABLE_NAME'],
                'value' => $value['TABLE_NAME'],
            );
            array_push($dataChoice, $item);
        }
        return new \Symfony\Component\HttpFoundation\JsonResponse(array(
            'results' => $dataChoice
        ));
    }
    
    public function autoCompleteQueryMaster($param) 
    {
        $qb = $this->em->createQueryBuilder();
        $q = $qb->select('qm.id AS id, qm.name AS query_master_name, qv.viewName AS query_view, qv.name AS query_view_name')
                ->from('ESERVMAINTableQueryBundle:QueryMaster', 'qm')
                ->innerJoin('qm.queryView', 'qv')
        ;
        if (trim($param) != '') {
            $qb->andWhere('qm.name LIKE :eservQName')
                    ->setParameter('eservQName', "%$param%")
            ;
        }
        $qb->orderBy('qm.name', 'ASC');
        $qb->addOrderBy('qv.viewName', 'ASC');
        $q->setMaxResults($this->qrylimit);
        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }
        $items_result = array();
        foreach ($ac_result as $obj) {
            $item = array(
                'value' => $obj['id'],
                'html_result' => $obj['query_master_name'],
                'result' => $obj['query_master_name'],
            );
            array_push($items_result, $item);
        }
        return new \Symfony\Component\HttpFoundation\JsonResponse(array(
            'results' => $items_result
        ));
    }
     
    // Exact queries as in EmployerAutoComplete with the return set for multi select.
    public function EmployerAutoCompleteForMultiSelect($param, $EmployerType = null) {
        $qb = $this->em->createQueryBuilder();
        if (is_array($EmployerType)) {
            $q = $qb->select('e.id', 'e.code', 'o.name')
                ->from('ESERVMAINMembershipBundle:Employer', 'e')
                ->leftJoin('e.employerType', 'et')
                ->leftJoin('et.applicationCodeType', 'act')
                ->leftJoin('e.organisation', 'o')
                ->Where('o.dateClosed IS NULL') 
                ->andWhere('act.code = :app_type_code')
                ->setParameter('app_type_code', \ESERV\MAIN\Services\AppConstants::ACT_EMPLOYER_TYPE)
                ->andWhere('et.code IN (:emp_type_code)')
                ->setParameter('emp_type_code', $EmployerType) 
            ;
        } else if ($EmployerType == 'CONSORTIUM') {//Add employer choosing consortium
            $q = $qb->select('e.id', 'e.code', 'o.name')
                    ->from('ESERVMAINMembershipBundle:Employer', 'e')
                    ->leftJoin('e.organisation', 'o')
                    ->leftJoin('e.employerType', 'et')
                    ->leftJoin('et.applicationCodeType', 'act')
                    ->where('o.dateClosed IS NULL')
                    ->andWhere('et.code = :emt')
                    ->setParameter('emt', \ESERV\MAIN\Services\AppConstants::AC_EMP_TYPE_CONSORTIUM_AREA)
                    ->andWhere('act.code = :act1')
                    ->setParameter('act1', \ESERV\MAIN\Services\AppConstants::ACT_EMPLOYER_TYPE)
            ;
        } else if ($EmployerType == 'School_Employer') {//Add school choosing employer in ESERV\MAIN\MembershipBundle\Controller\WorkplaceController
            $q = $qb->select('c.id', 'e.code', 'o.name')
                    ->from('ESERVMAINMembershipBundle:Employer', 'e')
                    ->leftJoin('e.organisation', 'o')
                    ->leftJoin('o.contact', 'c')
                    ->where('o.dateClosed IS NULL')
            ;
        } else if ($EmployerType == 'Agency_Employer') {//Prof _dev - Add edit Induction Term- select agency 
            $q = $qb->select('e.id', 'e.code', 'o.name')
                    ->from('ESERVMAINMembershipBundle:Employer', 'e')
                    ->leftJoin('e.organisation', 'o')
                    ->leftJoin('e.employerType', 'et')//employerType is actually applicationcode see orm
                    ->where('o.dateClosed IS NULL')
                    ->andWhere('et.code = :act_par')
                    ->setParameter('act_par', \ESERV\MAIN\Services\AppConstants::ACT_EMPLOYER_TYPE_AGENCY)
            ;
        }else if ($EmployerType == 'LA_Employer') {//Prof _dev - Add edit Induction Term- select body 
            $q = $qb->select('e.id', 'e.code', 'o.name')
                    ->from('ESERVMAINMembershipBundle:Employer', 'e')
                    ->leftJoin('e.organisation', 'o')
                    ->leftJoin('e.employerType', 'et')//employerType is actually applicationcode see orm
                    ->where('o.dateClosed IS NULL')
                    ->andWhere('et.code = :act_par')
                    ->setParameter('act_par', \ESERV\MAIN\Services\AppConstants::ACT_EMPLOYER_TYPE_LA)
            ;
        }else if ($EmployerType !== null) {
            $q = $qb->select('e.id', 'e.code', 'o.name')
                    ->from('ESERVMAINMembershipBundle:Employer', 'e')
                    ->leftJoin('e.organisation', 'o')
                    ->leftJoin('e.employerType', 'et')
                    ->leftJoin('et.applicationCodeType', 'act')
                    ->where('o.dateClosed IS NULL')
                    ->andWhere('act.code = :app_type_code')
                    ->setParameter('app_type_code', \ESERV\MAIN\Services\AppConstants::ACT_EMPLOYER_TYPE)
                    ->andWhere('et.code = :emp_type_code')
                    ->setParameter('emp_type_code', $EmployerType) 
            ;
        }
        else {
             $q = $qb->select('e.id', 'e.code', 'o.name')
                ->from('ESERVMAINMembershipBundle:Employer', 'e')
                ->leftJoin('e.organisation', 'o')
                ->Where('o.dateClosed IS NULL')
            ;           
        }
        
        if ($param != ' ') {
            $qb->andWhere('e.code LIKE :code OR o.name LIKE :name')
                    ->setParameter('code', "%$param%")
                    ->setParameter('name', "%$param%")
            ;
        }
        $qb->orderBy('o.name', 'ASC');
        $qb->addOrderBy('e.code', 'ASC');
        $q->setMaxResults($this->qrylimit);
        
//        print_r($qb->getQuery()->getArrayResult()); die;
        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }

        $items_result = array();
        foreach ($ac_result as $obj) {
            $item = array(
                'html_result' => $obj['name'] . ' (' . $obj['code'] . ')',
                'text' => $obj['name'],
                'id' => $obj['id']
            );
            array_push($items_result, $item);
        }

        $result = array(
            'results' => $items_result
        );
        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        
    }

    
    /**
     * 
     * @param type $param: String - Search term 
     * @param type $EmployerType: Array of employer type(s)
     * @param type $employer_contact_id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function SubContractorsForContractorAutoComplete($param, $EmployerType = null, $employer_contact_id = null) {

        // Revisit the below query !
        $query = ' SELECT emp.id AS employer_id, emp.code AS employer_code, org.name AS org_name, org.contact_id as contact_id,  rl.contact_id_a, rl.contact_id_b
                        FROM employer emp 
                        LEFT JOIN application_code apc ON emp.employer_type_id = apc.id 
                        LEFT JOIN application_code_type apt ON apc.application_code_type_id = apt.id 
                        LEFT JOIN organisation org ON emp.organisation_id = org.id
                        LEFT JOIN relationship rl ON org.contact_id = rl.contact_id_a 
                        LEFT JOIN relationship_type rt ON rl.relationship_type_id = rt.id
                        
                        WHERE org.date_closed IS NULL
                        AND apt.code = ?
                        AND apc.code IN (?) 
                        AND (emp.code LIKE ? OR org.name LIKE ?)   
                        AND rl.contact_id_b = ?
                        AND rownum <= ' . $this->qrylimit .
                ' ORDER BY org.name ASC, emp.code ASC';

        $params = array(AppConstants::ACT_EMPLOYER_TYPE, AppConstants::AC_EMP_TYPE_WORK_BASED_SUB_CONTRACTOR, "%$param%", "%$param%", $employer_contact_id);

        $ac_result = $this->c->get('db_core_function_services')->runRawSql($query, $params);
        
        $items_result = array();
        foreach ($ac_result as $obj) {
            $item = array(
                'html_result' => $obj['ORG_NAME'] . ' (' . $obj['EMPLOYER_CODE'] . ')',
                'result' => $obj['ORG_NAME'],
                'value' => $obj['EMPLOYER_ID']
            );
            array_push($items_result, $item);
        }

        $result = array(
            'results' => $items_result
        );
        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }
    
    
    public function contractorsForSubContractorAutoComplete($param, $EmployerType = null, $employer_contact_id = null) 
    {   
        $query = 'SELECT emp.id AS employer_id, emp.code AS employer_code, org.name AS org_name, org.contact_id as contact_id,  rl.contact_id_a, rl.contact_id_b
                        FROM employer emp 
                        LEFT JOIN application_code apc ON emp.employer_type_id = apc.id 
                        LEFT JOIN application_code_type apt ON apc.application_code_type_id = apt.id 
                        LEFT JOIN organisation org ON emp.organisation_id = org.id
                        LEFT JOIN relationship rl ON org.contact_id = rl.contact_id_b 
                        LEFT JOIN relationship_type rt ON rl.relationship_type_id = rt.id

                        WHERE org.date_closed IS NULL
                        AND apt.code = ?
                        AND apc.code IN (?) 
                        AND (emp.code LIKE ? OR org.name LIKE ?)   
                        AND rl.contact_id_a = ?
                        AND rownum <= ' . $this->qrylimit .
                ' ORDER BY org.name ASC, emp.code ASC';

        $params = array(AppConstants::ACT_EMPLOYER_TYPE, AppConstants::AC_EMP_TYPE_WORK_BASED_CONTRACTOR, "%$param%", "%$param%", $employer_contact_id);

        $ac_result = $this->c->get('db_core_function_services')->runRawSql($query, $params);
        
        $items_result = array();
        foreach ($ac_result as $obj) {
            $item = array(
                'html_result' => $obj['ORG_NAME'] . ' (' . $obj['EMPLOYER_CODE'] . ')',
                'result' => $obj['ORG_NAME'],
                'value' => $obj['EMPLOYER_ID']
            );
            array_push($items_result, $item);
        }

        $result = array(
            'results' => $items_result
        );
        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }
    
    public function AllEstablishmentAutoComplete($param) {
        $qb = $this->em->createQueryBuilder();
        $q = $qb->select('o.name', 'e.code', 'e.id AS id')
                ->from('ESERVMAINQualificationBundle:Establishment', 'e')
                ->leftJoin('e.organisation', 'o')
        ;

        if ($param != ' ') {
            $q->andWhere('e.code LIKE :code OR o.name LIKE :name')
                ->setParameter('name', "%$param%")
                ->setParameter('code', "%$param%")
            ;
        }
        
        $qb->orderBy('o.name', 'ASC');
        $q->setMaxResults($this->qrylimit);

        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }

        $items_result = array();
        foreach ($ac_result as $obj) {
            $html_result = $obj['name'] . ' (' . $obj['code'] . ')';
            $item = array(
                'html_result' => $html_result,
                'result' => $obj['name'],
                'value' => $obj['id']
            );
            array_push($items_result, $item);
        }

        $result = array(
            'results' => $items_result
        );

        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }
        
    public function allQualificationListAutoComplete($param) 
    {  
        $qb = $this->em->createQueryBuilder();
        
        $q = $qb->select('q.id AS id', 'q.name', 'q.code')
                ->from('ESERVMAINQualificationBundle:Qualification', 'q')             
                ->where('q.dateClosed IS NULL')
        ;
        
        if ($param != ' ') {
            $q->andWhere('q.name LIKE :name OR q.code LIKE :code')
                ->setParameter('name', "%$param%")
                ->setParameter('code', "%$param%")
            ;
        }
        
        $qb->orderBy('q.name', 'ASC');
        $q->setMaxResults($this->qrylimit);

        if (!$q) {
            $ac_result = array();
        } else {
            $ac_result = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
        }

        $items_result = array();
        foreach ($ac_result as $obj) {
            //$html_result = $obj['name'] . ' (' . $obj['code'] . ') - ('. $obj['qual_type_code'].')';
            $html_result = $obj['name'] . ' (' . $obj['code'] . ')';
            $item = array(
                'html_result' => $html_result,
                'result' => $obj['name'],
                'value' => $obj['id'],
                #'extra_options' => array('qual_type_code' => $obj['qual_type_code'])
            );
            array_push($items_result, $item);
        }

        $result = array(
            'results' => $items_result
        );

        return new \Symfony\Component\HttpFoundation\JsonResponse($result);
    }
}
