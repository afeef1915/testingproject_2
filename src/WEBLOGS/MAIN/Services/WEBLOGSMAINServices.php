<?php

namespace WEBLOGS\MAIN\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Security\UserBundle\Services\UserBundleConstants;

class WEBLOGSMAINServices 
{
    private $em;
    private $c;

    //EntityManager and Container will be injected automatically, so you don't need to worry about passing these parameters
    public function __construct(EntityManager $em, Container $c) 
    {
        $this->em = $em;
        $this->c = $c;        
    }
    
    public function getCustomersByLoggedInUser()
    {
        $em = $this->em;
        $fosUser = $this->c->get('security.context')->getToken()->getUser();
        $customers = false;
                
        $mmu = $em->getRepository('WEBLOGSCOREMAINProfileBundle:MmUserSetting')->findOneBy(array(
                'fosUser' => $fosUser
        ));
        $mmuOrg = $em->getRepository('WEBLOGSCOREMAINProfileBundle:MmUserSettingOrg')->findBy(array(
            'mmUserSettingFos' => $mmu
        ));
        
        if($mmuOrg){
           foreach ($mmuOrg as $morg){
                $customers[] = array('raw' => $morg->getCustomerCode(), 'b64' => base64_encode($morg->getCustomerCode()));
            } 
        }
        
        return $customers;
    }   
    
    public function getLoggedInUserDetails()
    {   
        $groupNames = $this->c->get('security.context')->getToken()->getUser()->getGroupNames();    
        if(count($groupNames) > 1){
            throw new \Exception('User cannot have more than one fos groups!', 500);
        }
        
        $userGroup = null;
        $customerCode = null;
        
        if($groupNames[0] == UserBundleConstants::USER_GROUP_MTL){
            $userGroup = $groupNames[0];
        }else if($groupNames[0] == UserBundleConstants::USER_GROUP_CUSTOMER){
            $userGroup = $groupNames[0];
            $customerCode = base64_decode($this->c->get('session')->get('cc'));
        }else{
            $userGroup = $groupNames[0];
        }
        
        return array(
            'userGroup' => $userGroup,
            'customerCode' => $customerCode
        );
    }

}