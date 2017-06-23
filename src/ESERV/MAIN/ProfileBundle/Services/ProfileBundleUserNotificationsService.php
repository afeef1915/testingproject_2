<?php

namespace ESERV\MAIN\ProfileBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use ESERV\MAIN\Services\AppConstants;

class ProfileBundleUserNotificationsService extends Controller {

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
    
    //When calling this function please wrap it with your own transaction and flush it from the 
    //calling function as this does not flush the entitiy manager by default.
    public function createUserNotification($type, $created_by, $title, $description, $priority, $is_active = 'Y', $extra_params = null, $em = null, $file_id = null)
    {   
        if(isset($type) && isset($title) && isset($description)){
            try{
                $user_notification = new \ESERV\MAIN\ProfileBundle\Entity\UserNotification();
                if($em === null){
                    $em = $this->em;                  
                }
                //At the moment we all share one mm user profile id which is 1
                $mm_user_profile = $em->getReference('ESERV\MAIN\ProfileBundle\Entity\MmUserProfile', 1);
                $created_user_id = $em->getReference('ESERV\MAIN\SecurityBundle\Entity\User', $created_by);
                
                $user_notification->setMmUserProfile($mm_user_profile);
                $user_notification->setFosUser($created_user_id);
                $user_notification->setType($type);
                $user_notification->setTitle($title);
                $user_notification->setPriority($priority === '' ? 'LOW' : $priority);
                $user_notification->setDescription($description === '' ? '  ' : $description);
                $user_notification->setIsActive($is_active);
                if(!is_null($file_id)){
                    $user_notification->setFileId($file_id);
                }                
                
                if(isset($extra_params) && is_array($extra_params)){
                    if(array_key_exists('total_count', $extra_params) && array_key_exists('failed_count', $extra_params)){
                       
                       $level = '';
                       $total_count = $extra_params['total_count'];
                       $failed_count = $extra_params['failed_count'];
                       
                       if($failed_count == 0){
                           $level = AppConstants::SC_NOTIFICATION_LEVEL_SUCCESS;
                       }else if($failed_count != 0 && $total_count != 0){
                           $level = AppConstants::SC_NOTIFICATION_LEVEL_WARNING;
                       }else if($total_count == 0){
                           $level = AppConstants::SC_NOTIFICATION_LEVEL_FAILURE;
                       }
                       $system_code_type = $em->getRepository('ESERVMAINSystemConfigBundle:SystemCodeType')->findOneBy(
                               array('code' => AppConstants::SCT_NOTIFICATION_LEVEL));
                       $system_code = $em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->findOneBy(
                               array('systemCodeType' => $system_code_type, 'code' => $level));
                       $user_notification->setLevel($system_code);
                    }
                }
                
                $em->persist($user_notification); 
                return true;
            }
            catch(\Exception $e){
                echo '$e' . $e->getMessage();die;
                return false;
            }          
        }else{
            return false;
        }
    }
    
    //Returns the user notification records for current logged in user    
    public function getAllNotifications($excludeArray = null) 
    {   
        $notification_array = array();
        
        try{
            $em = $this->em;  
            $qb = $em->createQueryBuilder();            
            
            $result = $qb->select('u')
						->from('ESERVMAINProfileBundle:EservVUserNotification', 'u')
						->where('u.fosUserId = :fos_user')
						->setParameter('fos_user', $this->c->get('security.context')->getToken()->getUser())
					;
					if($excludeArray != null){
						$qb->andWhere('u.type NOT IN (:eservicesNotifTypes)')
						   ->setParameter('eservicesNotifTypes', $excludeArray)
						;
					}
                    $qb->orderBy('u.createdAt','DESC')
						->addOrderBy('u.priorityOrder', 'DESC')
						->setMaxResults(20)
                    ;
            
            $notification_array = $this->coreF->GetOutputFormat($result->getQuery(), 'array');
            
            return $notification_array;
        }
        catch(\Exception $e){
            return $notification_array;                    
        }
    }
    
    public function getNotificationTypeByFosUserId($fosUserId)
    {
        $em = $this->em;
        
        $qb = $em->createQueryBuilder();
        $result = $qb->select('n.id, n.type, n.statusRead')
                     ->from('ESERVMAINProfileBundle:EservVUserNotification', 'n')
                     ->where('n.fosUserId = :uid')
                     ->setParameter('uid', $fosUserId)
                     ->orderBy('n.createdAt','DESC')
                     ->addOrderBy('n.priorityOrder', 'DESC')                     
                     ->getQuery()
                     ->getArrayResult()
                ;
        
        return $result;
    }
    
    
}
