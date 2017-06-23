<?php

namespace ESERV\MAIN\TemplateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ESERV\MAIN\Services\AppConstants;
use ESERV\MAIN\TemplateBundle\Services\ESERVMAINTemplateBundleTemplateServices;

class LetterController extends Controller
{
    public function newLetterAction() 
    {
        $action_url = $this->generateUrl('eserv_main_template_letter_create');
        
        $letter_form = $this->createForm(new \ESERV\MAIN\TemplateBundle\Form\Letter\TemplateType(), null, array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'
            ),            
        ));
        
        return $this->render('ESERVMAINTemplateBundle:Letter:add.html.twig', array(
                    'form' => $letter_form->createView(),                              
        ));
    }
    
    
    public function createLetterAction(Request $request) 
    {   
        $status = false;
        $result = array();
        $errors_array = array();
        $message = '';
        $em = $this->getDoctrine()->getManager();

        try {            
            $em->getConnection()->beginTransaction();
            $letter_form = $this->createForm(new \ESERV\MAIN\TemplateBundle\Form\Letter\TemplateType(), null, array());
            $letter_form->handleRequest($request);

            if ($request->isMethod('POST') && $letter_form->isValid()) {
                $postData = $letter_form->getData();
                
                $services = new ESERVMAINTemplateBundleTemplateServices($em, $this->container);
                $codes_array = $services->getTemplateCodes();
                
                if(in_array($postData->getCode(), $codes_array)){                    
                    throw new \Exception('Template code exists. Please type a different code.', 500);
                }
                
                $template_type = $em->getRepository('ESERVMAINTemplateBundle:TemplateType')->findOneBy(array(
                    'code' => AppConstants::TEMPLATE_TYPE_LETTER_CODE
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
                $message = 'New Letter Template added!';
            } else {
                $message = 'Form is invalid';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($letter_form->getErrors(true));
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
    
    public function editLetterAction($id)  
    {   
        $em = $this->getDoctrine()->getManager();
        
        $template_type = $em->getRepository('ESERVMAINTemplateBundle:TemplateType')->findOneBy(array(
                    'code' => AppConstants::TEMPLATE_TYPE_LETTER_CODE
                ));
        $template = $em->getRepository('ESERVMAINTemplateBundle:Template')->findOneBy(array(
            'id' => $id,
            'templateType' => $template_type
        )); 
        if(!$template){
             throw new \Exception('No Letter Template found for the id '. $id, 500);
        }        
        $action_url = $this->generateUrl('eserv_main_template_letter_update', array('id' => $id));

//        $template->setVersion($template->getVersion() + 1);
        $letter_form = $this->createForm(new \ESERV\MAIN\TemplateBundle\Form\Letter\TemplateType(), 
                $template, 
                array(
                    'action' => $action_url,
                    'attr' => array(
                        'class' => 'eserv_form form-horizontal eserv_form_editable'
                    ),                    
        ));
        
        return $this->render('ESERVMAINTemplateBundle:Letter:edit.html.twig', array(
                    'form' => $letter_form->createView(),                      
                   
        ));
    }
    
    public function updateLetterAction($id, Request $request) 
    { 
//        $this->log = $this->container->get('logger');
        $status = false;
        $result = array();
        $errors_array = array();
        $message = '';
        $em = $this->getDoctrine()->getManager();

        try {
//            $em->getConnection()->beginTransaction();
            $template = $em->getRepository('ESERVMAINTemplateBundle:Template')->find($id); 
            #var_dump($template->getMailMergeType()->getId());
            #var_dump($template->getHeader()->getId());
            #var_dump($template->getFooter()->getId());
            #die;
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
//            $version = $template->getVersion();
//            if ($template->getHeader()) {
//                $header_id = $template->getHeader()->getId();
//            } else {
//                $header_id = -1;
//            }
//            if ($template->getFooter()) {
//                $footer_id = $template->getFooter()->getId();
//            } else {
//                $footer_id = -1;
//            }            
            $content = $template->getContent();
//            $template_name = $template->getName();
//            if ($template->getMailMergeType()) {
//                $mail_merge_type_id = $template->getMailMergeType()->getId();
//            } else {
//                $mail_merge_type_id = -1;
//            }
//            if ($template->getTemplateDocumentGroup()) {
//                $doc_group_id = $template->getTemplateDocumentGroup()->getId();
//            } else {
//                $doc_group_id = -1;
//            }
//            if ($template->getTemplateDocumentGroup()) {
//                $language_id = $template->getLanguage()->getId();
//            } else {
//                $language_id = -1;
//            }
            $letter_form = $this->createForm(new \ESERV\MAIN\TemplateBundle\Form\Letter\TemplateType(), 
                $template, 
                array(                    
                    'attr' => array(
                        'class' => 'eserv_form form-horizontal eserv_form_editable'
                    )
                )
            );            
#echo $template->getVersion(); die;
            if ($request->isMethod('POST')) {
                $letter_form->bind($request);
                if ($letter_form->isValid()) {
                    $postData = $letter_form->getData();
//                    echo $postData->getVersion(); die;
                    $services = new ESERVMAINTemplateBundleTemplateServices($em, $this->container);
                    $codes_array = $services->getTemplateCodes($template_code);
                    
                    if(in_array($postData->getCode(), $codes_array)){                                            
                        throw new \Exception('Template code exists. Please type a different code.', 500);
                    }
//                    $postData->setVersion($postData->getVersion() + 1);
//                    if ($postData->getHeader()) {
//                        $header_id_new = $postData->getHeader()->getId();
//                    } else {
//                        $header_id_new = -1;
//                    }
//                    if ($postData->getFooter()) {
//                        $footer_id_new = $postData->getFooter()->getId();
//                    } else {
//                        $footer_id_new = -1;
//                    }
//                    if ($postData->getMailMergeType()) {
//                        $mail_merge_type_id_new = $postData->getMailMergeType()->getId();
//                    } else {
//                        $mail_merge_type_id_new = -1;
//                    }
//                    if ($postData->getMailMergeType()) {
//                        $doc_group_id_new = $postData->getTemplateDocumentGroup()->getId();
//                    } else {
//                        $doc_group_id_new = -1;
//                    }
//                    if ($postData->getLanguage()) {
//                        $language_id_new = $postData->getLanguage()->getId();
//                    } else {
//                        $language_id_new = -1;
//                    }
//                    if (
//                        ($header_id <> $header_id_new) ||
//                        ($footer_id <> $footer_id_new) ||
//                        ($template_name <> $postData->getName()) ||
//                        ($mail_merge_type_id <> $mail_merge_type_id_new) ||
//                        ($doc_group_id <> $doc_group_id_new) ||
//                        ($language_id <> $language_id_new)
//                        || ($content <> $postData->getContent())
//                       ) {
//#var_dump(sprintf('$header_id: %s vs %s, $footer_id: %s vs %s, $template_name: %s vs %s, $mail_merge_type_id: %s vs %s, $doc_group_id: %s vs %s, $language_id: %s vs %s', $header_id, $header_id_new, $footer_id, $footer_id_new, $template_name, $postData->getName(), $mail_merge_type_id, $mail_merge_type_id_new, $doc_group_id, $doc_group_id_new, $language_id, $language_id_new)); die;
//                        //template has been changed
//                        //1. increase template.version by 1
//                        //2. save the template record
//                        //3. insert new template_version record for the updated template_record
//                        $version = $version + 1;
//                        $postData->setVersion($version);
//                        $template_version = new \ESERV\MAIN\TemplateBundle\Entity\TemplateVersion();
//                        $template_version->setTemplate($template);
//                        if ($postData->getHeader()) {
//                            $template_head = $em->getRepository('ESERVMAINTemplateBundle:TemplateVersion')->findOneBy(array('code' => $postData->getHeader()->getCode(), 'version' => $postData->getHeader()->getVersion())); 
//                            $template_version->setHeader($template_head);
//                        }
//                        if ($postData->getFooter()) {
//                            $template_foot = $em->getRepository('ESERVMAINTemplateBundle:TemplateVersion')->findOneBy(array('code' => $postData->getFooter()->getCode(), 'version' => $postData->getFooter()->getVersion())); 
//                            $template_version->setFooter($template_foot);
//                        }                        
//                        $template_version->setContent($postData->getContent());
//                        $template_version->setVersion($version);
//                        $template_version->setCode($postData->getCode());
//                        $template_version->setName($postData->getName());
//                        $template_version->setTemplateType($postData->getTemplateType());
//                        $template_version->setMailMergeType($postData->getMailMergeType());
//                        $template_version->setTemplateDocumentGroup($postData->getTemplateDocumentGroup());
//                        $template_version->setLanguage($postData->getLanguage());
//                        #$template_version->setSystemPrinter();
//                        $template_version->setIsCustomised('N');
//                        #$template_version->setIsDefault();
//                        #$template_version->setReportId();
//                        $em->persist($template_version);
//                        
//                        $em->flush();
//                        $message = 'Letter Template successfully updated!';
//                    } else {
//                        $message = 'No changes made to Letter Template!';
//                    }                    
                    // end of creating 'alt_language_equivlant'
//                    $em->flush();
//                    $em->getConnection()->commit();
//                    $status = true;
//                    $message = 'Letter Template successfully updated!';
                    $upd_templ_arr = $em->getRepository('ESERVMAINTemplateBundle:Template')
                                        ->updateTemplate(
                                              $em
                                             ,$this->container
                                             ,$template
                                             ,$template_arr
                                             #,$template->getContent()
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
                    $errors_array = $this->container
                                         ->get('core_function_services')
                                         ->getEservFormErrors($letter_form->getErrors(true));
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
