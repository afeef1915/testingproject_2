<?php

namespace ESERV\MAIN\ProfileBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;


class ProfileBundleMmUserSettingOrgService extends Controller {
    
    private $em;
    private $c;
    private $coreF;
    private $dbCore;

    public function __construct(EntityManager $em, Container $c) 
    {
        $this->em = $em;
        $this->c = $c;
        $this->coreF = $this->c->get('core_function_services');
        $this->dbCore = $this->c->get('db_core_function_services');
    }    
    
    public function createRecord($mmUserSettingId, $ContactId)
    {   
        $em = $this->em;
        
        $mm_us_set = $em->getReference('\ESERV\MAIN\ProfileBundle\Entity\MmUserSetting', $mmUserSettingId);
        $org_cont = $em->getReference('\ESERV\MAIN\ContactBundle\Entity\Contact', $ContactId);
        
        $mm_org = new \ESERV\MAIN\ProfileBundle\Entity\MmUserSettingOrg();        
        $mm_org->setMmUserSetting($mm_us_set);
        $mm_org->setOrgContact($org_cont);
        
        $em->persist($mm_org);
        $em->flush();
    }
    
}
