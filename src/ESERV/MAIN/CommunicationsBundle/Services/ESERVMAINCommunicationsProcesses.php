<?php

namespace ESERV\MAIN\CommunicationsBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ESERV\MAIN\Services\AppConstants;

class ESERVMAINCommunicationsProcesses {

    const SERVICE_NAME = 'ESERVMAINCommunicationsProcesses';

    private $em;
    private $c;
    private $coreFunction;
    private $dBCoreFunction;
    private $log;
    private $documentFolder;

    public function __construct(EntityManager $em, Container $c) {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
        $this->dBCoreFunction = $this->c->get('db_core_function_services');
        $this->log = $c->get('logger');
        $this->documentFolder = $c->getParameter('eserv_config')['merlin_docs']['folder'];
    }

    public function MergeLetters($id = NULL, $show = false) {
//$this->log->info(sprintf('MergeLetters (ESERVMAINCommunicationsProcesses) start'));
        $function = 'mergeLetters';
        $function_result = 'Successfully executed';
        $message = $mm_field_data = $html_content = '';
        $status = $prev_temp_ver_id = FALSE;
        $mm_field_arr = $mm_field_data_arr = $mm_arr = array();
        $header_arr = $body_arr = $footer_arr = array();
        $res_array = $act_id_arr = $html_content_arr = array();
//        $user_arr = array();
//        $get_mm_user = FALSE;

        if (
                (is_null($id)) ||
                ($id == '') ||
                ($id == NULL)
        ) {
            $letter_merge_arr = $this->em
                    ->getRepository('ESERVMAINActivityBundle:EservVMergingLetter')
                    ->getAll();
        } else {
            $col_arr = array(
                'id'
                , 'templateVersionId'
                , 'shortDescription'
                , 'systemPrinterId'
                , 'contentHeader'
                , 'contentBody'
                , 'contentFooter'
                , 'entityId'
                , 'entityName'
            );
            $letter_merge_arr = $this->em
                    ->getRepository('ESERVMAINActivityBundle:EservVMergingLetter')
                    ->getById($id, $col_arr);
        }

        try {
            $this->em->getConnection()->beginTransaction();

            foreach ($letter_merge_arr as $table_arr) {
//                $get_mm_user = FALSE;
                $temp_ver_id = $table_arr['templateVersionId'] . $table_arr['shortDescription'];
                if (
                        ($prev_temp_ver_id === FALSE) ||
                        ($temp_ver_id !== $prev_temp_ver_id)
                ) {
                    if ($prev_temp_ver_id === FALSE) {
                        $current_date_time = new \DateTime();
                        $curr_date_time = date('Y-m-d H:i:s');

                        $act_comp_status = $this->em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getActivityCompleteStatus(array('id'));
                        $act_comp_status_id = $act_comp_status['id'];
                    } else {
                        $this->mergeLetterFinish($doc_job, $current_date_time, $act_id_arr, $act_comp_status_id, $curr_date_time, $html_content_arr, $show);
                        $act_id_arr = array();
                    }

                    $doc_job = $this->em->getRepository('ESERVMAINCommunicationsBundle:DocumentJob')->createDocumentJob(NULL, NULL, $table_arr['systemPrinterId'], $this->em);

                    #get the template_version template_id, header, body and footer. Store these as variables
                    preg_match_all('/{[a-z-0-9_]*}/i', $table_arr['contentHeader'], $header_arr); #print_r($header_arr); print('<br />');
                    preg_match_all('/{[a-z-0-9_]*}/i', $table_arr['contentBody'], $body_arr);  #var_dump($body_arr); die;
                    preg_match_all('/{[a-z-0-9_]*}/i', $table_arr['contentFooter'], $footer_arr);  #print_r($footer_arr); print('<br />');
                    $mm_field_arr = array_merge($header_arr[0], $body_arr[0], $footer_arr[0]); #print_r($mm_field_arr); print('<br />');
                    $mm_field_arr = array_unique($mm_field_arr); #var_dump($mm_field_arr); die;

                    $prev_temp_ver_id = $temp_ver_id;
                    $html_content_arr = array();
                }
                $act = $this->em->getRepository('ESERVMAINActivityBundle:Activity')->find($table_arr['id']);
                $act_created_by = $act->getCreatedBy(); #var_dump($act_created_by); die;
                $act_job = $this->em->getRepository('ESERVMAINActivityBundle:ActivityJob')->createActivityJob($doc_job, $table_arr['id'], $this->em);

                $act_target_arr = $this->em->getRepository('ESERVMAINActivityBundle:ActivityTarget')->findByActivity($table_arr['id']);
                #$act_target_arr = $this->em->getRepository('ESERVMAINActivityBundle:ActivityTarget')->getByActivity(array($table_arr['id']));
                #var_dump($act_target_arr); die;
                $user_arr = self::getMailMergeFieldUserData($mm_field_arr, $act_created_by);
//$this->log->info(sprintf('MergeLetters processing activity_target records $table_arr[entityId]: %s, $table_arr[entityName]: %s', $table_arr['entityId'], $table_arr['entityName']));                
                foreach ($act_target_arr as $target_arr) {
                    $contact = $target_arr->getContact();
                    $target_id = $target_arr->getId();
                    #$target_id = $target_arr['id'];

                    if (count($mm_field_arr) > 0) {
                        $mm_arr = self::getMailMergeFieldData(
                                        $mm_field_arr
                                        , $table_arr['entityId']
                                        , $table_arr['entityName']
                                        , $contact
                                        , $user_arr
                        );
//                        var_dump($mm_arr); die;
                        if (array_key_exists('error', $mm_arr)) {
                            $msg = sprintf(
                                    'activity.id: %s, ' .
                                    'activity_target.id: %s, ' .
                                    '$mm_field_arr: (%s), ' .
                                    'Exception in getMailMergeFieldData: %s'
                                    , $act->getId()
                                    , $target_id
                                    , implode(',', $mm_field_arr)
                                    , $mm_arr['error']
                            );
                            throw new \Exception($msg);
                        }
                    } else {
                        $mm_arr['data_arr'] = array();
                        $mm_arr['data_str'] = '';
                    }
//                    var_dump($mm_arr['data_arr']); die;
                    $act_mer_data = $this->em->getRepository('ESERVMAINActivityBundle:ActivityMergeData')->createActivityMergeData($target_arr, (implode(',', $mm_field_arr)), $mm_arr['data_str'], $this->em);

                    $pdf_data = array(
                        #'merged_data' => $mm_field_data_arr,
                        'merged_data' => $mm_arr['data_arr'],
                        'template_parts' => array(
                            'headerHTML' => $table_arr['contentHeader'],
                            'contentHTML' => $table_arr['contentBody'],
                            'footerHTML' => $table_arr['contentFooter'],
                        ),
                    );

                    $html_content_arr[] = $pdf_data;
                    $mm_field_data = '';
                } #foreach ($act_target_arr as $target_arr)               

                $act_id_arr[] = $table_arr['id'];
                #Update of activity is now done in mergeLetterFinish as a bulk update instead of on each activity change
                #$act->setStatusDateTime($current_date_time);
                #$act->setStatus($act_comp_status);
                #$this->em->persist($act);
                #$this->em->flush($act);
            } #foreach ($letter_merge_arr as $table_arr)
//$this->log->info(sprintf('MergeLetters processing activity_target records finished'));

            if (count($act_id_arr) > 0) {
                $this->mergeLetterFinish($doc_job, $current_date_time, $act_id_arr, $act_comp_status_id, $curr_date_time, $html_content_arr, $show);
            }

            $message = 'Completed Successfully';
            $status = true;

            $this->em->getConnection()->commit();
        } catch (\Exception $ex) {

            $message = $ex->getMessage();
            $this->em->getConnection()->rollback();

            $this->c
                    ->get('db_core_function_services')
                    ->insertMtlError($function, $message);

            if (!(is_array($function_result))) {
                $function_result = array();
            }
            $function_result['error'] = 'Error processing letter - ' . $message;
        }

        $res_array = array(
            'success' => $status,
            'msg' => $message
        );
//$this->log->info(sprintf('MergeLetters (ESERVMAINCommunicationsProcesses) finished success: %s, msg: %s', $res_array['success'], $res_array['msg']));

        return $res_array;
    } #mergeLetters end    

