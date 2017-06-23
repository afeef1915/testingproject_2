<?php

/*
  This file has been generated using MTL ESERV:BUILD command. Contact Anjana on anjana@millertech.co.uk for more
  information. Thanks.
 */

namespace ESERV\MAIN\TemplateBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TemplateRepository
 *
 */
class TemplateRepository extends EntityRepository {
    
    const REPOSITORY_NAME = 'TemplateRepository';
    
    /**
     * Name: updateTemplate
     * Purpose: If changes have been made
     *          1. increment template.version and save the template
     *          2. create a new template_version record for the new template.version
     * Parameters:
     *   $em: entity manager  
     *   $container: container
     *   $template: doctrine object of template entity
     *   $template_arr: array of the template data (before the update of any data)
     *   $new_header: doctrine object of template entity
     *   $new_footer: doctrine object of template entity
     *   $new_content: new template.content
     *   $new_code: new template.code
     *   $new_name: new template.name
     *   $new_template_type: doctrine object of template_type entity
     *   $new_mail_merge_type: doctrine object of mail_merge_type entity
     *   $new_template_document_group: doctrine object of template_document_group entity
     *   $new_language: doctrine object of language entity
     */
    public function updateTemplate(
        $em
       ,$container
       ,$template #template doctrine object
       ,$template_arr
       ,$new_header #template doctrine object
       ,$new_footer #template doctrine object
       ,$new_content
       ,$new_code
       ,$new_name
       ,$new_template_type #template_type doctrine object
       ,$new_mail_merge_type #mail_merge_type doctrine object
       ,$new_template_document_group #template_document_group doctrine object
       ,$new_language #language doctrine object
//       ,$system_printer #system_printer template
//       ,$is_default
//       ,$report_id
//       ,$version not needed as we take it from $template and increment by 1            
    ) {
//        $log = $container->get('logger');
//        $log->info(sprintf('updateTemplate (TemplateRepository) start'));
        $status = false;
        $message = '';
        
        try {            
            $em->getConnection()->beginTransaction();
            
            #Current data for template
            if ($template_arr['header']) {
                $header_id = $template_arr['header']->getId();
            } else {
                $header_id = -1;
            }
            if ($template_arr['footer']) {
                $footer_id = $template_arr['footer']->getId();
            } else {
                $footer_id = -1;
            }            
            if ($template_arr['mail_merge_type']) {
                $mail_merge_type_id = $template_arr['mail_merge_type']->getId();
            } else {
                $mail_merge_type_id = -1;
            }
            if ($template_arr['template_document_group']) {
                $doc_group_id = $template_arr['template_document_group']->getId();
            } else {
                $doc_group_id = -1;
            }
            if ($template_arr['language']) {
                $language_id = $template_arr['language']->getId();
            } else {
                $language_id = -1;
            }
            #Current data for template end
            #Update data for template
            if ($new_header) {
                $header_id_new = $new_header->getId();
            } else {
                $header_id_new = -1;
            }
            if ($new_footer) {
                $footer_id_new = $new_footer->getId();
            } else {
                $footer_id_new = -1;
            }
            #var_dump(sprintf('header %s vs %s, footer %s vs %s', $header_id, $header_id_new, $footer_id, $footer_id_new)); die;
            if ($new_mail_merge_type) {
                $mail_merge_type_id_new = $new_mail_merge_type->getId();
            } else {
                $mail_merge_type_id_new = -1;
            }
            if ($new_template_document_group) {
                $doc_group_id_new = $new_template_document_group->getId();
            } else {
                $doc_group_id_new = -1;
            }
            if ($new_language) {
                $language_id_new = $new_language->getId();
            } else {
                $language_id_new = -1;
            }
//            $log->info(sprintf('updateTemplate (TemplateRepository) AAA'));
//var_dump(
//    sprintf('$header_id: %s vs %s, $footer_id: %s vs %s, $template_name: %s vs %s, $mail_merge_type_id: %s vs %s, $doc_group_id: %s vs %s, $language_id: %s vs %s'
//           ,$header_id, $header_id_new
//           ,$footer_id, $footer_id_new
//           ,$template['name'], $new_name
//           ,$mail_merge_type_id, $mail_merge_type_id_new
//           ,$doc_group_id, $doc_group_id_new
//           ,$language_id
//           ,$language_id_new)
//); die;
            #Update data for template end
            if (
                ($header_id <> $header_id_new) ||
                ($footer_id <> $footer_id_new) ||
                ($template_arr['name'] <> $new_name) ||
                ($template_arr['template_type']->getId() <> $new_template_type->getId()) ||
                ($mail_merge_type_id <> $mail_merge_type_id_new) ||
                ($doc_group_id <> $doc_group_id_new) ||
                ($language_id <> $language_id_new) ||
                ($template_arr['content'] <> $new_content)
               ) {
//$log->info(sprintf('updateTemplate (TemplateRepository) BBB'));
                //template has been changed
                //1. increase template.version by 1
                //2. save the template record
                //3. insert new template_version record for the updated template_record

                //1. increase template.version by 1
                $version = $template_arr['version'] + 1;
                
                //2. save the template record
                //Only need to set the version as all the other data has already been set in $template
                $template->setVersion($version);
                
                //3. insert new template_version record for the updated template_record
                $template_version = new \ESERV\MAIN\TemplateBundle\Entity\TemplateVersion();
                $template_version->setTemplate($template);
                if ($new_header) {
                    $template_head = $em->getRepository('ESERVMAINTemplateBundle:TemplateVersion')->findOneBy(array('code' => $new_header->getCode(), 'version' => $new_header->getVersion())); 
                    $template_version->setHeader($template_head);
                }
                if ($new_footer) {
                    $template_foot = $em->getRepository('ESERVMAINTemplateBundle:TemplateVersion')->findOneBy(array('code' => $new_footer->getCode(), 'version' => $new_footer->getVersion())); 
                    $template_version->setFooter($template_foot);
                }                        
                $template_version->setContent($new_content);
                $template_version->setVersion($version);
                $template_version->setCode($new_code);
                $template_version->setName($new_name);
                $template_version->setTemplateType($new_template_type);
                $template_version->setMailMergeType($new_mail_merge_type);
                $template_version->setTemplateDocumentGroup($new_template_document_group);
                $template_version->setLanguage($new_language);
                #$template_version->setSystemPrinter($system_printer);
                $template_version->setIsCustomised('N');
                #$template_version->setIsDefault($is_default);
                #$template_version->setReportId($report_id);
                $em->persist($template_version);
                
                $em->flush();
                $em->getConnection()->commit();
                        
                $message = 'Template successfully updated!';
            } else {
                $message = 'No changes made to Template!';
            } 
    
            $status = true;
        } catch (\Exception $e) {
            $em->getConnection()->rollback();
            $status = false;
            $message = 'Error updating template';
            $log_message = sprintf(
                               '%s. Exception: %s'
                              ,$message, $e->getMessage()
                           );
//            $log->info($log_message);
            $container->get('db_core_function_services')
                      ->insertMtlError(
                            sprintf('updateTemplate (%s)', self::REPOSITORY_NAME)
                           ,$log_message);
        }
        
        return array('status' => $status, 'message' => $message);
    } #updateTemplate end

}
