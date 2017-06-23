<?php

namespace ESERV\MAIN\ActivityBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use ESERV\MAIN\Services\AppConstants;

class ESERVMAINActivityServices extends Controller {

    private $em;
    private $c;
    private $coreFunction;
    private $dBCoreFunction;

    public function __construct(EntityManager $em, Container $c) {
        $this->em = $em;
        $this->c = $c;
        $this->coreFunction = $this->c->get('core_function_services');
        $this->dBCoreFunction = $this->c->get('db_core_function_services');
        $this->log = $this->c->get('logger');
    }

    //list Activities
    public function ListActivities($type = 'doctrine', $alias = 'p', $query_only = false) {
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                ->from('ESERVMAINActivityBundle:EservVActivity', $alias);

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Activities found-- Function "ListActivities"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }

    //list ListActivitiesByEntityNameIdTarget
    public function ListActivitiesByEntityNameIdTarget($params, $type = 'doctrine', $alias = 'p', $query_only = false) {
        $entity_name = $params['entity_name'];
        $entity_id = $params['entity_id'];
        $target_contact_id = $params['contact_id'];
        $qb = $this->em->createQueryBuilder();

        $result = $qb->select($alias)
                ->from('ESERVMAINActivityBundle:EservVActivity', $alias)
//                ->where($alias . '.entityName = :entity_name')
//                ->andWhere($alias . '.entityId = :entity_id')
                ->where($alias . '.targetContactId = :target_contact_id')
                ->andWhere($alias . '.gotoUrl IS NOT NULL')
//                ->setParameter('entity_name', $entity_name)
//                ->setParameter('entity_id', $entity_id)
                ->setParameter('target_contact_id', $target_contact_id)
                ->orderBy($alias.'.createdAt', 'desc')
                ;

        if (!$result) {
            throw $this->createNotFoundException(
                    'No Activities found for this entity -- Function "ListActivitiesByEntityNameIdTarget"'
            );
        } else {
            if (!$query_only) {
                return $this->coreFunction->GetOutputFormat($result->getQuery(), $type);
            } else {
                return $result;
            }
        }
    }

    /**
     * Name: CreateActivityLetter
     * Purpose: Create an activity for a letter, including all related data for 
     *          the letter, and the background job data to mail merge the letter
     *          The following tables are populated:
     *          - search_query (if for multiple contact records via a SQL query)
     *          - activity
     *          - template_version (if the template has been changed)
     *          - activity_target (1 or more)
     *          - document_queue
     *          - queued_db_process
     *          - queued_db_process_var
     * Returns an array 
     */
    public function CreateActivityLetter($user, $data) {
//$cal_log = $this->c->get('logger'); $cal_log->info(sprintf('CreateActivityLetter (ESERVMAINActivityServices) start', ''));

        try {
            $entity_id = '';
            $entity_name = '';
            $this->em->createQueryBuilder();
            $targets = $data['targets'];
            
            #var_dump($data); die;
            $this->em->getConnection()->beginTransaction();

            $activityCategory = $this->em->getReference('ESERV\MAIN\ActivityBundle\Entity\ActivityCategory', $data['activityCategory']);
            $activity_outstanding_status = $this->em->getReference('ESERV\MAIN\SystemConfigBundle\Entity\SystemCode', $data['status_id']);
            $processed = 'N';
            $message = 'Error creating letter';
            $url = '';
            $status = false;

            if (array_key_exists('temp_ver_edit', $data)) {
                $temp_ver = $this->em->getRepository('ESERVMAINTemplateBundle:TemplateVersion')->createTemplateVersion($this->em, $data['longDescription'], NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $data['templateVersion']);
            } else {
                $temp_ver = $this->em->getReference('ESERV\MAIN\TemplateBundle\Entity\TemplateVersion', $data['templateVersion']);
            }
            $short_descr = $temp_ver->getName();

            if (($data['entityId'] <> '0') && ($data['commsQ'] == '0')) {
                #letter is for a single contact
                $entity_id = $data['entityId'];
                $entity_name = $data['entityName'];
                $contact = $this->em->getRepository('ESERVMAINContactBundle:Contact')->getById($entity_id, array('displayName'));                
                $short_descr = $short_descr . 
                               ' (' . $contact['displayName'] . ')';                
            } else {
                #email is for multiple contact records (via SQL)
                #create data in new tables
                #Hard code now for testing
//                $entity_id = 10810;
//                $entity_name = 'GUY-TEST';
                $sql_query = $this->dBCoreFunction->createSqlwithParameters($data['commsQ']);
                $query_result = json_encode($targets);
                $search_query = $this->em->getRepository('ESERVMAINActivityBundle:SearchQuery')->createSearchQuery($this->em, $sql_query, $query_result);
                if ($search_query instanceof \ESERV\MAIN\ActivityBundle\Entity\SearchQuery) {
                    $entity_id = $search_query->getId();
                    $entity_name = \ESERV\MAIN\Services\AppConstants::QUERY_ENTITY_NAME;
                } else {
                    throw new \Exception('Error creating letter - cannot create query');
                }                            
            }
            $applicationCodeType = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCodeType')->findOneBy(array('code' => AppConstants::AC_ACTIVITY_SOURCE));
            $activitySource = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')->findOneBy(array(
                'applicationCodeType' => $applicationCodeType,
                'code' => AppConstants::AC_ACTSRC_LETTERS,
                ));
            