    /* Name: MergeLetter
     * Parameters:
     *   type: (I)ndividual
     *         (G)roup
     *   id: an activity.id if type equal I
     *   id: an document_job.id if type equal G
     */    
    public function MergeLetter(
        $document_job_id
//       ,$type = 'G'
    ) {
//$this->log->info(sprintf('MergeLetter start'));
        $function = 'mergeLetter';
        $function_result = 'Successfully executed';
        $message = $mm_field_data = $html_content = '';
        $status = $prev_temp_ver_id = FALSE;
        $mm_field_arr = $mm_field_data_arr = $mm_arr = array();
        $header_arr = $body_arr = $footer_arr = array();
        $res_array = $act_id_arr = $html_content_arr = array();
        $col_arr = array(
                       'id'
                      ,'templateVersionId'
                      ,'shortDescription'
                      ,'systemPrinterId'
                      ,'contentHeader'
                      ,'contentBody'
                      ,'contentFooter'
                      ,'entityId'
                      ,'entityName'
                      ,'activityCreatedBy'
                   );
        $letter_merge_arr = $this->em
                                 ->getRepository('ESERVMAINActivityBundle:EservVMergingGroupLetter')
                                 ->getByDocumentJobId($document_job_id, $col_arr);
        try {
            $this->em->getConnection()->beginTransaction();

            foreach ($letter_merge_arr as $table_arr) {
                $temp_ver_id = $table_arr['templateVersionId'] . $table_arr['shortDescription'];
                if (
                        ($prev_temp_ver_id === FALSE) ||
                        ($temp_ver_id !== $prev_temp_ver_id)
                ) {
                    if ($prev_temp_ver_id === FALSE) {
                        $current_date_time = new \DateTime();
                        $curr_date_time = date('Y-m-d H:i:s');

                        $act_comp_status = $this->em
                                                ->getRepository('ESERVMAINSystemConfigBundle:SystemCode')
                                                ->getActivityCompleteStatus(array('id'));
                        $act_comp_status_id = $act_comp_status['id'];
//$this->log->info(sprintf('MergeLetter $act_comp_status_id: %s', $act_comp_status_id));
                    } 

                    #Get the template_version template_id, header, body and footer. Store these as variables
                    preg_match_all('/{[a-z-0-9_]*}/i', $table_arr['contentHeader'], $header_arr); #print_r($header_arr); print('<br />');
                    preg_match_all('/{[a-z-0-9_]*}/i', $table_arr['contentBody'], $body_arr);  #var_dump($body_arr); die;
                    preg_match_all('/{[a-z-0-9_]*}/i', $table_arr['contentFooter'], $footer_arr);  #print_r($footer_arr); print('<br />');
                    $mm_field_arr = array_merge($header_arr[0], $body_arr[0], $footer_arr[0]); #print_r($mm_field_arr); print('<br />');
                    $mm_field_arr = array_unique($mm_field_arr); #var_dump($mm_field_arr); die;

                    $prev_temp_ver_id = $temp_ver_id;
                } #if (($prev_temp_ver_id === FALSE) || ($temp_ver_id !== $prev_temp_ver_id))
                $act_created_by = $table_arr['activityCreatedBy'];
                $act_target_arr = $this->em
                                       ->getRepository('ESERVMAINActivityBundle:ActivityTarget')
                                       ->findByActivity($table_arr['id']);
                $user_arr = self::getMailMergeFieldUserData(
                                $mm_field_arr
                               ,$act_created_by
                            );
//$this->log->info(sprintf('MergeLetters processing activity_target records $table_arr[entityId]: %s, $table_arr[entityName]: %s', $table_arr['entityId'], $table_arr['entityName']));
                foreach ($act_target_arr as $target_arr) {
                    $contact = $target_arr->getContact();
                    $target_id = $target_arr->getId();
                    if (count($mm_field_arr) > 0) {
                        $mm_arr = self::getMailMergeFieldData(
                                      $mm_field_arr
                                     ,$table_arr['entityId']
                                     ,$table_arr['entityName']
                                     ,$contact
                                     ,$user_arr
                                  );
//var_dump($mm_arr); die;
                        if (array_key_exists('error', $mm_arr)) {
                            $msg = sprintf(
                                       'activity.id: %s, ' .
                                       'activity_target.id: %s, ' .
                                       '$mm_field_arr: (%s), ' .
                                       'Exception in getMailMergeFieldData: %s'
                                      ,$act->getId()
                                      ,$target_id
                                      ,implode(',', $mm_field_arr)
                                      ,$mm_arr['error']
                                   );
                            throw new \Exception($msg);
                        }
                    } else {
                        $mm_arr['data_arr'] = array();
                        $mm_arr['data_str'] = '';
                    }
//var_dump($mm_arr['data_arr']); die;
                    $act_mer_data = $this->em
                                         ->getRepository('ESERVMAINActivityBundle:ActivityMergeData')
                                         ->createActivityMergeData(
                                               $target_arr
                                              ,(implode(',', $mm_field_arr))
                                              , $mm_arr['data_str']
                                              ,$this->em
                                           );
                    $pdf_data = array(
                                    'merged_data' => $mm_arr['data_arr']
                                   ,'template_parts' => array(
                                                            'headerHTML' => $table_arr['contentHeader']
                                                           ,'contentHTML' => $table_arr['contentBody']
                                                           ,'footerHTML' => $table_arr['contentFooter']
                                                        )
                                );
                    $html_content_arr[] = $pdf_data;
                    $mm_field_data = '';
                } #foreach ($act_target_arr as $target_arr)

                $act_id_arr[] = $table_arr['id'];
            } #foreach ($letter_merge_arr as $table_arr)
//$this->log->info(sprintf('MergeLetter processing activity_target records finished'));
            if (count($act_id_arr) > 0) {
                $doc_job = $this->em
                                ->getRepository('ESERVMAINCommunicationsBundle:DocumentJob')
                                ->find($document_job_id);                
                $this->mergeLetterFinish(
                    $doc_job
                   ,$current_date_time
                   ,$act_id_arr
                   ,$act_comp_status_id
                   ,$curr_date_time
                   ,$html_content_arr
                );
            }
            $message = 'Completed Successfully';
            $status = true;

            $this->em->getConnection()->commit();
        } catch (\Exception $ex) {
            $message = $ex->getMessage();
            $this->em->getConnection()->rollback();
            $this->c
                    ->get('db_core_function_services')
                    ->insertMtlError($function, $message);

            if (!(is_array($function_result))) {
                $function_result = array();
            }
            $function_result['error'] = 'Error processing letter - ' . $message;
        }

        $res_array = array(
            'success' => $status,
            'msg' => $message
        );
//$this->log->info(sprintf('MergeLetter (ESERVMAINCommunicationsProcesses) finished success: %s, msg: %s', $res_array['success'], $res_array['msg']));

        return $res_array;
    } #MergeLetter
    
    private function mergeLetterFinish(
        $document_job
       ,$dj_date_time
       ,$act_id_arr
       ,$act_status_id
       ,$act_date_time
       ,$html_content
       ,$show = false
    ) {
//$this->log->info(sprintf('mergeLetterFinish start $document_job.id: %s', $document_job->getId()));
//var_dump($html_content); die;
        if (is_array($html_content)) {
            $html = '';
            $all_html_content_count = count($html_content);
            $page_break_counter = 0;
            foreach ($html_content as $html_con) {
                $page_break_counter++;
                $html .= $this->generateHTMLContent($html_con, ($page_break_counter < $all_html_content_count ? TRUE : FALSE));
            }
        } else {
            $html = $html_content;
        }
//$this->log->info(sprintf('mergeLetterFinish $html: %s, $show: %s', $html, ($show ? 'TRUE' : 'FALSE')));
        if ($show === true) {
            #There is no need to create the PDF as it is not part of a group of letters (it is not used) - it is a Print Now letter
        } else {
            $this->generatePdf($html, $document_job->getId(), 'documentJob');
        }
        $document_job->setQueuedDate($dj_date_time);
        $this->em->persist($document_job);
        $this->em->flush();
        
        if (count($act_id_arr) > 0) {
            $result = $this->em
                           ->getRepository('ESERVMAINActivityBundle:Activity')
                           ->updateActivityById(
                                 $act_id_arr
                                ,$act_date_time
                                ,$act_status_id
                      );
        }
//$this->log->info(sprintf('MergeLetter finished'));        
    } #mergeLetterFinish end

    public function generatePdfHTML($data_array, $id = '') {
        $html = '';

        foreach ($data_array['template_parts'] as $key => $value) {
            $html .= $value;
        }

        $html = str_replace(array_keys($data_array['merged_data']), array_values($data_array['merged_data']), $html);

        #$this->get('knp_snappy.pdf')->generateFromHtml($html, "file_$id.pdf");
        $this->c->get('knp_snappy.pdf')->generateFromHtml($html, "file_$id.pdf");
    }

    public function generateHTMLContent($data_array, $include_page_breaker = false, $attachments = array()) {
        $html = '';

        foreach ($data_array['template_parts'] as $key => $value) {
            $html .= $value;
        }

        $web_folder = $this->c->get('kernel')->getRootDir() . '/../web/';
        $css_file = $web_folder . 'common/assets/libs/merlin/css/mtl_ckeditor.css';

        $css_contents = '<style type="text/css">' . file_get_contents($css_file) . '</style>';

        $attachments_urls = array();
        $attachments_count = count($attachments);

        foreach ($attachments as $attach) {
            #$attachments_urls[] = '<a href="' . $this->c->get('router')->generate('eserv_main_media_files_download_files', array('id' => $attach['media_store_id']), true) . '">' . $attach['name']. '</a>';
            $eserv_hash_services = new \ESERV\MAIN\SecurityBundle\Services\ESERVHash($this->em, $this->c);
            $encrypt_str = $eserv_hash_services->eserv_encrypt($attach['id']);
            $attachments_urls[] = '<a href="' . $this->c->get('router')->generate('eserv_main_email_attach', array('id' => $encrypt_str), true) . '">' . $attach['name'] . '</a>';
            #$attachments_urls[] = '<a href="' . $this->c->get('router')->generate('eserv_main_email_attach', array('id' => urlencode($encrypt_str)), true) . '">' . $attach['name']. '</a>';
        }
//        var_dump($data_array['merged_data']); die;
        $html = ''
//                . '<html>'
//                . '<head>' . $css_contents . '</head>'
//                . '<body>'
                . $css_contents
                . ($attachments_count > 0 ? '<div class="eserv_email_attachments">' . implode(' | ', $attachments_urls) . '</div>' : '')
                . ($include_page_breaker ? '<div class="eserv_pdf_page">' : '')
                . str_replace(array_keys($data_array['merged_data']), array_values($data_array['merged_data']), $html)
                . ($include_page_breaker ? '</div>' : '')
//                . '</body>'
//                . '</html>'
                . '';

        return $html;
    }

#generateHTMLContent end

    public function generatePdf($html, $id = '', $file = 'file') {
//        $web_folder = $this->c->get('kernel')->getRootDir() . '/../web/';
        $web_folder = $this->documentFolder;
        $folder = $web_folder . 'tmp/print_queue/Complete/';
        $file_name = $folder . $file . '_' . $id . '.pdf';

        if (file_exists($file_name)) {
            unlink($file_name);
        }
        $this->c->get('knp_snappy.pdf')->generateFromHtml($html, $file_name);
    }

#generatePdf end

