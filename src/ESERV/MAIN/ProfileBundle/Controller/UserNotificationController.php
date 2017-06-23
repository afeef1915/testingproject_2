<?php

namespace ESERV\MAIN\ProfileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserNotificationController extends Controller
{
    //Get the notifications for notice bar at the top
    public function getUserNotificationAction(Request $request)
    {
        $read = $request->get('read', 'Y');
        $notif_service = new \ESERV\MAIN\ProfileBundle\Services\ProfileBundleUserNotificationsService($this->getDoctrine()->getManager(), $this->container);
        
        $notifications = $notif_service->getAllNotifications();
        $read_notifications = array();
        $unread_notifications = array();
        
        foreach($notifications as $key => $notif){
            if($notif['statusRead'] == 'Y'){
                array_push($read_notifications, $notif);
            }else{
                array_push($unread_notifications, $notif);
            }
        }
    
        $results_array = array(
            'all_notifications' => $notifications,
            'notifications' => $read === 'Y' ? $read_notifications : $unread_notifications,
            'new_notif_count' => count($unread_notifications)
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($results_array);
        } else {            
            return $results_array;
        }
    }
    
    //Show notifications in user notification page
    public function getNotificationAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $qb = $em->createQueryBuilder();
        $result = $qb->select('n.id, n.type, n.levelCode, n.levelDescription,'
                            . 'n.priority, n.priorityCode, n.title, n.description,'
                            . 'n.isActive, n.statusRead, n.createdAt, n.createdAtDate, n.createdAtTime')
                     ->from('ESERVMAINProfileBundle:EservVUserNotification', 'n')
                     ->where('n.fosUserId = :uid')
                     ->setParameter('uid', $this->get('security.context')->getToken()->getUser()->getId())
                     ->orderBy('n.createdAt','DESC')
                     ->addOrderBy('n.priorityOrder', 'DESC')                     
                     ->getQuery()
                ;
        
        $FormattedQuery = $this->container->get('core_function_services')->GetOutputFormat($result, 'array');

        return $this->render('ESERVMAINProfileBundle:UserNotification:view.html.twig', array(
                    'notifications' => $FormattedQuery,                    
        ));        

    }
    
    //Change the status read to Y or N
    public function changeStatusReadAction(Request $request)
    {   
        $status = false;
        $msg = '';
        $id = $request->get('id');
        $status_read = $request->get('status_read', 'Y');        

        try{
            if($id){ 
                $em = $this->getDoctrine()->getManager();

                if(is_array($id)){
                    foreach($id as $i){
                        $this->updateStatusRead($em, $i, $status_read);
                    }                    
                }else{
                    $this->updateStatusRead($em, $id, $status_read);
                }
                                
                $em->flush();                  

                $status = true;
                $msg = 'Read status successfully changed to '. $status_read;
            }else{
                throw new \Exception('ID cannot be blank', 500);
            }
        }catch(\Exception $e){
            $status = false;
            $msg = 'Exception :- '.$e->getMessage();
        }
        
        $results_array = array(
            'status' => $status,
            'msg' => $msg
        );
        
        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($results_array);
        } else {            
            return $results_array;
        }
    }
    
    public function removeNotificationAction(Request $request)
    {
        $status = false;
        $msg = '';
        $errors_array = array();
        $id = $request->get('id');

        try{
            if($id){ 
                $em = $this->getDoctrine()->getManager();

                if(is_array($id)){
                    foreach($id as $i){
                        $this->deleteNotification($em, $i);                        
                    }                    
                }else{
                    $this->deleteNotification($em, $id);
                }
                                
                $em->flush();                  

                $status = true;
                $msg = 'Notification successfully removed.';
            }else{
                throw new \Exception('ID cannot be blank', 500);
            }
        }catch(\Exception $e){
            $status = false;
            $msg = 'Exception :- '.$e->getMessage();
        }
        
        $results_array = array(
            'status' => $status,
            'msg' => $msg,
            'errors' => $errors_array,
        );
        
        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($results_array);
        } else {            
            return $results_array;
        }
    }
    
    private function updateStatusRead($em, $id, $status_read)
    {
        $un = $em->getRepository('ESERV\MAIN\ProfileBundle\Entity\UserNotification')->find($id);
        
        if (!$un) {
            throw new \Exception('Invalid notification id', 500);
        }

        $uns = $em->getRepository('ESERVMAINProfileBundle:UserNotificationStatus')->findOneBy(array(
            'userNotification' => $un
        ));

        if ($uns) {
            $uns->setStatusRead($status_read);
            $em->persist($uns);
        } else {
            $un_status = new \ESERV\MAIN\ProfileBundle\Entity\UserNotificationStatus();
            $un_status->setUserNotification($un);
            $un_status->setStatusRead($status_read);
            $em->persist($un_status);
        }
    }
    
    private function deleteNotification($em, $id)
    {
        $un = $em->getRepository('ESERV\MAIN\ProfileBundle\Entity\UserNotification')->find($id);
        
        if (!$un) {
            throw new \Exception('Notification does not exist!', 500);
        }

        $uns = $em->getRepository('ESERVMAINProfileBundle:UserNotificationStatus')->findOneBy(array(
            'userNotification' => $un
        ));
        
        if ($uns) {
            $em->remove($uns);           
        } 
        $em->remove($un);
    }
    
}
