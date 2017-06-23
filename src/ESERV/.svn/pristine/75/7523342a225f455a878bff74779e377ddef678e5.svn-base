<?php

namespace ESERV\MAIN\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SystemConfigController extends Controller 
{
    
    public function editSystemConfigAction()
    {
        $action_url = $this->generateUrl('eserv_main_administration_system_config_update');
        $dataArray = $this->getDoctrine()->getManager()->getRepository('ESERVMAINSystemConfigBundle:SystemConfig')->getFormattedSystemConfigValues();
        $form_options_array = array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'), 
        );
        
        
        $form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Form\SystemConfig\SystemConfigType($dataArray), null, $form_options_array);        
        
        
        return $this->render('ESERVMAINAdministrationBundle:SystemConfig:edit.html.twig', array(
                    'form' => $form->createView(),                    
        ));
        
    }
    
    public function updateSystemConfigAction(Request $request) 
    {   
        $status = false;
        $result = array();
        $errors_array = array();

        $message = '';
        $form_options_array = array();
        
        $form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Form\SystemConfig\SystemConfigType(), null, $form_options_array);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em1 = $this->getDoctrine()->getManager();
            $em1->getConnection()->beginTransaction();
            $form_data = $request->request->get($form->getName());
            try {
                foreach($form_data as $k => $v){
                    $this->getDoctrine()
                            ->getManager()
                            ->getRepository('ESERVMAINSystemConfigBundle:SystemConfig')
                            ->updateSystemConfigValueByCode($k, $v);                    
                }              
                $em1->flush();
                $writeToFile = $this->writeToSystemConfigFile();
                if(true === $writeToFile){
                    $status = true;
                    $message = 'System configurations has been successfully updated.';
                }else{
                    $status = false;
                    $message = 'Database has been updated but failed to update the System Config file!';
                }
                $em1->getConnection()->commit();
                
            } catch (\Exception $e) {
                $em1->getConnection()->rollback();
                $message = 'Error occurred : ' . $e->getMessage();
            }
        } else {
            $message = 'Please correct the errors below';
            $errors_array = $this->container->get('core_function_services')->getEservFormErrors($form->getErrors(true));
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }
    
    private function writeToSystemConfigFile()
    {
        $status = false;
        $file = $this->get('kernel')->getRootDir().DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR .'system_config.yml' ;
        $content  = "# This file will be automatically created/updated/overwritten by the";
        $content .= "\r# application upon changes to made by an ESERV Administrator";
        $content .= "\r#-------------------------------------------------------------------";
        $content .= "\rparameters:";
        
        if(file_exists($file)){
            $data = $this->getDoctrine()->getManager()->getRepository('ESERVMAINSystemConfigBundle:SystemConfig')->getFormattedSystemConfigValues();
            foreach($data as $k => $v){
               $content .= "\r    $k:" ;
               $content .= "\r        name: {$v['name']}" ;
               $content .= "\r        value: {$v['configValue']}" ;
            }
            $writeToFile = file_put_contents($file, $content);
            if(false !== $writeToFile){
                $status = true;
            }else{
                $status = false;
            }            
        }else{
            $status = false;
        }
        
        return $status;
    }
}