    public function getMailMergeFieldData($field_arr, $entity_id, $entity_name, $contact, $user_arr = array()) {
//$this->log->error(sprintf('getMailMergeFieldData start $field_arr: (%s), $entity_id: %s, $entity_name: %s, $contact: (id: %s)', implode($field_arr), $entity_id, $entity_name, $contact->getId()));
        $return_array = array();
        $field_data_arr = array();
        $field_data_str = '';
        $user_id = $user_name = $user_phone = $user_fax = $user_email = '';
        $person = $address = $employer = $workplace = $wp_address = FALSE;
        $work_contact = FALSE;
        $ref_no_data = $first_name_data = $last_name_data = $initials_data = '';
        $gender_data = $dob_data = $title_data = '';
        $full_name_data = $mail_name_data = ''; #these fields are the same
        $teacher_name_data = $ni_number_data = '';
        $emp_add_1_data = $emp_add_2_data = $emp_add_3_data = $emp_add_full_data = '';
        $emp_town_data = $emp_county_data = $emp_postcode_data = '';
        $emp_country_code_data = $emp_country_name_data = '';
        $work_code_data = $work_name_data = '';
        $work_add_1_data = $work_add_2_data = $work_add_3_data = $work_add_full_data = '';
        $work_town_data = $work_county_data = $work_postcode_data = '';
        $work_country_code_data = $work_country_name_data = '';
        $add_1_data = $add_2_data = $add_3_data = $add_full_data = '';
        $add_town_data = $add_county_data = $add_postcode_data = '';
        $add_country_code_data = $add_country_name_data = '';
        $employer_code_data = $employer_name_data = '';
        #$today = date('j F Y');
        $today = date('j/m/Y');

        try {
            if (count($user_arr) > 0) {
                $user_id = array_key_exists('UserId', $user_arr) ? $user_arr['UserId'] : '';
                $user_name = array_key_exists('UserName', $user_arr) ? $user_arr['UserName'] : '';
                $user_phone = array_key_exists('UserPhone', $user_arr) ? $user_arr['UserPhone'] : '';
                $user_fax = array_key_exists('UserFax', $user_arr) ? $user_arr['UserFax'] : '';
                $user_email = array_key_exists('UserEmail', $user_arr) ? $user_arr['UserEmail'] : '';
            }
            $person = $this->em->getRepository('ESERVMAINContactBundle:Person')->findOneByContact($contact);
            if ($person instanceof \ESERV\MAIN\ContactBundle\Entity\Person) {
//var_dump('The mail merge data is for a person'); die;                
                $ref_no_data = $person->getReferenceNo();
                $first_name_data = $person->getFirstName();
                $last_name_data = $person->getLastName();
                $initials_data = $person->getInitials();
                $gender_data = $person->getGender();
                $dob_data = !is_null($person->getDateOfBirth()) ? $person->getDateOfBirth()->format(AppConstants::MAIL_MERGE_DATE_FORMAT) : '';
                $title = $person->getTitle();
                if ($title instanceof \ESERV\MAIN\SystemConfigBundle\Entity\Title) {
                    $title_data = $title->getName();
                    $full_name_data = $title_data . ' ';
                    #$mail_name_data = $title_data . ' ';                    
                }
                #$full_name_data = $title_data . ' ' . $initials_data . ' ' . $last_name_data;
                if (
                        (!(is_null($person->getInitials()))) &&
                        ($person->getInitials() <> '') &&
                        ($person->getInitials() <> NULL)
                ) {
                    $full_name_data = $full_name_data . $initials_data . ' ';
                    #$mail_name_data = $mail_name_data . $initials_data . ' ';
                    $teacher_name_data = $initials_data . ' ';
                }
                $full_name_data = $full_name_data . $last_name_data;
                #$mail_name_data = $mail_name_data . $last_name_data;
                $teacher_name_data = $teacher_name_data . $last_name_data;
                $ni_number_data = $person->getNiNumber();
                #$emp_detail = $this->em->getRepository('ESERVMAINMembershipBundle:EmploymentDetail')->findOneByContact($contact);
                #$emp_detail = $this->em->getRepository('ESERVMAINMembershipBundle:EmploymentDetail')->findOneBy(array('contact' => $contact, 'primaryRecord' => 'Y'));
//$this->log->error(sprintf('getMailMergeFieldData Before select of primary employer'));
                $emp_detail = $this->em
                        ->getRepository('ESERVMAINMembershipBundle:EmploymentDetail')
                        ->getPrimaryEmployerByContact($contact);
                if ($emp_detail instanceof \ESERV\MAIN\MembershipBundle\Entity\EmploymentDetail) {
//$this->log->error(sprintf('getMailMergeFieldData primary employment_detail found id: %s', $emp_detail->getId()));
                    $employer = $emp_detail->getEmployer();
                    $workplace = $emp_detail->getWorkplace();
                    if ($workplace instanceof \ESERV\MAIN\MembershipBundle\Entity\Workplace) {
                        $work_contact = $workplace->getOrganisation()->getContact();
//$this->log->error(sprintf('getMailMergeFieldData $work_contact.id: %s', $work_contact->getId()));                        
                    }
                }
//                else { $this->log->error(sprintf('getMailMergeFieldData No primary employment_detail found for contact.id: %s', $contact->getId())); }
                if ($this->AddressDataRequired($field_arr)) {
                    $address = $this->em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVAddress')->getPrimaryAddressByContactId($contact->getId());
                    if ($address instanceof \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\EservVAddress) {
                        $add_1_data = $address->getAddressLine1() ? $address->getAddressLine1() : false;
                        $add_2_data = $address->getAddressLine2() ? $address->getAddressLine2() : false;
                        $add_3_data = $address->getAddressLine3() ? $address->getAddressLine3() : false;
                        $add_town_data = $address->getTown() ? $address->getTown() : false;
                        $add_county_data = $address->getCounty() ? $address->getCounty() : false;
                        $add_postcode_data = $address->getPostcode() ? $address->getPostcode() : false;
                        $add_country_code_data = $address->getCountryCode() ? $address->getCountryCode() : false;
                        $add_country_name_data = $address->getCountryDescription() ? $address->getCountryDescription() : false;
                        $add_full_data = '<span class="full_address_area">'
                                . ($add_1_data ? '<span>' . $add_1_data . '</span>' : '')
                                . ($add_2_data ? '<span>' . $add_2_data . '</span>' : '')
                                . ($add_3_data ? '<span>' . $add_3_data . '</span>' : '')
                                . ($add_town_data ? '<span>' . $add_town_data . '</span>' : '')
                                . ($add_county_data ? '<span>' . $add_county_data . '</span>' : '')
                                . ($add_postcode_data ? '<span>' . $add_postcode_data . '</span>' : '')
                                . ($add_country_name_data ? '<span>' . $add_country_name_data . '</span>' : '')
                                . '</span>';
                    } #else { $this->log->info(sprintf('getMailMergeFieldData $address is not an instanceof address contact.id: %s', $contact->getId())); } 
                }
                #end person
            } else {
//var_dump('The mail merge data is for a workplace'); die;
                $workplace = $this->em->getRepository('ESERVMAINMembershipBundle:Workplace')->getWorkplaceByContact($contact->getId());
                if ($workplace) {
                    $work_contact = $contact;
                } else {
                    $employer = $this->em->getRepository('ESERVMAINMembershipBundle:Employer')->getEmployerByContact($contact->getId());
                }
            }

            if ($employer instanceof \ESERV\MAIN\MembershipBundle\Entity\Employer) {
                if ($this->EmployerDataRequired($field_arr)) {
                    $employer_code_data = $employer->getCode();
                    $employer_name_data = $employer->getOrganisation()->getName();
                    if ($this->EmployerAddressDataRequired($field_arr)) {
                        $emp_address = $this->em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVAddress')->getPrimaryAddressByContactId($employer->getOrganisation()->getContact()->getId());
                        if ($emp_address instanceof \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\EservVAddress) {
                            $emp_add_1_data = $emp_address->getAddressLine1() ? $emp_address->getAddressLine1() : false;
                            $emp_add_2_data = $emp_address->getAddressLine2() ? $emp_address->getAddressLine2() : false;
                            $emp_add_3_data = $emp_address->getAddressLine3() ? $emp_address->getAddressLine3() : false;
                            $emp_town_data = $emp_address->getTown() ? $emp_address->getTown() : false;
                            $emp_county_data = $emp_address->getCounty() ? $emp_address->getCounty() : false;
                            $emp_postcode_data = $emp_address->getPostcode() ? $emp_address->getPostcode() : false;
                            $emp_country_code_data = $emp_address->getCountryCode() ? $emp_address->getCountryCode() : false;
                            $emp_country_name_data = $emp_address->getCountryDescription() ? $emp_address->getCountryDescription() : false;

                            $emp_add_full_data = '<span class="full_address_area">'
                                    . (($employer_name_data != '') ? '<span>' . $employer_name_data . '</span>' : '')
                                    . ($emp_add_1_data ? '<span>' . $emp_add_1_data . '</span>' : '')
                                    . ($emp_add_2_data ? '<span>' . $emp_add_2_data . '</span>' : '')
                                    . ($emp_add_3_data ? '<span>' . $emp_add_3_data . '</span>' : '')
                                    . ($emp_town_data ? '<span>' . $emp_town_data . '</span>' : '')
                                    . ($emp_county_data ? '<span>' . $emp_county_data . '</span>' : '')
                                    . ($emp_postcode_data ? '<span>' . $emp_postcode_data . '</span>' : '')
                                    . ($emp_country_name_data ? '<span>' . $emp_country_name_data . '</span>' : '')
                                    . '</span>';
                        }
                    }
                }
            }
            if ($workplace instanceof \ESERV\MAIN\MembershipBundle\Entity\Workplace) {
                if ($this->WorkplaceDataRequired($field_arr)) {
//$this->log->error(sprintf('getMailMergeFieldData WorkplaceDataRequired'));
                    $work_code_data = $workplace->getCode();
                    $work_name_data = $workplace->getOrganisation()->getName();
                    if ($this->WorkplaceAddressDataRequired($field_arr)) {
                        $wp_address = $this->em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVAddress')->getPrimaryAddressByContactId($work_contact->getId());
                        if ($wp_address instanceof \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\EservVAddress) {
//$this->log->error(sprintf('getMailMergeFieldData $wp_address found'));
                            $work_add_1_data = $wp_address->getAddressLine1() ? $wp_address->getAddressLine1() : false;
                            $work_add_2_data = $wp_address->getAddressLine2() ? $wp_address->getAddressLine2() : false;
                            $work_add_3_data = $wp_address->getAddressLine3() ? $wp_address->getAddressLine3() : false;
                            $work_town_data = $wp_address->getTown() ? $wp_address->getTown() : false;
                            $work_county_data = $wp_address->getCounty() ? $wp_address->getCounty() : false;
                            $work_postcode_data = $wp_address->getPostcode() ? $wp_address->getPostcode() : false;
                            $work_country_code_data = $wp_address->getCountryCode() ? $wp_address->getCountryCode() : false;
                            $work_country_name_data = $wp_address->getCountryDescription() ? $wp_address->getCountryDescription() : false;

                            $work_add_full_data = '<span class="full_address_area">'
                                    . (($work_name_data != '') ? '<span>' . $work_name_data . '</span>' : '')
                                    . ($work_add_1_data ? '<span>' . $work_add_1_data . '</span>' : '')
                                    . ($work_add_2_data ? '<span>' . $work_add_2_data . '</span>' : '')
                                    . ($work_add_3_data ? '<span>' . $work_add_3_data . '</span>' : '')
                                    . ($work_town_data ? '<span>' . $work_town_data . '</span>' : '')
                                    . ($work_county_data ? '<span>' . $work_county_data . '</span>' : '')
                                    . ($work_postcode_data ? '<span>' . $work_postcode_data . '</span>' : '')
                                    . ($work_country_name_data ? '<span>' . $work_country_name_data . '</span>' : '')
                                    . '</span>';
                        }
                    }
                }
            }
            $email_data = $this->getEmailAddress($field_arr, $contact);

            foreach ($field_arr as $field) {
//$this->log->info(sprintf('getMailMergeFieldData $field: %s', $field));
                switch ($field) {
                    case $this->getMailMergeName('RefNo'):
                        $field_data_str .= ',"' . $ref_no_data . '"';
                        $field_data_arr[$field] = $ref_no_data;
                        break;
                    case $this->getMailMergeName('FirstName'):
                    case $this->getMailMergeName('Forename'):
                        $field_data_str .= ',"' . $first_name_data . '"';
                        $field_data_arr[$field] = $first_name_data;
                        break;
                    case $this->getMailMergeName('LastName'):
                    case $this->getMailMergeName('Surname'):
                        $field_data_str .= ',"' . $last_name_data . '"';
                        $field_data_arr[$field] = $last_name_data;
                        break;
                    case $this->getMailMergeName('TitleDesc'):
                        $field_data_str .= ',"' . $title_data . '"';
                        $field_data_arr[$field] = $title_data;
                        break;
                    case $this->getMailMergeName('Initials'):
                        $field_data_str .= ',"' . $initials_data . '"';
                        $field_data_arr[$field] = $initials_data;
                        break;
                    case $this->getMailMergeName('MailName'):
                    case $this->getMailMergeName('FullName'):
                        $field_data_str .= ',"' . $full_name_data . '"';
                        $field_data_arr[$field] = $full_name_data;
                        break;
                    case $this->getMailMergeName('Gender'):
                        $field_data_str .= ',"' . $gender_data . '"';
                        $field_data_arr[$field] = $gender_data;
                        break;
                    case $this->getMailMergeName('DateOfBirth'):
                        $field_data_str .= ',"' . $dob_data . '"';
                        $field_data_arr[$field] = $dob_data;
                        break;
                    case $this->getMailMergeName('AddressFull'):
                        $field_data_str .= ',"' . $add_full_data . '"';
                        $field_data_arr[$field] = $add_full_data;
                        break;
                    case $this->getMailMergeName('AddressLine1'):
                        $field_data_str .= ',"' . $add_1_data . '"';
                        $field_data_arr[$field] = $add_1_data;
                        break;
                    case $this->getMailMergeName('AddressLine2'):
                        $field_data_str .= ',"' . $add_2_data . '"';
                        $field_data_arr[$field] = $add_2_data;
                        break;
                    case $this->getMailMergeName('AddressLine3'):
                        $field_data_str .= ',"' . $add_3_data . '"';
                        $field_data_arr[$field] = $add_3_data;
                        break;
                    case $this->getMailMergeName('AddressTown'):
                        $field_data_str .= ',"' . $add_town_data . '"';
                        $field_data_arr[$field] = $add_town_data;
                        break;
                    case $this->getMailMergeName('AddressCounty'):
                        $field_data_str .= ',"' . $add_county_data . '"';
                        $field_data_arr[$field] = $add_county_data;
                        break;
                    case $this->getMailMergeName('AddressPostcode'):
                        $field_data_str .= ',"' . $add_postcode_data . '"';
                        $field_data_arr[$field] = $add_postcode_data;
                        break;
                    case $this->getMailMergeName('AddressCountryName'):
                        $field_data_str .= ',"' . $add_country_name_data . '"';
                        $field_data_arr[$field] = $add_country_name_data;
                        break;
                    case $this->getMailMergeName('AddressCountryCode'):
                        $field_data_str .= ',"' . $add_country_code_data . '"';
                        $field_data_arr[$field] = $add_country_code_data;
                        break;
                    case $this->getMailMergeName('EmailAddr'):
                        $field_data_str .= ',"' . $email_data . '"';
                        $field_data_arr[$field] = $email_data;
                        break;
                    case $this->getMailMergeName('EmployerCode'):
                        $field_data_str .= ',"' . $employer_code_data . '"';
                        $field_data_arr[$field] = $employer_code_data;
                        break;
                    case $this->getMailMergeName('EmployerName'):
                        $field_data_str .= ',"' . $employer_name_data . '"';
                        $field_data_arr[$field] = $employer_name_data;
                        break;
                    case $this->getMailMergeName('EmployerAddrFull'):
                        $field_data_str .= ',"' . $emp_add_full_data . '"';
                        $field_data_arr[$field] = $emp_add_full_data;
                        break;
                    case $this->getMailMergeName('EmployerAddr1'):
                        $field_data_str .= ',"' . $emp_add_1_data . '"';
                        $field_data_arr[$field] = $emp_add_1_data;
                        break;
                    case $this->getMailMergeName('EmployerAddr2'):
                        $field_data_str .= ',"' . $emp_add_2_data . '"';
                        $field_data_arr[$field] = $emp_add_2_data;
                        break;
                    case $this->getMailMergeName('EmployerAddr3'):
                        $field_data_str .= ',"' . $emp_add_3_data . '"';
                        $field_data_arr[$field] = $emp_add_3_data;
                        break;
                    case $this->getMailMergeName('EmployerTown'):
                        $field_data_str .= ',"' . $emp_town_data . '"';
                        $field_data_arr[$field] = $emp_town_data;
                        break;
                    case $this->getMailMergeName('EmployerCounty'):
                        $field_data_str .= ',"' . $emp_county_data . '"';
                        $field_data_arr[$field] = $emp_county_data;
                        break;
                    case $this->getMailMergeName('EmployerPostcode'):
                        $field_data_str .= ',"' . $emp_postcode_data . '"';
                        $field_data_arr[$field] = $emp_postcode_data;
                        break;
                    case $this->getMailMergeName('EmployerCountryName'):
                        $field_data_str .= ',"' . $emp_country_name_data . '"';
                        $field_data_arr[$field] = $emp_country_name_data;
                        break;
                    case $this->getMailMergeName('EmployerCountryCode'):
                        $field_data_str .= ',"' . $emp_country_code_data . '"';
                        $field_data_arr[$field] = $emp_country_code_data;
                        break;
                    case $this->getMailMergeName('WorkplaceCode'):
                        $field_data_str .= ',"' . $work_code_data . '"';
                        $field_data_arr[$field] = $work_code_data;
                        break;
                    case $this->getMailMergeName('WorkplaceName'):
                        $field_data_str .= ',"' . $work_name_data . '"';
                        $field_data_arr[$field] = $work_name_data;
                        break;

                    case $this->getMailMergeName('WorkplaceAddrFull'):
                        $field_data_str .= ',"' . $work_add_full_data . '"';
                        $field_data_arr[$field] = $work_add_full_data;
                        break;

                    case $this->getMailMergeName('WorkplaceAddr1'):
                        $field_data_str .= ',"' . $work_add_1_data . '"';
                        $field_data_arr[$field] = $work_add_1_data;
                        break;
                    case $this->getMailMergeName('WorkplaceAddr2'):
                        $field_data_str .= ',"' . $work_add_2_data . '"';
                        $field_data_arr[$field] = $work_add_2_data;
                        break;
                    case $this->getMailMergeName('WorkplaceAddr3'):
                        $field_data_str .= ',"' . $work_add_3_data . '"';
                        $field_data_arr[$field] = $work_add_3_data;
                        break;
                    case $this->getMailMergeName('WorkplaceTown'):
                        $field_data_str .= ',"' . $work_town_data . '"';
                        $field_data_arr[$field] = $work_town_data;
                        break;
                    case $this->getMailMergeName('WorkplaceCounty'):
                        $field_data_str .= ',"' . $work_county_data . '"';
                        $field_data_arr[$field] = $work_county_data;
                        break;
                    case $this->getMailMergeName('WorkplacePostcode'):
                        $field_data_str .= ',"' . $work_postcode_data . '"';
                        $field_data_arr[$field] = $work_postcode_data;
                        break;
                    case $this->getMailMergeName('WorkplaceCountryName'):
                        $field_data_str .= ',"' . $work_country_name_data . '"';
                        $field_data_arr[$field] = $work_country_name_data;
                        break;
                    case $this->getMailMergeName('WorkplaceCountryCode'):
                        $field_data_str .= ',"' . $work_country_code_data . '"';
                        $field_data_arr[$field] = $work_country_code_data;
                        break;
                    case $this->getMailMergeName('Today'):
                        $field_data_str .= ',"' . $today . '"';
                        $field_data_arr[$field] = $today;
                        break;
                    case $this->getMailMergeName('UserId'):
                        $field_data_str .= ',"' . $user_id . '"';
                        $field_data_arr[$field] = $user_id;
                        break;
                    case $this->getMailMergeName('UserName'):
                        $field_data_str .= ',"' . $user_name . '"';
                        $field_data_arr[$field] = $user_name;
                        break;
                    case $this->getMailMergeName('UserPhone'):
                        $field_data_str .= ',"' . $user_phone . '"';
                        $field_data_arr[$field] = $user_phone;
                        break;
                    case $this->getMailMergeName('UserFax'):
                        $field_data_str .= ',"' . $user_fax . '"';
                        $field_data_arr[$field] = $user_fax;
                        break;
                    case $this->getMailMergeName('UserEmail'):
                        $field_data_str .= ',"' . $user_email . '"';
                        $field_data_arr[$field] = $user_email;
                        break;
                    case $this->getMailMergeName('TeacherName'):
                        $field_data_str .= ',"' . $initials_data . ' ' . $last_name_data . '"';
                        $field_data_arr[$field] = $initials_data . ' ' . $last_name_data;
                        break;
                    case $this->getMailMergeName('NINumber'):
                        $field_data_str .= ',"' . $ni_number_data . '"';
                        $field_data_arr[$field] = $ni_number_data;
                        break;
                    default:
                        $field_data_str .= ',"NoMappingForField"';
                        $field_data_arr[$field] = 'NoMappingForField';
                } #switch ($mm_field)
            }
//$this->log->info(sprintf('getMailMergeFieldData after switch'));

            $field_data_str = ltrim($field_data_str, ',');
        } catch (\Exception $ex) {
            $return_array = array('error' => $ex->getMessage());

            $field_data_arr = array();
            $field_data_str = '';
        }
//$this->log->info(sprintf('getMailMergeFieldData count($field_data_arr): %s, %s', count($field_data_arr), ((count($field_data_arr) > 0) ? implode(',', $field_data_arr) : 'array is empty')  ));
        if (count($field_data_arr) > 0) {
            #$return_array = array($field_data_arr, $field_data_str);
            $return_array = array('data_arr' => $field_data_arr, 'data_str' => $field_data_str);
        }
//$this->log->info(sprintf('getMailMergeFieldData end data_arr: (%s), data_str: %s', implode(',', $field_data_arr), $field_data_str));

        return $return_array;
    }

#getMailMergeFieldData

