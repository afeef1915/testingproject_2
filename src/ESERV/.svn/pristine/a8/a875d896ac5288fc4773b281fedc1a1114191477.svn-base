<?php

namespace ESERV\MAIN\MembershipBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ESERVMAINMembershipBundleWorkplaceServices extends Controller 
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

    public function getWorkplaceDetailsByContactId($ContactId)
    {
        $qb = $this->em->createQueryBuilder();
        $result = NULL;
        
        $q  = $qb->select('c.id, w.code, o.name')
                    ->from('ESERVMAINMembershipBundle:Workplace', 'w')
                    ->leftJoin('w.organisation', 'o')
                    ->leftJoin('o.contact', 'c')
                    ->where('c.id = :cid')
                    ->setParameter('cid', $ContactId)
                    ->orderBy('o.name', 'ASC')
                    ->addOrderBy('w.code', 'ASC')
            ; 
        
        if ($q) {
            $tmp = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');            
            $result = $tmp[0];
        }
        
        return $result;
    }
    
    public function getWorkplaceDetailsByContactIdAndName($ContactId, $SearchTerm)
    {
        $qb = $this->em->createQueryBuilder();
        $result = NULL;
        
        $q  = $qb->select('c.id, w.code, o.name')
                    ->from('ESERVMAINMembershipBundle:Workplace', 'w')
                    ->leftJoin('w.organisation', 'o')
                    ->leftJoin('o.contact', 'c')
                    ->where('c.id = :cid')                
                    ->setParameter('cid', $ContactId)  
                    ->andWhere('o.name = :search')                                                          
                    ->setParameter('search', "Adamsdown Primary School")
//                    ->andWhere('o.name like :search')                                                          
//                    ->setParameter('search', "%".$SearchTerm."%")
                    ->orderBy('o.name', 'ASC')
                    ->addOrderBy('w.code', 'ASC')
            ; 
        
        #echo $q->getQuery()->getSql(); die;
        if ($q) {
            $tmp = $this->coreFunction->GetOutputFormat($q->getQuery(), 'array');               
           # var_dump($tmp); die;
            $result = $tmp[0];            
        }
        
        return $result;
    }
    
    public function getAllWorkplaceData(){
        $qb = $this->em->createQueryBuilder();
        $qry = $qb->select('w.id', 'w.code', 'o.name')
            ->from('ESERVMAINMembershipBundle:Workplace', 'w')
            ->leftJoin('w.organisation', 'o')
            ->leftJoin('o.contact', 'c')
            //->where('o.dateClosed IS NULL')
            ->orderBy('o.name', 'ASC')
            ->addOrderBy('w.code', 'ASC')
            ->getQuery();
        return $qry->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY); 
    }
    
    public function getWorkplaceChoiceData(){
        $workplace=$this->getAllWorkplaceData();
        $selectData=array();
        foreach($workplace as $k=>$v) {
           $selectData[$v['code']] = $v['name'];
        }
        return $selectData;
    }
    
    public function getWorkplaceChoiceDataForFilter(){
        $workplace=$this->getAllWorkplaceData();
        $selectData=array();
        foreach($workplace as $k=>$v) {
           $selectData[$v['name']] = $v['name'];
        }
        return $selectData;
    }
}
