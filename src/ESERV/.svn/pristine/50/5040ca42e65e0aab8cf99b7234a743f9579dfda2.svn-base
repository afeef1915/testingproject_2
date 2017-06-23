<?php

namespace ESERV\MAIN\ProfileBundle\Services\ws;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use ESERV\MAIN\ProfileBundle\Services\ProfileBundleMmUserSettingService;

class MmUserWebServices
{

    private $em;
    private $c;

    public function __construct(EntityManager $em, Container $c)
    {
        $this->em = $em;
        $this->c = $c;
    }

    public function updateMmUserSettingService($salt, $theme)
    {
        $dbCore = $this->c->get('db_core_function_services');

        if (!is_null($salt)) {
            $user = $dbCore->checkUserExistsBySalt($salt);

            if (is_null($user)) {
                return array('0' => array('Message' => 'Incorrect salt. User does not exist.'));                
            } else {
                $mm = new ProfileBundleMmUserSettingService($this->em, $this->c);
                $data_array = array(
                    'theme' => trim($theme)
                );
                if($mm->updateMmUserSetting(3, $data_array)){
                    return array('0' => array('Message' => 'User Settings table has been successfully updated.'));                    
                }else{
                    return array('0' => array('Message' => 'An error occurred during update. Please re try.')); 
                }
            }
        }     
    }

}