    /**
     * Name: getMailMergeFieldUserData
     * Purpose: Get user mail merge data
     * 
     * Returns an array
     */
    public function getMailMergeFieldUserData($field_arr, $user_id) {
        $get_mm_user = FALSE;
        $user_arr = array();

        if (($user_id <> '') && (!(is_null($user_id))) && ($user_id <> NULL)) {
            foreach ($field_arr as $field) {
                if (
                        ($field == $this->getMailMergeName('UserId')) ||
                        ($field == $this->getMailMergeName('UserName')) ||
                        ($field == $this->getMailMergeName('UserPhone')) ||
                        ($field == $this->getMailMergeName('UserFax')) ||
                        ($field == $this->getMailMergeName('UserEmail'))
                ) {
                    $get_mm_user = TRUE;
                    break;
                }
            }
            if ($get_mm_user) {
                $eserv_v_user = $this->em->getRepository('ESERVMAINAdministrationBundle:EservVUser')->getByFosUserId($user_id); #var_dump($eserv_v_user); die;
                if ($eserv_v_user) {
                    $user_arr['UserId'] = $eserv_v_user['fosUserId'];
                    $user_arr['UserName'] = $eserv_v_user['displayName'];
                    $user_arr['UserPhone'] = ''; #TODO: get this data
                    $user_arr['UserFax'] = ''; #TODO: get this data
                    $user_arr['UserEmail'] = $eserv_v_user['fosUserEmail'];
                }
            }
            #var_dump($user_arr); die;
        }

        return $user_arr;
    }

#getMailMergeFieldUserData end

