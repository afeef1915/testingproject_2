<?php

namespace Security\UserBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class UserBundleProfileService extends Controller {
    
    private $em;
    private $c;
    private $coreF;
    private $dbCore;
    private $eservSecurity;

    public function __construct(EntityManager $em, Container $c)
    {
        $this->em = $em;
        $this->c = $c;
        $this->coreF = $c->get('core_function_services');
        $this->dbCore = $c->get('db_core_function_services');
        $this->eservSecurity = $c->get('security_services');
    }
    
    public function show($type = 'array')
    {        
        $fields = array();
        $result = $this->em->createQueryBuilder();
        $fos_user_id = $this->eservSecurity->getFosUserId();
//        
//        $contact_id = $this->coreF->getUserContactId();        
//        $contact = new ContactBundleContactService($this->em, $this->c);                
//        $contact = $contact->show($contact_id,false);
        
        $fos_user = $this->eservSecurity->getFosUserRecord();
               
        $result = $result
                ->select('p')
                ->from('SecurityUserBundle:MmUserSetting', 'p')
                ->where('p.fos_user_id = :fos_user_id')
                ->setParameter('fos_user_id', $fos_user_id)                
                ->getQuery();

        if (!$result) {
            throw $this->createNotFoundException(
                    'No MM User Settings record found for fos user id ' . $fos_user_id
            );
        } else {            
//           $fields['mm_user_setting'] = $this->coreF->GetOutputFormat($result, $type);        
//           $fields['contact'] = $contact;
           $fields['fos_user'] = $fos_user;
           return $fields;
        }
        
    }
    
    
    
}



