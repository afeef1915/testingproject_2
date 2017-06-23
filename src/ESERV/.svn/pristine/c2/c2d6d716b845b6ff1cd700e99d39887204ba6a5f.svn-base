<?php

namespace ESERV\MAIN\MembershipBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ESERVMAINMembershipBundleContRateServices extends Controller 
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

    public function getCurrentContAmount($data)
    {   
        try{
            $qb = $this->em->createQueryBuilder();
            $result = $qb->select('cr.contAmount, cr.changeOverDate')
                    ->from('ESERVMAINMembershipBundle:ContRate', 'cr')
                    ->leftJoin('cr.contRateMaster', 'crm');
                
            if(array_key_exists('payment_method_id', $data) && null != $data['payment_method_id']){
                $result = $result->leftJoin('cr.paymentMethod', 'pm');
            }
            
            if(array_key_exists('fund_id', $data) && null != $data['fund_id']){
                $result = $result->leftJoin('cr.fund', 'fu');
            }
            
            if(array_key_exists('frequency_id', $data) && null != $data['frequency_id']){
                $result = $result->leftJoin('cr.frequency', 'fr');
            }

            $result = $result->where('crm.id = :eservCrmId')
                ->setParameter('eservCrmId', $data['cont_rate_master_id'])                
                ;
          
            if(array_key_exists('payment_method_id', $data) && null != $data['payment_method_id']){
                $result = $result->andWhere('pm.id = :eservPmId')
                        ->setParameter('eservPmId', $data['payment_method_id'])
                ;
            }
            
            if(array_key_exists('fund_id', $data) && null != $data['fund_id']){
                $result = $result->andWhere('fu.id = :eservFuId')
                        ->setParameter('eservFuId', $data['fund_id'])
                ;
            }
            
            if(array_key_exists('frequency_id', $data) && null != $data['frequency_id']){
                $result = $result->andWhere('fr.id = :eservFrId')
                        ->setParameter('eservFrId', $data['frequency_id'])
                ;
            }
            
            $result = $result                    
                    ->orderBy('cr.changeOverDate', 'desc')
                    ->getQuery();

            $result_array = $this->coreFunction->GetOutputFormat($result, 'array');
            $tmp_count = count($result_array);
            $cur_year = date('Y');
            
            $indx = 0;
            $amount = 0;
            for($a = 0; $a < $tmp_count ; $a++ ){               
                if($cur_year >= $result_array[$a]['changeOverDate']->format('Y')){
                    $indx = $a;
                    $amount = $result_array[$a]['contAmount'];
                    break;
                }                
            }
            return $amount;         
            
        }catch(\Exception $e){            
            throw new \Exception($e->getMessage(), 500);
        }
    }
    
    public function getMemberRateByMemberId($member_id)
    {
        try{
            $qb = $this->em->createQueryBuilder();
            $result = $qb->select('crm.id AS cont_rate_master_id, fu.id AS fund_id, fr.id AS frequency_id')
                    ->from('ESERVMAINMembershipBundle:MemberRate', 'mr')
                    ->leftJoin('mr.member', 'm')
                    ->leftJoin('mr.contRateMaster', 'crm')
                    ->leftJoin('mr.fund', 'fu')
                    ->leftJoin('mr.frequency', 'fr')                    
                    ->where('m.id = :eservMId')
                    ->setParameter('eservMId', $member_id)
                    ->getQuery();

            return $this->coreFunction->GetOutputFormat($result, 'array')[0];
            
        }catch(\Exception $e){ 
            
            throw new \Exception($e->getMessage(), 500);
        }
    }
    
}