    public function SendEmailProcess($id = NULL) {
//$this->log->info(sprintf('SendEmailProcess (ESERVMAINCommunicationsProcesses) start $id: %s', $id));
        $error_msg_arr = array();
        $function = 'SendEmailProcess';

        if ((is_null($id)) || ($id == '') || ($id == NULL)) {
            $email_arr = $this->em
                    ->getRepository('ESERVMAINActivityBundle:EservVOutstandingEmail')
                    ->getAll();
        } else {
            $col_arr = array(
                'id'
                , 'templateVersionId'
                , 'shortDescription'
                , 'contentHeader'
                , 'contentBody'
                , 'contentFooter'
                , 'entityId'
                , 'entityName'
            );
            $email_arr = $this->em
                    ->getRepository('ESERVMAINActivityBundle:EservVOutstandingEmail')
                    ->getById($id, $col_arr);
        }
        $act_comp_status_id = $email_queued_id = '';
        $email_sending_id = $email_sent_id = '';
        $prev_temp_ver_id = FALSE;
        $header_arr = $body_arr = $footer_arr = array();
        $out_email_id_arr = array();
        $mm_field_arr = array();
        $act_id_arr = array();
        $user_arr = array();
        $html_content_arr = $email_attach_arr = array();
        $success = TRUE;
        $current_date_time = new \DateTime();
        $curr_date_time = date('Y-m-d H:i:s');
        $emailNotifyMsgArr = array();
        $totalCount = 0;
        $successCount = 0;
        $failedCount = 0;
        
        if (count($email_arr) > 0) {
            $act_comp_status = $this->em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getActivityCompleteStatus(array('id'));
            $act_comp_status_id = $act_comp_status['id'];
            $email_queued = $this->em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getActivityQueuedSendingStatus(array('id'));
            $email_queued_id = $email_queued['id'];
            $email_sending = $this->em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getActivityEmailSendingStatus(array('id'));
            $email_sending_id = $email_sending['id'];
            $email_sent = $this->em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getActivityEmailSentStatus(array('id'));
            $email_sent_id = $email_sent['id'];
            $emailStoppedStatus = $this->em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getBySystemCodeTypeAndCode(\ESERV\MAIN\Services\AppConstants::SCT_ACTIVITY_EMAIL_STATUS_CODE, \ESERV\MAIN\Services\AppConstants::SC_ACTIVITY_EMAIL_STATUS_STOPPED_CODE);
            $emailStoppedId = $emailStoppedStatus ? $emailStoppedStatus->getId() : null;
            #print(sprintf('Statuses (system_code.id)<br />Activity complete: %s, Email sending: %s, Email sent: %s<br /><br />', $act_comp_status->getId(), $email_sending->getId(), $email_sent->getId())); #die;                            
//$this->log->info(sprintf('SendEmailProcess Activity complete: %s, Email queued: %s, Email sending: %s, Email sent: %s', $act_comp_status_id, $email_queued_id, $email_sending_id, $email_sent_id));

            foreach ($email_arr as $email) {
                $out_email_id_arr[] = $email['id'];
                $act_target_email_arr = $this->em->getRepository('ESERVMAINActivityBundle:ActivityEmail')->getByActivity($email['id']);
                $totalCount = $totalCount + count($act_target_email_arr);
            }
//$this->log->info(sprintf('SendEmailProcess $out_email_id_arr(%s)', implode(',', $out_email_id_arr)));
            #Set activity_email to a status of sending                             
            $this->em->getConnection()->beginTransaction();
            $act_email = $this->em->getRepository('ESERVMAINActivityBundle:ActivityEmail')->updateByActivityId($out_email_id_arr, $curr_date_time, $email_sending_id, $email_queued_id);
            $this->em->getConnection()->commit();
        }
        foreach ($email_arr as $email) {
//$this->log->info(sprintf('SendEmailProcess activity.id: %s, template_version.id: %s, activity.short_description: %s, entity_id: %s, entity_name: %s', $email['id'], $email['templateVersionId'], $email['shortDescription'], $email['entityId'], $email['entityName']));
            $temp_ver_id = $email['templateVersionId'];

            $act = $this->em->getRepository('ESERVMAINActivityBundle:Activity')->find($email['id']);
            $act_created_by = $act->getCreatedBy();
            $createdAt = $act->getCreatedAt() ? $act->getCreatedAt()->format('d/m/Y') : '';
            $shortDescription = $act->getShortDescription();
            $emailNotifyMsgArr[$email['id']] = array(
                'created_at' => $createdAt,
                'short_description' => $shortDescription,
                'status' => false,
                'msg' => '',
            );  
                    
            if (
                    ($prev_temp_ver_id === FALSE) ||
                    ($temp_ver_id !== $prev_temp_ver_id)
            ) {
                if ($prev_temp_ver_id === FALSE) {
                    
                }
                #get the mail merge fields for the header, body and footer
                preg_match_all('/{[a-z-0-9_]*}/i', $email['contentHeader'], $header_arr); #print_r($header_arr); print('<br />');
                preg_match_all('/{[a-z-0-9_]*}/i', $email['contentBody'], $body_arr);  #print_r($body_arr); print('<br />');
                preg_match_all('/{[a-z-0-9_]*}/i', $email['contentFooter'], $footer_arr);  #print_r($footer_arr); print('<br />');
                $mm_field_arr = array_merge($header_arr[0], $body_arr[0], $footer_arr[0]); #print_r($mm_field_arr); print('<br />');
                $mm_field_arr = array_unique($mm_field_arr); #var_dump($mm_field_arr); die;                
//$this->log->info(sprintf('SendEmailProcess $mm_field_arr: (%s) for template_version.id: %s', implode(',', $mm_field_arr), $temp_ver_id)); die;

                $prev_temp_ver_id = $temp_ver_id;
                $html_content_arr = array();
            }
            $handle_attach = $this->HandleEmailAttachment($email['id'], 'Activity');
            if ($handle_attach['success'] === TRUE) {
//$this->log->info(sprintf('SendEmailProcess $handle_attach[success] is %s', $handle_attach['success'] === TRUE ? 'TRUE' : 'FALSE'));
                $email_attach_arr = $handle_attach['msg'];
                $act_target_email_arr = $this->em->getRepository('ESERVMAINActivityBundle:ActivityEmail')->getByActivity($email['id']);
//$this->log->info(sprintf('SendEmailProcess count($act_target_email_arr): %s', count($act_target_email_arr)));

                $user_arr = $this->getMailMergeFieldUserData($mm_field_arr, $act_created_by);
                $emailNotifyMsgArr[$email['id']]['status'] = TRUE;
                
                foreach ($act_target_email_arr as $k => $act_target_email) {
                    try {
                        $this->em->getConnection()->beginTransaction();
                        $success = FALSE;
//$this->log->info(sprintf('SendEmailProcess (ESERVMAINCommunicationsProcesses) START sending email for activity_target.id: %s', $act_target_email->getActivityTarget()->getId()));
                        $contact = $act_target_email->getActivityTarget()->getContact();
//$this->log->info(sprintf('SendEmailProcess $contact.id: %s', $contact->getId()));                    
                        if (count($mm_field_arr) > 0) {
//$this->log->info(sprintf('SendEmailProcess before executing getMailMergeFieldData(array(%s), %s, %s, %s)', implode(',', $mm_field_arr), $email['entityId'], $email['entityName'], $contact->getId()));
                            $mm_arr = self::getMailMergeFieldData($mm_field_arr, $email['entityId'], $email['entityName'], $contact, $user_arr);
//$this->log->info(sprintf('SendEmailProcess after executing getMailMergeFieldData'));
                            if (array_key_exists('error', $mm_arr)) {
                                $msg = sprintf(
                                        'activity.id: %s, ' .
                                        'activity_target.id: %s, ' .
                                        '$mm_field_arr: (%s), ' .
                                        'Exception in getMailMergeFieldData: %s'
                                        , $act->getId()
                                        , $act_target->getId()
                                        , implode(',', $mm_field_arr)
                                        , $mm_arr['error']
                                );
//                                    print(sprintf('Error sending the email for activity_email. activity_email.id: %s, activity_email.activity_target_id: %s, activity_email.to_email_address: %s<br /><br />', $act_email->getId(), $act_target->getId(), $act_email->getToEmailAddress()));
//$this->log->info(sprintf('Error getting the mail merge data for activity_email(id: %s, activity_target_id: %s, to_email_address: %s)', $act_email->getId(), $act_target->getId(), $act_email->getToEmailAddress()));
                                throw new \Exception($msg);
                            }
                        } else {
                            $mm_arr['data_arr'] = array();
                            $mm_arr['data_str'] = '';
                        }
                        $act_mer_data = $this->em->getRepository('ESERVMAINActivityBundle:ActivityMergeData')->createActivityMergeData($act_target_email->getActivityTarget(), (implode(',', $mm_field_arr)), $mm_arr['data_str'], $this->em);

                        $gen_html_arr = array('merged_data' => $mm_arr['data_arr']
                            , 'template_parts' => array(
                                'headerHTML' => $email['contentHeader']
                                , 'contentHTML' => $email['contentBody']
                                , 'footerHTML' => $email['contentFooter']
                            )
                        );
                        $email_html = $this->generateHTMLContent(
                                $gen_html_arr
                                , FALSE
                                , $email_attach_arr
                        );
                        #insert code to send the email
                        $send_email_arr = self::SendEmail(
                                        $act_target_email->getEmailSubject()
                                        , $act_target_email->getFromEmailAddress()
                                        , $act_target_email->getToEmailAddress()
                                        , $email_html
                                        , AppConstants::html_type
                                        , NULL #$attachment                                
                        );
                        #after sending the email do some error checking to see if the email was sent successfully
//                        if ($send_email_arr['success'] === TRUE) {
//                            $act_email = $this->em->getRepository('ESERVMAINActivityBundle:ActivityEmail')->updateByActivityId(array($email['id']), $curr_date_time, $email_sent_id, $email_sending_id);
//                        } else {
//                            $act_email = $this->em->getRepository('ESERVMAINActivityBundle:ActivityEmail')->updateByActivityId(array($email['id']), $curr_date_time, $email_queued_id, $email_sending_id);                            
//                        }

                        if ($send_email_arr['success'] === FALSE) {
                            if ((stripos($send_email_arr['msg'], "connection") !== false) ||
                                    (stripos($send_email_arr['msg'], "Could not open socket") !== false) ||
                                    (stripos($send_email_arr['msg'], "Could not read from") !== false) ||
                                    (stripos($send_email_arr['msg'], "Unrecognized authentication type") !== false)) {
                                $emailNotifyErrorMsg = 'Connection Error!';
                                $emailStausId = $email_queued_id;
                            } else {
                                $emailNotifyErrorMsg = 'Internal Server Error!';
//                                $emailStausId = $emailStoppedId;
                                $emailStausId = $email_sending_id;
                            }
                            $error_msg = sprintf('activity.id: %s, activity_target.id: %s, Exception: %s', $email['id']
                                    , $act_target_email->getActivityTarget()->getId(), $send_email_arr['msg']);
                            $this->c->get('db_core_function_services')->insertMtlError($function, $error_msg);
                            $error_msg_arr[] = $error_msg;
//                            throw new \Exception($send_email_arr['msg']);
                        } else {
                            $success = TRUE;
                            $emailStausId = $email_sent_id;
                        }
                        if ($emailStausId != $email_sending_id) {
                            $act_email = $this->em->getRepository('ESERVMAINActivityBundle:ActivityEmail')
                                    ->updateByActivityId(array($email['id']), $curr_date_time, $emailStausId, $email_sending_id);
                        }
                        $this->em->getConnection()->commit();
//$this->log->info(sprintf('SendEmailProcess (ESERVMAINCommunicationsProcesses) FINISHED sending email for activity_target.id: %s', $act_target_email->getActivityTarget()->getId()));
                    } catch (\Exception $ex) {
//$this->log->info(sprintf('SendEmailProcess (ESERVMAINCommunicationsProcesses) EXCEPTION sending email for activity_target.id: %s, exception: %s', $act_target_email->getActivityTarget()->getId(), $ex->getMessage()));
                        $this->em->getConnection()->rollback();
                        $error_msg = sprintf(
                                'activity.id: %s, ' .
                                'activity_target.id: %s, ' .
                                'Exception: %s'
                                , $email['id']
                                , $act_target_email->getActivityTarget()->getId()
                                , $ex->getMessage()
                        );
                        $this->c->get('db_core_function_services')->insertMtlError($function, $error_msg);
//                            if (!(is_array($function_result))) {
//                                $function_result = array();
//                            }
//                            $function_result['error'][] = $error_msg;
                        $error_msg_arr[] = $error_msg;
                        $emailNotifyErrorMsg = 'Internal Server Error!';
                    }
                    $person = $this->em->getRepository('ESERVMAINContactBundle:Person')->findOneByContact($contact);
                    $personTitle = $person->getTitle() ? $person->getTitle()->getName() : '';
                    $refNoOrNiNo = ($person->getReferenceNo()) ? $person->getReferenceNo() : $person->getNiNumber();
                    $personDetail =  ($personTitle ? $personTitle . ' ' : '') . $person->getFirstName(). ' '. $person->getLastName() . '(' . $refNoOrNiNo . ')';
                    if ($success === TRUE) {
                        $successCount = $successCount + 1;
                        $emailNotifyMsg = 'Sent';
                    } else {
                        $failedCount = $failedCount + 1;
                        $emailNotifyMsg = $emailNotifyErrorMsg;
                    }
                    $emailNotifyMsgArr[$email['id']]['email'][] = array(
                        'targeted_for' => $personDetail,
                        'status' => $success,
                        'msg' => $emailNotifyMsg
                    );
                } #foreach ($act_target_email_arr as $act_target_email)
                if ($failedCount == 0) {
                    $act_update = $this->em->getRepository('ESERVMAINActivityBundle:Activity')->updateActivityById(array($email['id']), $curr_date_time, $act_comp_status_id);
                }
                $email_attach_arr = array();
            } else { //if ($handle_attach['success'] === FALSE)
                $error_msg_arr[] = $handle_attach['msg'];
                $failedCount = $failedCount + count($act_target_email_arr);
                $emailNotifyMsgArr[$email['id']]['status'] = FALSE;
                $emailNotifyMsgArr[$email['id']]['msg'] = 'Email Attachment Error!';
            }
        } #foreach ($email_arr as $email)
        
        $emailCount = array(
            'total_count' => $totalCount,
            'success_count' => $successCount,
            'failed_count' => $failedCount
        );
        $msg = $this->formatNotificationMessage($emailNotifyMsgArr, $emailCount);
      
        return array(
            'success' => ($successCount == $totalCount) ? TRUE : FALSE,
            'msg' => $msg,
        );
    }

#SendEmailProcess end
    