            $long_descr = $short_descr;
            $activity = $this->em->getRepository('ESERVMAINActivityBundle:Activity')->createActivity(
                    $this->em, $activityCategory, $activity_outstanding_status, NULL, $entity_id, $entity_name, $short_descr, $temp_ver,
                      NULL, NULL,NULL,$long_descr,NULL,0,'N',NULL,NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,$activitySource);
//$cal_log->info(sprintf('CreateActivityLetter $activity.id: %s, %s', $activity->getId(), ($activity instanceof \ESERV\MAIN\ActivityBundle\Entity\Activity) ? 'TRUE' : 'FALSE'));
            if ($activity) {
                foreach ($targets as $key => $value) {
                    $target = $this->em->getRepository('ESERVMAINActivityBundle:ActivityTarget')->createActivityTarget($this->em, $activity, $value);                    
                }
                $document_queue = $this->em->getRepository('ESERVMAINCommunicationsBundle:DocumentQueue')->createDocumentQueue($this->em, $activity, NULL);
                
                $this->em->flush();

                $notification = $this->em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getNotificationStatus(\ESERV\MAIN\Services\AppConstants::SC_NOTIFICATION_PRIORITY_MEDIUM);
                        
                if (array_key_exists('print_now', $data)) {
                    if ($data['print_now'] === '1') {
                        $processed = 'Y';                        
                    }
                }
                if ($processed === 'N') {
//Do not create a background process for this
//                    var_dump($processed); die;
//                    $db_data_arr = array(
//                                       'name' => 'Letter Merge'
//                                      ,'description' => $short_descr
//                                      ,'notif_priority' => $notification
//                                      ,'type' => \ESERV\MAIN\Services\AppConstants::ESERV_MERGE_LETTER
//                                      ,'processed' => $processed
//                    );
//                    $db_vars_data_arr = array(
//                                            'id' => array(
//                                                        'param_ext' => 'PDO::PARAM_STR, -1'
//                                                       ,'param_type' => '1' // SQLT_CHR
//                                                       ,'param_size' => '-1'
//                                                       ,'value' => $activity->getId()
//                                                    )
//                    );
//                    $db_process_services = new \ESERV\MAIN\ExternalBundle\Services\ExternalBundleQueuedDbProcessService($this->em, $this->c);
//                    $queued_db_process_id = $db_process_services->createQueuedDbRecord($db_data_arr, $db_vars_data_arr);
                } #if ($processed === 'N')
            
                $this->em->getConnection()->commit();

                $message = 'Letter Added';
                if ($processed === 'Y') {
                    #Create the PDF
                    $message = 'Letter is being created';
                    if ($activity) {
                        $comm_services = new \ESERV\MAIN\CommunicationsBundle\Services\ESERVMAINCommunicationsProcesses($this->em, $this->c);
                        $result_arr = $comm_services->MergeLetters($activity->getId(), true);
                        if ($result_arr['success'] == TRUE) {
                            $this->em->remove($document_queue);
                            $this->em->flush();
                            
                            $url = $this->c->get('router')
                                           ->generate('eserv_main_activity_view_document'
                                                     ,array(
                                                            'activity_id' => $activity->getId()
                                                           ,'source_contact_id' => $activity->getEntityId()
                                                           )
                                             );
                        } else {
                            $message = $result_arr['msg'];
                        }
                    } else {
                        $message = 'Error creating letter (PDF)';
                    }
                }
                $status = true;
            } #if ($activity)
            #$this->log->info(sprintf('CreateActivityEmail(ESERVMAINActivityServices) id: %s, entity_id: %s, $url: %s', $activity->getId(), $activity->getEntityId(), $url));

