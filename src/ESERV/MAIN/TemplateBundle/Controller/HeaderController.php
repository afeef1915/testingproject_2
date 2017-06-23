<?php

namespace ESERV\MAIN\TemplateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ESERV\MAIN\Services\AppConstants;
use ESERV\MAIN\TemplateBundle\Services\ESERVMAINTemplateBundleTemplateServices;

class HeaderController extends Controller
{
    public function newHeaderAction() 
    {
        $action_url = $this->generateUrl('eserv_main_template_header_create');
        
        $header_form = $this->createForm(new \ESERV\MAIN\TemplateBundle\Form\Header\TemplateType(), null, array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'
            ),            
        ));
        
        return $this->render('ESERVMAINTemplateBundle:Header:add.html.twig', array(
                    'form' => $header_form->createView(),                              
        ));
    }
    
    
    public function createHeaderAction(Request $request) 
    {   
        $status = false;
        $result = array();
        $errors_array = array();
        $message = '';
        $em = $this->getDoctrine()->getManager();

        try {      
//            $log = $this->get('logger');
            
            $em->getConnection()->beginTransaction();
            $header_form = $this->createForm(new \ESERV\MAIN\TemplateBundle\Form\Header\TemplateType(), null, array());
            $header_form->handleRequest($request);

            if ($request->isMethod('POST') && $header_form->isValid()) {
                $postData = $header_form->getData();
                
                $services = new ESERVMAINTemplateBundleTemplateServices($em, $this->container);
                $codes_array = $services->getTemplateCodes();
                
                if(in_array($postData->getCode(), $codes_array)){                    
                    throw new \Exception('Template code exists. Please type a different code.', 500);
                }
                
                $template_type = $em->getRepository('ESERVMAINTemplateBundle:TemplateType')->findOneBy(array(
                    'code' => AppConstants::TEMPLATE_TYPE_HEADER_CODE
                ));
                $postData->setTemplateType($template_type);
                $em->persist($postData);
                $em->flush();
//                $log->info(sprintf('$template.id: %s', $postData->getId()));
                
                $temp_ver = $em->getRepository('ESERVMAINTemplateBundle:TemplateVersion')
                               ->createTemplateVersion(
                                     $em
                                    ,$postData->getContent()
                                    ,$postData->getVersion()
                                    ,$postData->getName()                                      
                                    ,$postData->getTemplateType()
                                    ,'N'
                                    ,$postData
                                    ,NULL
                                    ,NULL
                                    ,$postData->getCode()
                                    ,NULL
                                    ,NULL
                                    ,$postData->getLanguage()
                                    ,NULL
                                    ,$postData->getIsDefault()
                                    ,$postData->getReportId()
                                    ,NULL
                                 );
                
                $em->getConnection()->commit();

                $status = true;
                $message = 'New Header Template created successfully.';
            } else {
                $message = 'Form is invalid';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($header_form->getErrors(true));
            }
        } catch (\Exception $e) {
            $message = 'An error occurred: ' . $e->getMessage();
            $em->getConnection()->rollback();
            if ($message <> 'An error occurred: Template code exists. Please type a different code.') {
                $this->container->get('db_core_function_services')
                                ->insertMtlError(
                                      sprintf('createHeaderAction (HeaderController)')
                                     ,$message);
            }
            $em->close();
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array,
        );
        $em->close();

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }
    
    public function editHeaderAction($id)  
    {   
        $em = $this->getDoctrine()->getManager();
        
        $template_type = $em->getRepository('ESERVMAINTemplateBundle:TemplateType')->findOneBy(array(
                    'code' => AppConstants::TEMPLATE_TYPE_HEADER_CODE
                ));
        $template = $em->getRepository('ESERVMAINTemplateBundle:Template')->findOneBy(array(
            'id' => $id,
            'templateType' => $template_type
        )); 
        $action_url = $this->generateUrl('eserv_main_template_header_update', array('id' => $id));        
        
        if(!$template){
             throw new \Exception('No Header Template found for the id '. $id, 500);
        }
        
        $header_form = $this->createForm(new \ESERV\MAIN\TemplateBundle\Form\Header\TemplateType(), 
                $template, 
                array(
                    'action' => $action_url,
                    'attr' => array(
                        'class' => 'eserv_form form-horizontal eserv_form_editable'
                    ),                    
        ));        
        
        
        return $this->render('ESERVMAINTemplateBundle:Header:edit.html.twig', array(
                    'form' => $header_form->createView(),                      
                   
        ));
    }
    
    public function updateHeaderAction($id, Request $request) 
    { 
        $status = false;
        $result = array();
        $errors_array = array();
        $message = '';
        $em = $this->getDoctrine()->getManager();

        try {
//            $em->getConnection()->beginTransaction();
            $template = $em->getRepository('ESERVMAINTemplateBundle:Template')->find($id); 
            $template_arr = array(
                                'header' => FALSE
                               ,'footer' => FALSE
                               ,'content' => $template->getContent()
                               ,'code' => $template->getCode()
                               ,'name' => $template->getName()
                               ,'template_type' => $template->getTemplateType()
                               ,'mail_merge_type' => $template->getMailMergeType()
                               ,'template_document_group' => $template->getTemplateDocumentGroup()
                               ,'language' => $template->getLanguage()
                               ,'system_printer' => $template->getSystemPrinter()
                               ,'is_default' => $template->getIsDefault()
                               ,'report_id' => $template->getReportId()
                               ,'version' => $template->getVersion()
                            );            
            $template_code = $template->getCode();
            $header_form = $this->createForm(new \ESERV\MAIN\TemplateBundle\Form\Header\TemplateType(), 
                $template, 
                array(                    
                    'attr' => array(
                        'class' => 'eserv_form form-horizontal eserv_form_editable'
                    )
                )
            );            

            if ($request->isMethod('POST')) {
                $header_form->bind($request);
                if ($header_form->isValid()) {
                    $postData = $header_form->getData();
                    $services = new ESERVMAINTemplateBundleTemplateServices($em, $this->container);
                    $codes_array = $services->getTemplateCodes($template_code);
                    
                    if(in_array($postData->getCode(), $codes_array)){                                            
                        throw new \Exception('Template code exists. Please type a different code.', 500);
                    }
                    
//                    $em->flush();                    
//                    $em->getConnection()->commit();
//                    $status = true;
//                    $message = 'Header Template successfully updated!';
                    $upd_templ_arr = $em->getRepository('ESERVMAINTemplateBundle:Template')
                                        ->updateTemplate(
                                              $em
                                             ,$this->container
                                             ,$template
                                             ,$template_arr                                             
                                             ,FALSE
                                             ,FALSE
                                             ,$postData->getContent()
                                             ,$postData->getCode()
                                             ,$postData->getName()
                                             ,$postData->getTemplateType()
                                             ,$postData->getMailMergeType()
                                             ,$postData->getTemplateDocumentGroup()
                                             ,$postData->getLanguage()
                                             #,FALSE #system_printer entity
                                             #,NULL #is_default
                                             #,NULL #report_id
                                          );
                    $status = $upd_templ_arr['status'];
                    $message = $upd_templ_arr['message'];
                } else {
                    $message = 'Form is invalid';
                    $errors_array = $this->container->get('core_function_services')->getEservFormErrors($header_form->getErrors(true));
                }
            }
        } catch (\Exception $e) {
            $message = 'An error occurred: ' . $e->getMessage();
//            $em->getConnection()->rollback();
            $em->close();
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array,
        );
        $em->close();

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }
}