    public function formatNotificationMessage($messageArray = array(), $emailCount = array()) {
        $msg = '<table class="table table-bordered table-hover">';
        $totalCount = $emailCount['total_count'];
        $successCount = $emailCount['success_count'];
        $failedCount = $emailCount['failed_count'];
        $msg .= '<tr>'
                    . '<td><b>Total:</b></td><td>' . $totalCount . '</td>'
                    . '<td><b>Success:</b></td><td>' . $successCount . '</td>'
                    . '<td><b>Failed:</b></td><td>' . $failedCount . '</td>'
                    . '</tr>'
                ;
        foreach ($messageArray as $actId => $act) {
            $msg .=  '<tr>'
                    . '<td><b>Activity No:</b></td><td>' . $actId . '</td>'
                    . '<td><b>Created At:</b></td><td>' . $act['created_at'] . '</td>'
                    . '<td><b>Short Description:</b></td><td>' . $act['short_description'] . '</td>'
                    . '</tr>'
                ;
            if($act['status'] == FALSE){
                $msg .=  '<tr>'
                        . '<td><b>Error:</b></td><td colspan="5">'.$act['msg'].'</td>'
                        . '</tr>'
                        ;
            }
            $msg .=  '<tr>'
                    . '<td colspan="2"><b>Email Sent To</b></td>'
                    . '<td colspan="2"><b>Status</b></td>'
                    . '<td colspan="2"><b>Comment</b></td>'
                    . '</tr>'
                ;
            foreach ($act['email'] as $kl => $eml){
                $msg .=  '<tr>'
                        . '<td colspan="2">'.$eml['targeted_for'].'</td>'
                        . '<td colspan="2">'.($eml['status'] ? 'Success' : 'Failed').'</td>'
                        . '<td colspan="2">'.$eml['msg'].'</td>'
                        . '</tr>'
                    ;
            }
        }
        $msg .= '</table>';
        return $msg;
    }