            $result = array(
                'status' => $status,
                'message' => $message,
                'url' => $url
            );
//$cal_log->info(sprintf('CreateActivityLetter (ESERVMAINActivityServices) end', ''));            
        } catch (\Exception $e) {
            $this->em->getConnection()->rollBack();
            $result = array(
                'status' => false,
                'message' => $e->getMessage(),
                'url' => ''
            );
        }

        return $result;
    } #CreateActivityLetter end

    /**
     * Name: CreateActivityEmail
     * Purpose: Create an activity for a email, including all related data for 
     *          the email, and the background job data to send the email
     *          The following tables are populated:
     *          - search_query (if for multiple contact records via a SQL query)
     *          - activity
     *          - template_version (if the template has been changed)
     *          - activity_target (1 or more)
     *          - activity_email (1 or more)
     *          - update media_store (if there are any attachments)
     *          - queued_db_process
     *          - queued_db_process_var
     * Returns an array 
     */
    public function CreateActivityEmail($user, $data) {
        $create_background_task = FALSE;
        $targets = array();
        $result = array();
        
        $this->em->createQueryBuilder();
        try {
            #print_r($data); die;
            $this->em->getConnection()->beginTransaction();

            $activityCategory = $this->em->getReference('ESERV\MAIN\ActivityBundle\Entity\ActivityCategory', $data['activityCategory']);
            #print('$data[status_id]: ' . $data['status_id']); die;
            $activity_outstanding_status = $this->em->getReference('ESERV\MAIN\SystemConfigBundle\Entity\SystemCode', $data['status_id']);

            if (array_key_exists('temp_ver_edit', $data)) {
                $temp_ver = $this->em->getRepository('ESERVMAINTemplateBundle:TemplateVersion')->createTemplateVersion($this->em, $data['longDescription'], NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $data['templateVersion']);                
            } else {
                $temp_ver = $this->em->getReference('ESERV\MAIN\TemplateBundle\Entity\TemplateVersion', $data['templateVersion']);
            }
            $temp_ver_name = $temp_ver->getName();
            $recipientName = '';
            
            if (($data['entityId'] <> '0') && ($data['commsQ'] == '0')) {
                #email is for a single contact
                $targets = array($data['entityId']);
                $entity_id = $data['entityId'];
                $entity_name = $data['entityName'];
                $contact = $this->em->getRepository('ESERVMAINContactBundle:Contact')->getById($entity_id, array('displayName'));
                $recipientName = ' (' . $contact['displayName'] . ')'; 
            } else {
                #email is for multiple contact records (via SQL)
                $sql_query = $this->dBCoreFunction->createSqlwithParameters($data['commsQ']);
                $c_id_arr = $this->dBCoreFunction->runRawSqlMultiCondition($data['commsQ']); #var_dump($c_id_arr); die;            
                foreach ($c_id_arr as $key => $value) {
                    foreach ($value as $k => $v) {
                        $targets[] = $v;
                    }
                }
                #$query_result = json_encode($targets);
                $query_result = json_encode($c_id_arr);
                $search_query = $this->em->getRepository('ESERVMAINActivityBundle:SearchQuery')->createSearchQuery($this->em, $sql_query, $query_result);
                if ($search_query instanceof \ESERV\MAIN\ActivityBundle\Entity\SearchQuery) {
                    $entity_id = $search_query->getId();
                    $entity_name = \ESERV\MAIN\Services\AppConstants::QUERY_ENTITY_NAME;
                } else {
                    throw new \Exception('Error queuing email for sending - cannot create query');
                }
            }
            
            $applicationCodeType = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCodeType')->findOneBy(array('code' => AppConstants::AC_ACTIVITY_SOURCE));
            $activitySource = $this->em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')->findOneBy(array(
                'applicationCodeType' => $applicationCodeType,
                'code' => AppConstants::AC_ACTSRC_EMAIL,
                ));
            $longDescription = $data['shortDescription'] . ' ' . $temp_ver_name . ' ' . $recipientName;
            $activity = $this->em->getRepository('ESERVMAINActivityBundle:Activity')->createActivity($this->em, $activityCategory, $activity_outstanding_status, NULL, $entity_id, $entity_name, $data['shortDescription'], $temp_ver,
                      NULL, NULL,NULL,$longDescription,NULL,0,'N',NULL,NULL,'N',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,$activitySource);            
            if ($activity) {
                $email_status = $this->em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getActivityQueuedSendingStatus();
                
                foreach ($targets as $key => $value) {
//$this->log->info(sprintf('CreateActivityEmail(ESERVMAINActivityServices) $value: %s (contact.id)', $value));                    
                    $contact = $this->em->getReference('ESERV\MAIN\ContactBundle\Entity\Contact', $value);
                    
                    $contact_email = $this->em
                                          ->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVContactEmail')
                                          ->getPrimaryByContactId(
                                                $contact->getId()
                                               ,array('emailAddress')); 
                    if (is_null($contact_email['emailAddress'])) {
                        #The contact does not have an email address so do not
                        #create activity_target and activity_email
                        #May want to record somewhere that the email to the 
                        #contact cannot be sent
                        $this->log->info(sprintf('Cannot create activity_target and activity_email as no primary email address exists for contact.id: %s in CreateActivityEmail(ESERVMAINActivityServices)', $value));
                    } else {
                        $create_background_task = TRUE;
                        $target = $this->em
                                       ->getRepository('ESERVMAINActivityBundle:ActivityTarget')
                                       ->createActivityTarget(
                                             $this->em
                                            ,$activity
                                            ,$contact
                                         );
                        $activity_email = $this->em
                                               ->getRepository('ESERVMAINActivityBundle:ActivityEmail')
                                               ->createActivityEmail(
                                                     $target
                                                    ,$email_status
                                                    ,new \DateTime()
                                                    ,$this->c->getParameter('merlin_emailing_from_email')
                                                    ,$contact_email['emailAddress']
                                                    ,$data['shortDescription']
                                                    ,$this->em
                                                 );
                    }
                } #foreach ($targets as $key => $value)

                if ($create_background_task) {
                    #At least one activity_target and activity_email has been 
                    #created
                    #print('$data[attachment]: ' . $data['attachment'] . ', activity.id: ' . $activity->getId()); die;
                    #$attach_arr = str_replace(' ', '', explode(',', $data['attachment']));
                    $attach_arr = (str_replace(' ', '', $data['attachment'] == '')) ? array() : explode(',', $data['attachment']);
#Check why the update below is being done even when there is no attachment
//$this->log->info(sprintf('CreateActivityEmail (ESERVMAINActivityServices) count($attach_arr): %s, $attach_arr: (%s)', count($attach_arr), implode(',', $attach_arr)));
                    if (count($attach_arr) > 0) {
//                        $folder = $this->c->getParameter('attachments_base_folder'); 
//                        if (file_exists($folder)) {
//                            $folder = $folder . '\\' . ((string) $activity->getId()) . '\\'; #
//                            $file_arr = glob("$folder*.*");
//                            if (count($file_arr) > 1) {
//                                foreach ($file_arr as $file) {
//                                    unlink($file);
//                                }                                
//                                rmdir($folder);
//                            } 
//                            mkdir($folder);
//                            $media_store_arr = $this->em->getRepository('ESERVMAINMediaBundle:MediaStore')->getById($attach_arr);
//                            foreach ($media_store_arr as $media_store) {
//                                file_put_contents($folder . $media_store->getFileName(), $media_store->getContent());
////Delete media_store when sending out the email
////                                if (file_exists($folder . $media_store->getFileName())) {
////                                    #delete the media_store record
////                                }
//                            } #foreach ($media_store_arr as $media_store) end
//                        } else {
//                            throw new \Exception(sprintf('Error in email attachment configuration'));
//                        }
                        $update_media_store = $this->em->getRepository('ESERVMAINMediaBundle:MediaStore')->updateById($attach_arr, $activity->getId(), 'Activity');
                    }
                    $notification = $this->em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getNotificationStatus(\ESERV\MAIN\Services\AppConstants::SC_NOTIFICATION_PRIORITY_MEDIUM);
                    $db_data_arr = array(
                                       'name' => 'Send Email'
                                      ,'description' => $data['shortDescription']
                                      ,'notif_priority' => $notification
                                      ,'type' => \ESERV\MAIN\Services\AppConstants::ESERV_SEND_EMAIL
                    );
                    $db_vars_data_arr = array(
                                            'id' => array(
                                                        'param_ext' => 'PDO::PARAM_STR, -1'
                                                       ,'param_type' => '1' // SQLT_CHR
                                                       ,'param_size' => '-1'
                                                       ,'value' => $activity->getId()
                                                    )
                    );
                    $db_process_services = new \ESERV\MAIN\ExternalBundle\Services\ExternalBundleQueuedDbProcessService($this->em, $this->c);
                    $queued_db_process_id = $db_process_services->createQueuedDbRecord($db_data_arr, $db_vars_data_arr);
                } #if ($create_background_task)
            } #if ($activity)
            $this->em->flush();

            if ($create_background_task) {
                #At least one activity_target and activity_email has been 
                #created
                $this->em->getConnection()->commit();
                $result = array(
                    'status' => true,
                    'message' => 'Email queued for sending',
                );
            } else {
                $this->em->getConnection()->rollBack();   
                $result = array(
                    'status' => false,
                    'message' => 'Email cannot be queued for sending as no valid email address exists',
                );
            }
        } catch (\Exception $e) {
            $this->em->getConnection()->rollBack();
            $result = array(
                'status' => false,
                'message' => $e->getMessage(),
            );
        }

        return $result;
    } #CreateActivityEmail end

    public function prepareTemplateContentPerTarget($activity_id, $target_contact_id)
    {
        $status = false;
        if(isset($activity_id) && isset($target_contact_id)){
            $em = $this->em;
            $act_temp_content_dql = $em->createQueryBuilder()
                    ->select('tv.content', 'ac.code')
                    ->from('ESERVMAINActivityBundle:Activity', 'a')
                    ->leftJoin('a.templateVersion', 'tv')
                    ->leftJoin('a.activityCategory', 'ac')
                    ->where('a.id = :aid')
                    ->setParameter('aid', $activity_id)
                    ->getQuery()
                    ->getArrayResult()
            ;

            if(sizeof($act_temp_content_dql) > 0){

                $act_target = $em->getRepository('ESERVMAINActivityBundle:ActivityTarget')->findOneBy(array(
                                'activity' => $activity_id,
                                'contact' => $target_contact_id
                            )   
                );            
                $act_merge_data = $em->getRepository('ESERVMAINActivityBundle:ActivityMergeData')->findOneBy(array(
                                'activityTarget' => $act_target,
                            )   
                );

                $act_temp_content = $act_temp_content_dql[0]['content'];
                
                if($act_merge_data){
                    $new_sep = 'Q$^';
                    $merge_fields = explode(',', $act_merge_data->getMergeFields());
                    //$merge_data = explode(',', str_replace('"', '', $act_merge_data->getMergeData())); does not cater for data that has a comma in
                    $merge_data = str_replace(',"', $new_sep, $act_merge_data->getMergeData());
                    $merge_data = str_replace('"', '', $merge_data);
                    $merge_data = str_replace('full_address_area', '"full_address_area"', $merge_data);
                    $merge_data = explode($new_sep, $merge_data);
                    //var_dump($merge_data); die;

                    $act_temp_content_modified = str_replace(
                            $merge_fields, 
                            $merge_data, 
                            $act_temp_content
                    );
                    $temp_content_remove_braces = preg_replace('/{([^}]*)}/', ' - ', $act_temp_content_modified);
                    $web_folder = $this->c->get('kernel')->getRootDir() . '/../web/';
                    $css_file = $web_folder . 'common/assets/libs/merlin/css/mtl_ckeditor.css';
                    $css_contents = '<style type="text/css">' . file_get_contents($css_file) . '</style>';                                       
                    $temp_content_remove_braces = '' . $css_contents . $act_temp_content_modified . '';                    
                    $msg = $temp_content_remove_braces;
//$this->log->info(sprintf('prepareTemplateContentPerTarget $msg: %s', $msg));
                }else{
                    $msg = $act_temp_content;
                }
                
                if($act_temp_content_dql[0]['code'] == AppConstants::ACTCAT_TEACHER_EMAIL){
                    $tmp1 = 'ATTACHMENTS<br/>';
                    $ms_service = new \ESERV\MAIN\MediaBundle\Services\MediaBundleMediaStoreService($em, $this->c);
                    
                    $files = $ms_service->getMultipleRowsByEntityNameAndEntityId(AppConstants::ENTITY_NAME_ACTIVITY, $activity_id);                    
                    if($files != false){
                        foreach($files as $file){
                            $tmp1 .= $file->getFileName() . '<br/>';
                        }
                        $msg .= $tmp1;     
                    }                                   
                }
                $status = true;
            }else{
                $msg = 'No Activity / Template record found for the given activity id!!';
            }
        }else{
            $msg = 'Activity ID or Target Contact ID or both is missing.';
        }
        
        return array(
            'status' => $status,
            'msg' => $msg
        );
    }
    
    public function getTeacherNotes($param) {
        $entityId = array_key_exists('entity_id', $param) ? $param['entity_id'] : null;
        $teacher_notes = array();
        if($entityId){
            $em = $this->em;
            $teacherNotes = $em->createQueryBuilder()
                    ->select('a')
                    ->from('ESERVMAINActivityBundle:Activity', 'a')
                    ->leftJoin('a.activityCategory', 'ac')
                    ->where('ac.code = :acCode')
                    ->setParameter('acCode', \ESERV\MAIN\Services\AppConstants::ACTCAT_TEACHER_NOTE)
                    ->andWhere('a.showAlert = \'Y\'')
                    ->andWhere('a.entityId = :eId')
                    ->setParameter('eId', $entityId)
                    ->orderBy('a.createdAt', 'DESC')
                    ->getQuery()
                    ->getResult()
                    ;
            if (count($teacherNotes) > 0) {
                $posStart = 0;
                $maxLength = 35;
                foreach ($teacherNotes as $key => $value) {
                    
                    //checking for £ symbol at the moment and increasing the maxLenght by one to avoid code break
                    //and resulting malformed utf-8 encoding issues.
                    //http://www.mtl.uk.net/pls/logsheets/wwv_logsheet.show_log?p_log_id=9044846
                    //however we need to handle all characters/symbols which will cause the page to break
//                    $posOfLastPoundSymbol = strrpos($value->getLongDescription(), '£');
                    
                    $pattern = '/£/';                    
                    preg_match_all($pattern, $value->getLongDescription(), $result, PREG_OFFSET_CAPTURE);                    
                    if(count($result) != 0){
                        foreach($result[0] as $k => $v){
                            if(($maxLength-1) == $v[1]){
                                $maxLength += 1;
                            }
                        }
                    }
                    
                    $teacher_note = array(
                        'id' => $value->getId(),
                        'title' => $value->getShortDescription(),
                        'description' => $value->getLongDescription(),
                        'short_description' => substr($value->getLongDescription(),$posStart,$maxLength),
                        'created_at' => $value->getCreatedAt() ? $value->getCreatedAt()->format('d/m/Y') : '',
                        'show_alert' => $value->getShowAlert() == 'Y' ? false : true,
                    );
                    array_push($teacher_notes, $teacher_note);
                }
            } 
        }
        return $teacher_notes;
    }
    
    public function getLongOutstandingEmail() {
        return $this->em->createQueryBuilder()
                ->select('a.id As activityId', 'a.shortDescription', 'a.longDescription', 'a.createdAt', 'a.createdBy', 'p.id AS person_id', 'p.referenceNo', 'p.niNumber', 'c.id AS contact_id', 'c.displayName', 'ae.toEmailAddress')
                ->from('ESERVMAINActivityBundle:ActivityTarget', 'at')
                ->innerJoin('ESERVMAINActivityBundle:ActivityEmail', 'ae' , 'with', 'ae.activityTarget = at.id')
                ->innerJoin('at.activity', 'a')
                ->innerJoin('ESERVMAINSecurityBundle:User', 'u', 'with', 'u.id = a.createdBy')
                ->innerJoin('a.activityCategory', 'acat')
                ->leftJoin('acat.activityType', 'atype')
                ->leftJoin('a.status', 'sc1')
                ->leftJoin('sc1.systemCodeType', 'sct1')
                ->leftJoin('ae.emailStatusSystemCode', 'sc2')
                ->leftJoin('sc2.systemCodeType', 'sct2')
                ->leftJoin('ESERVMAINContactBundle:Person', 'p', 'with', "p.contact = at.contact")
                ->leftJoin('ESERVMAINContactBundle:Contact', 'c', 'with', "c.id = at.contact")
                ->where('sct1.code = :astcode AND sct2.code= :estcode ')
                ->setParameter('astcode', \ESERV\MAIN\Services\AppConstants::SCT_ACTIVITY_STATUS_CODE )
                ->setParameter('estcode', \ESERV\MAIN\Services\AppConstants::SCT_ACTIVITY_EMAIL_STATUS_CODE )
                ->andWhere('sc1.code = :ascode AND sc2.code = :escode')
                ->setParameter('ascode', \ESERV\MAIN\Services\AppConstants::SC_ACTIVITY_STATUS_OUTSTANDING_CODE )
                ->setParameter('escode', \ESERV\MAIN\Services\AppConstants::SC_ACTIVITY_EMAIL_STATUS_SENDING_CODE )
                ->andWhere('atype.code = :atCode AND acat.code =:acatCode')
                ->setParameter('atCode', \ESERV\MAIN\Services\AppConstants::AT_OUTBOUND_EMAIL_CODE )
                ->setParameter('acatCode', \ESERV\MAIN\Services\AppConstants::ACTCAT_TEACHER_EMAIL )
                ->orderBy('a.createdBy')
                ->addOrderBy('a.id')
                ->getQuery()
                ->getResult()
        ;
    }
    
    public function formatFailedEmailNotification($activity) {
        $email_arr = array();
        $prev_created_by = 0;
        $prev_activity_id = 0;
        $email_str = 'Empty';
        $display_created_at = '';
        
        $time = ($this->c->hasParameter('email_fail_notify_time') ? $this->c->getParameter('email_fail_notify_time') : '30 min');
        $before_date_time = date('Y-m-d H:i:s', strtotime('- ' . $time));
        if (count($activity) > 0) {
            foreach ($activity as $key => $value) {
                $created_at = ($value['createdAt'] ? $value['createdAt']->format('Y-m-d H:i:s') : '');
                $display_created_at = ($value['createdAt'] ? $value['createdAt']->format('d/m/Y H:i') : '');
                if ($created_at < $before_date_time) {
                    $activity_id = $value['activityId'];
                    $created_by = $value['createdBy'];
                    if ($prev_created_by != $created_by) {
                        if ($prev_created_by != 0) {
                            $email = array(
                                         'activity_id' => $prev_activity_id
                                        ,'user_id' => $prev_created_by
                                        ,'description' => $email_str
                                     );
                            array_push($email_arr, $email);
                        } #if ($prev_created_by != 0)
                        
                        $prev_created_by = $created_by;
                        $prev_activity_id = $activity_id;
                        $email_str = sprintf(
                                         'Activity ID: %s created at %s (Subject: %s)'
                                        ,$activity_id
                                        ,$display_created_at
                                        ,$value['shortDescription']
                                     );
                    }
                    if ($prev_activity_id != $activity_id) {
                        $email_str = $email_str .
                                     sprintf(
                                         '<br /><br />Activity ID: %s created at %s (Subject: %s)'
                                        ,$activity_id
                                        ,$display_created_at
                                        ,$value['shortDescription']
                                     );
                        $prev_activity_id = $activity_id;
                    }
                    $email_to = sprintf(
                                    '<br /> - Email: %s, %s'
                                   ,$value['toEmailAddress']
                                   ,$value['displayName']
                                );
                    if (empty($value['person_id'])) {
                    } else {
                        #$email_to = $email_to . (empty($value['referenceNo']) ? $value['niNumber'] : $value['referenceNo']);
                        $email_to = sprintf(
                                        '%s(%s)'
                                       ,$email_to
                                       ,(empty($value['referenceNo']) ? $value['niNumber'] : $value['referenceNo'])
                                    );
                    }
                    $email_str = $email_str . $email_to;
                } #if ($created_at < $before_date_time)
            } #foreach ($activity as $key => $value)
            if ($email_str != 'Empty') {
                $email = array(
                             'activity_id' => $prev_activity_id
                            ,'user_id' => $prev_created_by
                            ,'description' => $email_str
                         );
                array_push($email_arr, $email);                
            }
        } #if (count($activity) > 0)
        
        return $email_arr;
    } #formatFailedEmailNotification
    
}
