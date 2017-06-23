<?php

namespace ESERV\MAIN\TemplateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ESERV\MAIN\Services\AppConstants;
use ESERV\MAIN\TemplateBundle\Services\ESERVMAINTemplateBundleTemplateServices;

class EmailController extends Controller
{
    public function newEmailAction() 
    {
        $action_url = $this->generateUrl('eserv_main_template_email_create');
        
        $email_form = $this->createForm(new \ESERV\MAIN\TemplateBundle\Form\Email\TemplateType(), null, array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'
            ),            
        ));
        
        return $this->render('ESERVMAINTemplateBundle:Email:add.html.twig', array(
                    'form' => $email_form->createView(),                              
        ));
    }
    
    
    public function createEmailAction(Request $request) 
    {   
        $status = false;
        $result = array();
        $errors_array = array();
        $message = '';
        $em = $this->getDoctrine()->getManager();

        try {            
            $em->getConnection()->beginTransaction();
            $email_form = $this->createForm(new \ESERV\MAIN\TemplateBundle\Form\Email\TemplateType(), null, array());
            $email_form->handleRequest($request);

            if ($request->isMethod('POST') && $email_form->isValid()) {
                $postData = $email_form->getData();
                $services = new ESERVMAINTemplateBundleTemplateServices($em, $this->container);
                $codes_array = $services->getTemplateCodes();
                
                if(in_array($postData->getCode(), $codes_array)){                    
                    throw new \Exception('Template code exists. Please type a different code.', 500);
                }
                
                $template_type = $em->getRepository('ESERVMAINTemplateBundle:TemplateType')->findOneBy(array(
                    'code' => AppConstants::TEMPLATE_TYPE_EMAIL_CODE
                ));
                $postData->setTemplateType($template_type);
                $em->persist($postData);
                $em->flush();

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
                $message = 'New Email Template added!';
            } else {
                $message = 'Form is invalid';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($email_form->getErrors(true));
            }
        } catch (\Exception $e) {
            $message = 'An error occurred: ' . $e->getMessage();
            $em->getConnection()->rollback();
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
    
    public function editEmailAction($id)  
    {   
        $em = $this->getDoctrine()->getManager();
        
        $template_type = $em->getRepository('ESERVMAINTemplateBundle:TemplateType')->findOneBy(array(
                    'code' => AppConstants::TEMPLATE_TYPE_EMAIL_CODE
                ));
        $template = $em->getRepository('ESERVMAINTemplateBundle:Template')->findOneBy(array(
            'id' => $id,
            'templateType' => $template_type
        )); 
        $action_url = $this->generateUrl('eserv_main_template_email_update', array('id' => $id));        
        
        if(!$template){
             throw new \Exception('No Email Template found for the id '. $id, 500);
        }
        
        $email_form = $this->createForm(new \ESERV\MAIN\TemplateBundle\Form\Email\TemplateType(), 
                $template, 
                array(
                    'action' => $action_url,
                    'attr' => array(
                        'class' => 'eserv_form form-horizontal eserv_form_editable'
                    ),                    
        ));        
        
        
        return $this->render('ESERVMAINTemplateBundle:Email:edit.html.twig', array(
                    'form' => $email_form->createView(),                      
                   
        ));
    }
    
    public function updateEmailAction($id, Request $request) 
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
                                'header' => $template->getHeader()
                               ,'footer' => $template->getFooter()
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
            $email_form = $this->createForm(new \ESERV\MAIN\TemplateBundle\Form\Email\TemplateType(), 
                $template, 
                array(                    
                    'attr' => array(
                        'class' => 'eserv_form form-horizontal eserv_form_editable'
                    )
                )
            );            

            if ($request->isMethod('POST')) {
                $email_form->bind($request);
                if ($email_form->isValid()) {
                    $postData = $email_form->getData();
                    $services = new ESERVMAINTemplateBundleTemplateServices($em, $this->container);
                    $codes_array = $services->getTemplateCodes($template_code);
                    
                    if(in_array($postData->getCode(), $codes_array)){                                            
                        throw new \Exception('Template code exists. Please type a different code.', 500);
                    }
                    
//                    $em->flush();                    
//                    $em->getConnection()->commit();
//                    $status = true;
//                    $message = 'Email Template successfully updated!';
                    $upd_templ_arr = $em->getRepository('ESERVMAINTemplateBundle:Template')
                                        ->updateTemplate(
                                              $em
                                             ,$this->container
                                             ,$template
                                             ,$template_arr                                             
                                             ,$postData->getHeader()
                                             ,$postData->getFooter()
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
                    $errors_array = $this->container->get('core_function_services')->getEservFormErrors($email_form->getErrors(true));
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