    public function HandleEmailAttachment($entity_id, $entity_name) {
//$this->log->info(sprintf('HandleEmailAttachment start $entity_id: %s, $entity_name: %s', $entity_id, $entity_name));        
        $success = FALSE;
        $create_directory = TRUE;
        $message = '';
        $email_attach_arr = array();

        try {
            $separator = $this->c->getParameter('data_separator');
            $media_store_arr = $this->em
                    ->getRepository('ESERVMAINMediaBundle:MediaStore')
                    ->getByEntityIdAndEntityName(
                    $entity_id
                    , $entity_name
            );
            if (count($media_store_arr) > 0) {
                $media_store_id_arr = array();
                $folder = $this->c->getParameter('attachments_base_folder');
//$this->log->info(sprintf('HandleEmailAttachment $folder: %s', $folder));
//$this->log->info(sprintf('HandleEmailAttachment $folder exists: %s', file_exists($folder) ? 'TRUE' : 'FALSE'));
                if (file_exists($folder)) {
//$this->log->info(sprintf('HandleEmailAttachment AAA'));
                    $folder = $folder . '\\' . ((string) $entity_id) . '\\'; #
//$this->log->info(sprintf('HandleEmailAttachment BBB'));
                    $file_arr = glob("$folder*.*");
//$this->log->info(sprintf('HandleEmailAttachment CCC, count($file_arr): %s', count($file_arr)));
                    if (count($file_arr) > 0) {
                        foreach ($file_arr as $file) {
//$this->log->info(sprintf('HandleEmailAttachment deleting file: %s', $file));
                            unlink($file);
                        }
                        $create_directory = FALSE;
                    }
                    if ($create_directory) {
//$this->log->info(sprintf('HandleEmailAttachment creating folder: %s', $folder));
                        mkdir($folder);
                    }
                    $file_name = $folder . date('YmdHHis') . '.txt';
                    $validation_file = fopen($file_name, "w");
                    fwrite($validation_file, 'This is a validation file');
                    fclose($validation_file);

                    foreach ($media_store_arr as $media_store) {
//$this->log->info(sprintf('HandleEmailAttachment creating file: %s', $folder . $media_store->getFileName()));                        
                        file_put_contents($folder . $media_store->getFileName(), $media_store->getContent());
                        $file_size = $media_store->getFileSize();
                        $file_size_name = 'bytes';
                        if ((round($file_size / 1024, 0) > 0)) {
                            $file_size = round($file_size / 1024, 2);
                            $file_size_name = 'KB';
                            if ((round($file_size / 1024, 0) > 0)) {
                                $file_size = round($file_size / 1024, 2);
                                $file_size_name = 'MB';
                                if ((round($file_size / 1024, 0) > 0)) {
                                    $file_size = round($file_size / 1024, 2);
                                    $file_size_name = 'GB';
                                }
                            }
                        }
                        #$attach_file_name = 
//                        Delete media_store when sending out the email
                        if (file_exists($folder . $media_store->getFileName())) {
                            $media_store_id_arr[] = $media_store->getId();
                        }
                        #$email_attach_arr[] = array('media_store_id' => $media_store->getId(), 'name' => sprintf('%s (%s bytes)', $media_store->getFileName(), $media_store->getFileSize()));                        
                        #$email_attach_arr[] = array('id' => ($entity_id . $separator . $media_store->getFileName()), 'name' => sprintf('%s (%s bytes)', $media_store->getFileName(), $media_store->getFileSize()));
                        $email_attach_arr[] = array('id' => ($entity_id . $separator . $media_store->getFileName() . $separator . $file_name), 'name' => sprintf('%s (%s %s)', $media_store->getFileName(), $file_size, $file_size_name));
                    }
                    if (count($media_store_id_arr) > 0) {
                        #delete media_store records                        
                        $delete_success = $this->em
                                ->getRepository('ESERVMAINMediaBundle:MediaStore')
                                ->deleteMediaStoreById(
                                $media_store_id_arr
                        );
                    }
                } else {
//$this->log->info(sprintf('HandleEmailAttachment $folder (%s) does not exist', $folder));
                    throw new \Exception(sprintf('Error in email attachment configuration'));
                }
            } //if (count($attach_arr) > 0)
            $success = TRUE;
            $message = $email_attach_arr;
        } catch (\Exception $e) {
//$this->log->info(sprintf('HandleEmailAttachment exception: %s', $e->getMessage()));
            $success = FALSE;
            $message = $e->getMessage();
            $email_attach_arr = array();
        }
        $return_arr = array(
            'success' => $success
            , 'msg' => $message
            , 'attach' => $email_attach_arr
        );

        return $return_arr;
    }

#HandleEmailAttachment end

    /**
     * Name: DeleteDocumentQueue
     * Purpose: Delete document_queue record(s) for document_job(s) that 
     *          have already been queued. This function only deletes the 
     *          document_queue for the document_job. All other data is kept
     *          for reference
     * 
     * @param type $doc_job_id_arr - array of document_job.id
     *                                
     * Returns an array indicating if the process has been successfully executed
     */
    public function DeleteDocumentQueue($doc_job_id_arr) {
        $message = '';
        $status = '';

        try {
            $this->em->getConnection()->beginTransaction();

            foreach ($doc_job_id_arr as $doc_job_id) {
//                print(sprintf('DeleteDocumentQueue (ESERVMAINCommunicationsProcesses) for document_job.id: %s<br />', $doc_job_id));
                $data_arr = $this->em
                        ->getRepository('ESERVMAINActivityBundle:ActivityJob')
                        ->getByDocumentJob($doc_job_id);
                foreach ($data_arr as $data) {
//                    print(sprintf(' - activity.id: %s<br />', $data['activity_id']));
                    $act_obj = $this->em->getReference('ESERV\MAIN\ActivityBundle\Entity\Activity', $data['activity_id']);
                    $delete_result = $this->em
                            ->createQueryBuilder()
                            ->delete('ESERVMAINCommunicationsBundle:DocumentQueue', 'd')
                            ->where('d.activity = :act_id')
                            ->setParameter('act_id', $act_obj)
                            ->getQuery();
                    $delete_result->execute();
//                    print(sprintf(' - deleted document_queue where activity_id: %s<br />', $data['activity_id']));
                }
//                print('<br />');
            }
            $message = 'Output Documents successfully deleted';
            $status = true;

            $this->em->getConnection()->commit();
        } catch (\Exception $ex) {
            $this->em->getConnection()->rollBack();

            $function = 'DeleteDocumentQueue (ESERVMAINCommunicationsProcesses)';
            $error_msg = sprintf(
                    '$document_job_id: array(%s), Exception: %s'
                    , implode(',', $doc_job_id_arr)
                    , $ex->getMessage()
            );
            $this->c->get('db_core_function_services')
                    ->insertMtlError($function, $error_msg);

            $message = 'Error deleting Output Documents';
            $status = false;
        }

        $result_arr = array(
            'success' => $status,
            'msg' => $message
        );
        return $result_arr;
    }

#DeleteDocumentQueue end

    /**
     * Name: DeleteCommHistory
     * Purpose: Delete all communication history data for the document_job 
     *          record(s) i.e. data in the tables below 
     *          - activity_job
     *          - activity_merge_data
     *          - activity_target
     *          - document_queue
     *          - activity
     *          - document_job
     * 
     * @param type $doc_job_id_arr - array of document_job.id
     *                                
     * Returns an array indicating if the process has been successfully executed
     */
    public function DeleteCommHistory($doc_job_id_arr) {
        $function = 'DeleteCommHistory';

        try {
            $this->em->getConnection()->beginTransaction();

            foreach ($doc_job_id_arr as $doc_job_id) {
                print(sprintf('%s (%s) for document_job.id: %s<br />', $function, self::SERVICE_NAME, $doc_job_id));
                #Get all activity_job records
                $activity_job_id_arr = array();
                $activity_id_arr = array();
                $activity_target_id_arr = array();
                $data_arr = $this->em
                        ->getRepository('ESERVMAINActivityBundle:ActivityJob')
                        ->getByDocumentJob($doc_job_id);
                #Store all activity records from activity_job
                foreach ($data_arr as $data) {
                    $activity_job_id_arr[] = $data['activity_job_id'];
                    $activity_id_arr[] = $data['activity_id'];
                }
//                print(sprintf('&nbsp;&nbsp;- $activity_job_id_arr: array(%s)<br />', implode(',', $activity_job_id_arr)));
                print(sprintf('&nbsp;&nbsp;- $activity_id_arr: array(%s)<br />', implode(',', $activity_id_arr)));
                #Delete all activity_job records
                if (count($activity_job_id_arr) > 0) {
                    $delete_success = $this->em
                            ->getRepository('ESERVMAINActivityBundle:ActivityJob')
                            ->deleteActivityJobById($activity_job_id_arr, FALSE);
                    if ($delete_success['success'] === false) {
                        throw new \Exception($delete_success['msg']);
                    } else {
                        print(sprintf('&nbsp;&nbsp;- all activity_job record(s) (array(%s)) deleted<br />', implode(',', $activity_id_arr)));
                    }
                }
                #Get all activity_target records for the activity
                $at_data_arr = $this->em
                        ->getRepository('ESERVMAINActivityBundle:ActivityTarget')
                        ->getByActivity($activity_id_arr);
                foreach ($at_data_arr as $at_data_arr) {
                    $activity_target_id_arr[] = $at_data_arr['id'];
                }
                #print(sprintf('&nbsp;&nbsp;- $activity_target_id_arr: array(%s)<br />', implode(',', $activity_target_id_arr)));
                #Delete all activity_merge_data records
                if (count($activity_target_id_arr) > 0) {
                    $delete_success = $this->em
                            ->getRepository('ESERVMAINActivityBundle:ActivityMergeData')
                            ->deleteActivityMergeDataByActivityTargetId($activity_target_id_arr, FALSE);
                    if ($delete_success['success'] === false) {
                        throw new \Exception($delete_success['msg']);
                    } else {
                        print(sprintf('&nbsp;&nbsp;- all activity_merge_data record(s) by activity_target (array(%s)) deleted<br />', implode(',', $activity_target_id_arr)));
                    }
                }
                #Delete all activity_target records
                if (count($activity_target_id_arr) > 0) {
                    $delete_success = $this->em
                            ->getRepository('ESERVMAINActivityBundle:ActivityTarget')
                            ->deleteActivityTargetById($activity_target_id_arr, FALSE);
                    if ($delete_success['success'] === false) {
                        throw new \Exception($delete_success['msg']);
                    } else {
                        print(sprintf('&nbsp;&nbsp;- all activity_target record(s) (array(%s)) deleted<br />', implode(',', $activity_target_id_arr)));
                    }
                }
                #Delete document_queue
                if (count($activity_id_arr) > 0) {
                    $delete_success = $this->em
                            ->getRepository('ESERVMAINCommunicationsBundle:DocumentQueue')
                            ->deleteDocumentQueueByActivityId($activity_id_arr, FALSE);
                    if ($delete_success['success'] === false) {
                        throw new \Exception($delete_success['msg']);
                    } else {
                        print(sprintf('&nbsp;&nbsp;- all document_queue record(s) by activity (array(%s)) deleted<br />', implode(',', $activity_id_arr)));
                    }
                }
                #Delete activity
                if (count($activity_id_arr) > 0) {
                    $delete_success = $this->em
                            ->getRepository('ESERVMAINActivityBundle:Activity')
                            ->deleteActivityById($activity_id_arr, FALSE);
                    if ($delete_success['success'] === false) {
                        throw new \Exception($delete_success['msg']);
                    } else {
                        print(sprintf('&nbsp;&nbsp;- all activity record(s) (array(%s)) deleted<br />', implode(',', $activity_id_arr)));
                    }
                }
                #Delete document_job
                $delete_success = $this->em
                        ->getRepository('ESERVMAINCommunicationsBundle:DocumentJob')
                        ->deleteDocumentJobById($doc_job_id, FALSE);
                if ($delete_success['success'] === false) {
                    throw new \Exception($delete_success['msg']);
                } else {
                    print(sprintf('&nbsp;&nbsp;- document_job (%s) deleted<br />', $doc_job_id));
                }
                print('<br />');
            } #foreach ($doc_job_id_arr as $doc_job_id)
            $message = 'Output Documents Communication History successfully deleted';
            $status = true;

            $this->em->getConnection()->commit();
        } catch (\Exception $ex) {
            $this->em->getConnection()->rollBack();

            $error_msg = sprintf(
                    '$document_job_id: array(%s), Exception: %s'
                    , implode(',', $doc_job_id_arr)
                    , $ex->getMessage()
            );
            $this->c->get('db_core_function_services')
                    ->insertMtlError(
                            ($function . '(' . self::SERVICE_NAME . ')')
                            , $error_msg
            );

            $message = 'Error Deleting Output Documents Communication History';
            $status = false;
        }
        $result_arr = array(
            'success' => $status,
            'msg' => $message
        );
    }

#DeleteCommHistory end    

