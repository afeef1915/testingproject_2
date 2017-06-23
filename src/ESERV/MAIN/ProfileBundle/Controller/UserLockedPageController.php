<?php

namespace ESERV\MAIN\ProfileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserLockedPageController extends Controller
{

    public function refreshAction(Request $request)
    {    
        $em = $this->getDoctrine()->getManager();
        $status = false;
        $redirect_to_home = false; //accessed through js
        $em->getConnection()->beginTransaction();
        try{
            
            $pageCode = $request->get('page_code');
            $pageId = $request->get('page_id');

            $page_code = $this->container->get('core_function_services')->eservEncode($pageCode);
            $page_id = $this->container->get('core_function_services')->eservEncode($pageId);
            $session_id = $this->container->get('session')->getId();
            
            $token = $this->container->get('security.context')->getToken();
            if(is_object($token->getUser()) && !empty($token->getUser()->getId())){
                $token = $token->getUser()->getId();
            }else{
                throw new \Exception('', 500);
            }

            $ulp = $em->getRepository('ESERVMAINProfileBundle:UserLockedPage')->findOneBy(array(
                'pageCode' => $page_code,
                'pageId' => $page_id,
                'phpSesId' => $session_id,
                'createdBy' => $token
            ));
            
            if (!$ulp) {
//                $status = false;
//                $message = $this->container->get('eserv_translation_services')->eservCustomTranslator('Session expired. You will be redirected to the home.. ');  
                throw new \Exception('', 500);
            }else{
                    
                    $ulp->setUpdatedAt(new \DateTime('now'));
                    $ulp->setUpdatedBy($this->container->get('security.context')->getToken()->getUser()->getId());
                    $em->persist($ulp);
                    $em->flush();
                    $em->commit();
                    $message = $this->container->get('eserv_translation_services')->eservCustomTranslator('Refreshed!');
                    $status = true;                    
            }
        }catch(\Exception $e){
           $em->getConnection()->rollback();
           $message = $this->container->get('eserv_translation_services')->eservCustomTranslator('DOC_EDIT_UNEXP_ERROR');        
           $redirect_to_home = false; 
        }        
        
        
        $result = array(
            'success' => $status,
            'msg' => $message,
            'redirect_to_home' => $redirect_to_home
        );
        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }

    public function unlockPageAction(Request $request)
    {
        $pageCode = $request->get('page_code');
        $pageId = $request->get('page_id');
        $em = $this->getDoctrine()->getManager();
        $status = false;
        $message = '';    

        try {
            
            $page_lock_service = new \ESERV\MAIN\ProfileBundle\Services\UserLockedPageService($em, $this->container);
            $page_code = $this->container->get('core_function_services')->eservEncode($pageCode);
            $page_id = $this->container->get('core_function_services')->eservEncode($pageId);
            $ulp = $page_lock_service->deleteUserLockedPage($page_code, $page_id, true);
            
            if ($ulp) {                    
                $status = true;
                $message = $this->container->get('eserv_translation_services')->eservCustomTranslator('Page Unlocked!');
            } else {                             
                $status = false;
            }
        } catch (\Exception $e) {                        
            $message = $this->container->get('eserv_translation_services')->eservCustomTranslator('Error occurred:') . " " . $e->getMessage();
        }

        $result = array(
            'success' => $status,
            'msg' => $message
        );
        
        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }
    
    

}
