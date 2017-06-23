<?php

namespace ESERV\MAIN\MembershipBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ESERVMAINMembershipBundleEmployerServices extends Controller 
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

    /*
     * Checks whether code is existing in the Employer table.
     * Optionally, exclude_code parameter will prevent that code from appearing in the results code array.
     */
    public function getEmployerCodes($code, $exclude_code=null)
    {
        $qb = $this->em->createQueryBuilder();
        $codes_array = array();
        $formatted_array = array();

        $codes_query = $qb->select('e.code')
                ->from('ESERVMAINMembershipBundle:Employer', 'e')                
        ;
        
        if(!is_null($exclude_code)){
            $codes_query->where('e.code != :ex ')
                ->setParameter('ex', $exclude_code);
        }
        
        if (!$codes_query) {
            $codes_array = array();
        } else {
            $codes_array = $this->c->get('core_function_services')->GetOutputFormat($codes_query->getQuery(), 'array');
        }
        
        foreach($codes_array as $k => $v){
            $formatted_array[] = $v['code'];
        }
        
        if(in_array($code, $formatted_array)){
            return true;
        }else{
            return false;
        }
    }
    
    public function getContactIdOfEmployer($EmployerId)
    {
        $qb = $this->em->createQueryBuilder();
        $q  = $qb->select('c.id')
                    ->from('ESERVMAINMembershipBundle:Employer', 'e')
                    ->leftJoin('e.organisation', 'o')
                    ->leftJoin('o.contact', 'c')
                    ->where('e.id = :eid')
                    ->setParameter('eid', $EmployerId)
            ; 
        
        if ($q) {
            $contact_id = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');
            if(isset($contact_id[0]['id'])){
              return $contact_id[0]['id'];
            }
        }else{
            return null;
        } 
        
    }
    
    public function getAllEmployerData(){
        $qb = $this->em->createQueryBuilder();       
        $qry = $qb->select('e.id', 'e.code', 'o.name')
            ->from('ESERVMAINMembershipBundle:Employer', 'e')
            ->leftJoin('e.organisation', 'o')
            //->where('o.dateClosed IS NULL')
            ->orderBy('o.name', 'ASC')
            ->addOrderBy('e.code', 'ASC')
            ->getQuery();
        return $qry->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY); 
    }
    
    public function getEmployerSelectData(){
        $employers=$this->getAllEmployerData();
        $selectData=array();
        foreach($employers as $k=>$v) {
           array_push($selectData, $v);
        }
        return $selectData;
    }
    
    public function getEmployerChoiceData(){
        $employers=$this->getAllEmployerData();
        $selectData=array();
        foreach($employers as $k=>$v) {
           $selectData[$v['code']] = $v['name'];
        }
        return $selectData;
    }
    
    public function getEmployerChoiceDataForFilter(){
        $employers=$this->getAllEmployerData();
        $selectData=array();
        foreach($employers as $k=>$v) {
           $selectData[$v['name']] = $v['name'];
        }
        return $selectData;
    }
    
    //List employees of employer
    public function ListEmployeesOfEmployer($data, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();        
        $emp_id = $data['emp_id'];
        $emp_type = $data['emp_type'];

        switch ($emp_type) {
            case \ESERV\MAIN\Services\AppConstants::AC_EMP_TYPE_WORK_BASED_SUB_CONTRACTOR:
                $result = $qb->select($alias)
                        ->from('ESERVMAINMembershipBundle:EservVEmployeesOfEmployer', $alias)
                        ->where($alias . '.otherEmployerId = :eservOtherEmployerId')
                        ->setParameter('eservOtherEmployerId', $emp_id);
                break;
            default:
                $result = $qb->select($alias)
                        ->from('ESERVMAINMembershipBundle:EservVEmployeesOfEmployer', $alias)
                        ->where($alias . '.employerId = :eservEmployerId')
                        ->setParameter('eservEmployerId', $emp_id);
        }

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Employers found-- Function "ListEmployeesOfEmployer"'
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