    public function SendEmail(
    $subject
    , $from_email
    , $to_email
    , $body
    , $content_type
    , $attachment = NULL
    ) {
        $function = 'SendEmail';
//$this->log->info(sprintf('%s (ESERVMAINCommunicationsProcesses) start $subject: %s, $from_email: %s, $to_email: %s, $body: %s, $content_type: %s', $function, $subject, $from_email, $to_email, $body, $content_type));

        try {
            $message = \Swift_Message::newInstance();
//            $message->setSubject('Hello Email')
//                    ->setFrom('send@example.com')
//                    ->setTo('guy@millertech.co.uk')
//                    ->setBody('Body of email')
//                    ->setContentType('text/plain')
//            ;
            $message->setSubject($subject)
                    ->setFrom($from_email)
                    ->setTo($to_email)
                    ->setBody($body)
                    ->setContentType($content_type);
//            echo $message->toString(); die;
            $mailer = $this->c->get('mailer');
            $sent = $mailer->send($message);
//$this->log->info(sprintf('%s finished sending the email $sent: %s', $function, $sent));            

            $status = TRUE;
            $message = sprintf('Email successfully sent (%s)', $sent);
        } catch (\Exception $ex) {
            $status = FALSE;
            $message = sprintf('Error sending email - %s', $ex->getMessage());
            $logger = $this->c->get('logger');
            $logger->error($message);
        }

        $res_array = array(
            'success' => $status,
            'msg' => $message
        );
//$this->log->info(sprintf('%s (ESERVMAINCommunicationsProcesses) end success: %s, msg: %s', $function, ($res_array['success'] === TRUE ? 'TRUE' : 'FALSE'), $res_array['msg']));

        return $res_array;
    }

#SendEmail end

    function getMailMergeName($str) {
        return AppConstants::MAIL_MERGE_FIELD_OPEN . $str . AppConstants::MAIL_MERGE_FIELD_CLOSE;
    }

    function getEmailAddress($field_arr, $contact) {
        $email_address = '';

        if (array_key_exists('EmailAddr', $field_arr)) {
            $email = $this->em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Email')->getPrimaryEmailByContact($contact);
            if ($email instanceof \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Email) {
                $email_address = $email->getEmailAddress();
            }
        }

        return $email_address;
    }

#getEmailAddress end

    function WorkplaceAddressCountryDataRequired($field_arr) {
        $required = FALSE;

        if (
                in_array($this->getMailMergeName('WorkplaceCountryCode'), $field_arr) ||
                in_array($this->getMailMergeName('WorkplaceCountryName'), $field_arr)
        ) {
            $required = TRUE;
        }

        return $required;
    }

#end WorkplaceAddressCountryDataRequired

    function WorkplaceAddressDataRequired($field_arr) {
        $required = FALSE;

        if (
                in_array($this->getMailMergeName('WorkplaceAddrFull'), $field_arr) ||
                in_array($this->getMailMergeName('WorkplaceAddr1'), $field_arr) ||
                in_array($this->getMailMergeName('WorkplaceAddr2'), $field_arr) ||
                in_array($this->getMailMergeName('WorkplaceAddr3'), $field_arr) ||
                in_array($this->getMailMergeName('WorkplaceTown'), $field_arr) ||
                in_array($this->getMailMergeName('WorkplaceCounty'), $field_arr) ||
                in_array($this->getMailMergeName('WorkplacePostcode'), $field_arr) ||
                $this->WorkplaceAddressCountryDataRequired($field_arr)
        ) {
            $required = TRUE;
        }

        return $required;
    }

#end WorkplaceAddressDataRequired    

    function WorkplaceDataRequired($field_arr) {
        $required = FALSE;

        if (
                $this->WorkplaceAddressDataRequired($field_arr) ||
                in_array($this->getMailMergeName('WorkplaceName'), $field_arr) ||
                in_array($this->getMailMergeName('WorkplaceCode'), $field_arr)
        ) {
            $required = TRUE;
        }

        return $required;
    }

#end WorkplaceDataRequired

    function EmployerAddressCountryDataRequired($field_arr) {
        $required = FALSE;

        if (
                in_array($this->getMailMergeName('EmployerCountryCode'), $field_arr) ||
                in_array($this->getMailMergeName('EmployerCountryName'), $field_arr)
        ) {
            $required = TRUE;
        }

        return $required;
    }

#end EmployerAddressCountryDataRequired

    function EmployerAddressDataRequired($field_arr) {
        $required = FALSE;

        if (
                in_array($this->getMailMergeName('EmployerAddrFull'), $field_arr) ||
                in_array($this->getMailMergeName('EmployerAddr1'), $field_arr) ||
                in_array($this->getMailMergeName('EmployerAddr2'), $field_arr) ||
                in_array($this->getMailMergeName('EmployerAddr3'), $field_arr) ||
                in_array($this->getMailMergeName('EmployerTown'), $field_arr) ||
                in_array($this->getMailMergeName('EmployerCounty'), $field_arr) ||
                in_array($this->getMailMergeName('EmployerPostcode'), $field_arr) ||
                $this->EmployerAddressCountryDataRequired($field_arr)
        ) {
            $required = TRUE;
        }

        return $required;
    }

#end EmployerAddressDataRequired    

    function EmployerDataRequired($field_arr) {
        $required = FALSE;

        if (
                $this->EmployerAddressDataRequired($field_arr) ||
                in_array($this->getMailMergeName('EmployerName'), $field_arr) ||
                in_array($this->getMailMergeName('EmployerCode'), $field_arr)
        ) {
            $required = TRUE;
        }

        return $required;
    }

#end EmployerDataRequired

    function AddressDataRequired($field_arr) {
        $required = FALSE;

        if (
                in_array($this->getMailMergeName('AddressFull'), $field_arr) ||
                in_array($this->getMailMergeName('AddressLine1'), $field_arr) ||
                in_array($this->getMailMergeName('AddressLine2'), $field_arr) ||
                in_array($this->getMailMergeName('AddressLine3'), $field_arr) ||
                in_array($this->getMailMergeName('AddressTown'), $field_arr) ||
                in_array($this->getMailMergeName('AddressCounty'), $field_arr) ||
                in_array($this->getMailMergeName('AddressPostcode'), $field_arr) ||
                in_array($this->getMailMergeName('AddressCountryName'), $field_arr) ||
                in_array($this->getMailMergeName('AddressCountryCode'), $field_arr)
        ) {
            $required = TRUE;
        }
//        $this->log->info(sprintf('AddressDataRequired (ESERVMAINCommunicationsProcesses) $required is %s', $required === TRUE ? 'TRUE' : 'FALSE'));
//        $this->log->info(sprintf('AddressDataRequired (ESERVMAINCommunicationsProcesses) $field_arr(%s)', implode(',', $field_arr)));
//        foreach ($field_arr as $field) { 
//            $this->log
//                 ->info(sprintf('$field: %s, $this->getMailMergeName(AddressLine1): %s, %s', $field, $this->getMailMergeName('AddressLine1'), array_key_exists($this->getMailMergeName('AddressLine1'), $field_arr) ? 'EXISTS' : 'DOES NOT EXIST')
//                   ); 
//            
//        }

        return $required;
    }

#end AddressDataRequired
}
