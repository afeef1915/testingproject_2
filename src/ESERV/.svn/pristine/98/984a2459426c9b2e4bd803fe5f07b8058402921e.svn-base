<?php

namespace ESERV\MAIN\ActivityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ESERV\MAIN\Services\DataTables;

class ActivityController extends Controller {

    public $activity_columns;
    public $activity_table_id = 'eserv_v_activity_table';

    public function __construct() {
        $this->activity_columns = array(
            'activityId' => array(
                'activityId',
                'options' => array(
                    'header' => 'ID',
                    'width' => '80px',
                    'css_class' => 'center hide_for_mobile dt-activity-id',
                )
            ),
            'activityTypeCode' => array(
                'activityTypeCode',
                'options' => array(
                    'header' => 'Activity Type Code',
                    'width' => '110px',
                    'css_class' => 'center hide dt-act-type-code',
                )
            ),
            'activityCategory' => array(
                'activityCategory',
                'options' => array(
                    'header' => 'Category',
                    'width' => '110px',
                    'css_class' => 'center',
                )
            ),
            'shortDescription' => array(
                'shortDescription',
                'options' => array(
                    'header' => 'Description',
                )
            ),
            'sourceContact' => array(
                'sourceContact',
                'options' => array(
                    'header' => 'User',
                    'width' => '110px',
                    'css_class' => 'center',
                )
            ),
            'status' => array(
                'status',
                'options' => array(
                    'header' => 'Status',
                    'width' => '60px',
                    'css_class' => 'center dt-status',
                )
            ),
            'targetContactId' => array(
                'targetContactId',
                'options' => array(
                    'header' => 'Contact ID',
                    'width' => '80px',
                    'visible' => false,
                    'css_class' => 'center hide_for_mobile',
                )
            ),
            'id' => array(
                'id',
                'options' => array(
                    'header' => 'ID 22',
                    'width' => '80px',
                    'visible' => false,
                    'css_class' => 'center hide_for_mobile',
                )
            ),            
//            'userDepartment' => array(
//                'userDepartment',
//                'options' => array(
//                    'header' => 'User Department',
//                    'width' => '110px',
//                    'css_class' => 'center',
//                )
//            ),
//            'statusDateTime' => array(
//                'statusDateTime',
//                'col_type' => 'date',
//                'options' => array(
//                    'header' => 'Status Date',
//                    'width' => '120px',
//                    'css_class' => 'center hide_for_mobile',
//                )
//            ),
            'createdAt' => array(
                'createdAt',
                'col_type' => 'date',
                'options' => array(
                    'header' => 'Date Created',
                    'width' => '120px',
                    'css_class' => 'center hide_for_mobile',
                )
            ),
            'details_btn' => array(
                'type' => 'details_modal',
                #'url' => 'activity/[[goto_url]]/edit/[[id]]',
                'url' => 'activity/[[goto_url]]/view/[[id]]/[[targetContactId]]',
                'url_show_when' => array(
                    'condition' => array('[[status]]' => 'Complete'),
                    'label_to_show' => '<i class="fa fa-times"></i> Not available'
                ),
                'url_params' => array(
                    'id' => 'activityId',
                    'targetContactId' => 'targetContactId',
                    'goto_url' => 'gotoUrl',
                    'status' => 'status'
                ),
                
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">View</span>',
                'modal_attr' => array(
                    'title' => 'Activity Details',                    
                ),
                'options' => array(
                    'header' => 'View',
                    'width' => '120px',
                    'css_class' => 'center dt-view',
                    'sortable' => false,
                )
            ),
        );
    }

    public function activitiesListAction(Request $request) {
        
//        $baseurl = $this->container->get('router')->getContext()->getBaseUrl();

//        $this->activity_columns['details_btn'] = array(
//            'type' => 'download_link',
//            'url' => $baseurl . '/../tmp/print_queue/[[status]]/file_[[fileId]].pdf',
//            'title_text' => '<i class="fa fa-file-pdf-o"></i> Preview',
//            'container_id' => $this->activity_table_id,
//            'url_params' => array(
//                'fileId' => 'activityId',
//                'status' => 'status'
//            ),
//            'options' => array(
//                'header' => 'Preview',
//                'width' => '90px',
//                'css_class' => 'center',
//                'sortable' => false
//            )
//        );
        
        $entity_name = $request->get('entity_name');
        $entity_id = $request->get('entity_id');
        $contact_id = $request->get('contact_id');
        $activity_columns = DataTables::formatDataTablesColumnsArray($this->activity_columns);
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->activity_table_id, array(
            'columns' => $activity_columns,           
            'source_url' => $this->container->get('router')->generate('eserv_main_activity_ajax_list', array(
                'entity_name' => $entity_name,
                'entity_id' => $entity_id,
                'contact_id' => $contact_id
            )),
            'initial_sorting_column' => array(
                'column' => 8,
                'direction' => 'desc'
            ),
            'row_callback' => 'formatStatus(row, data, 5);eservActivityTableRowCallBackFunc(row);',
            'draw_callback' => 'bindResendFunctionality();',
        ));

        return $this->render('ESERVMAINActivityBundle:Default:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'table_id' => $this->activity_table_id,
        ));
    }

    public function dataAction(Request $request) {
        
//        $baseurl = $this->container->get('router')->getContext()->getBaseUrl();

//        $this->activity_columns['details_btn'] = array(
//            'type' => 'download_link',
//            'url' => $baseurl . '/../tmp/print_queue/[[status]]/file_[[fileId]].pdf',
//            'title_text' => '<i class="fa fa-file-pdf-o"></i> Preview',
//            'container_id' => $this->activity_table_id,
//            'url_params' => array(
//                'fileId' => 'activityId',
//                'status' => 'status'
//            ),
//            'options' => array(
//                'header' => 'Preview',
//                'width' => '90px',
//                'css_class' => 'center',
//                'sortable' => false
//            )
//        );
        
        $entity_name = $request->get('entity_name');
        $entity_id = $request->get('entity_id');
        $contact_id = $request->get('contact_id');

        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\MAIN\ActivityBundle\Services\ESERVMAINActivityServices',
                    'function_name' => 'ListActivitiesByEntityNameIdTarget',
                    'function_params' => array(
                        'entity_name' => $entity_name,
                        'entity_id' => $entity_id,
                        'contact_id' => $contact_id
                    )
                )
            ),
            'columns' => $this->activity_columns,
            'index_col' => 'id',
            'table_id' => $this->activity_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data, array(), array(
            'table_id' => $this->activity_table_id
        ));

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }

    public function editActivityAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $activity = $em->getRepository('ESERVMAINActivityBundle:Activity')->find($id);
        $action_url = $this->generateUrl('eserv_main_activity_update');

        if (!$activity) {
            throw $this->createNotFoundException('Unable to find activity.');
        }

        //Activity email can not be edited.
        $activity_type_id = $activity->getActivityCategory()->getActivityType()->getId();

        $activity_type_edit_allowed = $this->activityTypeEditAllowed($activity_type_id);
        if (!$activity_type_edit_allowed['activity_type_edit_allowed']) {
            return $this->render('ESERVMAINActivityBundle:Default:editNotAllowed.html.twig', array('msg' => $activity_type_edit_allowed['msg']));
        }

        $status_edit_allowed = $this->statusEditAllowed($activity_type_id);
        $activity_edit_allowed = $this->activityEditAllowed($activity);
        $display_reminders = $activity->getActivityCategory()->getNoOfReminders() ? TRUE : FALSE;
        $has_reminder = $activity->getNoOfReminders() ? TRUE : FALSE;
        $entity_closed = FALSE;

        $sub_cats = $em->getRepository('ESERVMAINActivityBundle:ActivitySubCategory')->getSubCategoriesByCategoryId($activity->getActivityCategory()->getId());
        $show_sub_cats = (count($sub_cats) > 0) ? TRUE : FALSE;
        switch ($activity->getActivityCategory()->getActivityType()->getId()) {
            #smilar to cieh
            case 'phone ... id':
                echo 'activity phone form';
                break;
            case 'letter .. id':
                echo 'activity letter form';
                break;
            default:
                $editForm = $this->createForm(new \ESERV\MAIN\ActivityBundle\Form\ActivityType(), $activity, array(
                    'action' => $action_url . '/' . $id,
                    'attr' => array(
                        'class' => 'eserv_form form-horizontal eserv_form_editable'),
                    'params' => array(
                        'activity_edit_allowed' => $activity_edit_allowed,
                        'entity_closed' => $entity_closed,
                        'status_edit_allowed' => $status_edit_allowed,
                        'has_reminder' => $has_reminder),
                ));
        }

        return $this->render('ESERVMAINActivityBundle:Default:edit.html.twig', array(
                    'form' => $editForm->createView(),
        ));
    }

    private function activityTypeEditAllowed($activity_type_id) {
        $em = $this->getDoctrine()->getManager();
        $activity_type_edit_allowed = TRUE;
        $msg = '';
        $outbound_email_activity_type_id = $em->getRepository('ESERVMAINActivityBundle:ActivityType')->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::AT_OUTBOUND_EMAIL_CODE))->getId();
        //Outbound Emails can not be edited.
        # $outbound_email_activity_type_id = 2;
        if ($activity_type_id == $outbound_email_activity_type_id) {
            $msg = 'Emails can not be edited.';
            $activity_type_edit_allowed = FALSE;
        }
        return array('activity_type_edit_allowed' => $activity_type_edit_allowed, 'msg' => $msg);
    }

    private function statusEditAllowed($activity_type_id) {
        $em = $this->getDoctrine()->getManager();
        $status_edit_allowed = FALSE;
        $letter_activity_type_id = $em->getRepository('ESERVMAINActivityBundle:ActivityType')->findOneBy(array('code' => \ESERV\MAIN\Services\AppConstants::AT_LETTER_CODE))->getId();
        if ($activity_type_id == $letter_activity_type_id) {
            $status_edit_allowed = FALSE; // If activity type is letter then Status will only change to complete when letter is printed
        } else {
            $status_edit_allowed = TRUE;
        }
        return $status_edit_allowed;
    }

    private function activityEditAllowed($activity) {
        $em = $this->getDoctrine()->getManager();
        $edit_allowed = TRUE;

        $activity_completed_status = $em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')
                ->getBySystemCodeTypeAndCode(\ESERV\MAIN\Services\AppConstants::SCT_ACTIVITY_STATUS_CODE, \ESERV\MAIN\Services\AppConstants::SC_ACTIVITY_STATUS_COMPLETE_CODE);
        $activity_completed_status_id = $activity_completed_status ? $activity_completed_status->getId() : null;
        if ($activity->getStatus()->getId() == $activity_completed_status_id) {
            $edit_allowed = FALSE;
        } else {
            $edit_allowed = TRUE;
        }
        return $edit_allowed;
    }
    
    // Sampe update function        
    public function updateActivityAction($id, Request $request) 
    {   
        $status = false;
        $result = array();
        $errors_array = array();
        $message = '';
        $em = $this->getDoctrine()->getManager();

        try {
            $em->getConnection()->beginTransaction();

            if ($request->isMethod('POST')) {

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
    
    // Activity Note edit action
    public function editActivityNoteAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $activity = $em->getRepository('ESERVMAINActivityBundle:Activity')->find($id);
        $action_url = $this->generateUrl('eserv_main_activity_note_update');

        if (!$activity) {
            throw $this->createNotFoundException('Unable to find activity.');
        }               

        $status_edit_allowed =  TRUE;
        $activity_edit_allowed = $this->activityEditAllowed($activity);
        $display_reminders = $activity->getActivityCategory()->getNoOfReminders() ? TRUE : FALSE;
        $has_reminder = $activity->getNoOfReminders() ? TRUE : FALSE;
        $entity_closed = FALSE;

        $sub_cats = $em->getRepository('ESERVMAINActivityBundle:ActivitySubCategory')->getSubCategoriesByCategoryId($activity->getActivityCategory()->getId());
        $show_sub_cats = (count($sub_cats) > 0) ? TRUE : FALSE;

        $editForm = $this->createForm(new \ESERV\MAIN\ActivityBundle\Form\ActivityNoteType(), $activity, array(
            'action' => $action_url . '/' . $id,
            'attr' => array(
                'class' => 'eserv_form form-horizontal'),            
            'params' => array(                
                 
                ),           
        ));

        return $this->render('ESERVMAINActivityBundle:Default:edit_activity_note_details.html.twig', array(
                    'form' => $editForm->createView(),
                    'activity_id' => $id
        ));
    }
    
    // Activity Note view action
    public function viewActivityNoteAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $activity = $em->getRepository('ESERVMAINActivityBundle:Activity')->find($id);
        $action_url = $this->generateUrl('eserv_main_activity_note_update');
        $target_contact_id = $request->get('target_contact_id');
        

        if (!$activity) {
            throw $this->createNotFoundException('Unable to find activity.');
        }

        $status_edit_allowed =  TRUE;
        $activity_edit_allowed = $this->activityEditAllowed($activity);
        $display_reminders = $activity->getActivityCategory()->getNoOfReminders() ? TRUE : FALSE;
        $has_reminder = $activity->getNoOfReminders() ? TRUE : FALSE;
        $entity_closed = FALSE;

        $sub_cats = $em->getRepository('ESERVMAINActivityBundle:ActivitySubCategory')->getSubCategoriesByCategoryId($activity->getActivityCategory()->getId());
        $show_sub_cats = (count($sub_cats) > 0) ? TRUE : FALSE;
        
        $editForm = $this->createForm(new \ESERV\MAIN\ActivityBundle\Form\ActivityNoteType(), $activity, array(
            'action' => $action_url . '/' . $id. '/'.$target_contact_id,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'params' => array(
                'activity_edit_allowed' => $activity_edit_allowed,
                'entity_closed' => $entity_closed,
                'status_edit_allowed' => $status_edit_allowed,
                'has_reminder' => $has_reminder),
        ));
        
        $noteCreatedUserId = $activity->getCreatedBy();
        $loggedInUserId = $this->get('security_services')->getFosUserId();
        $createdByUserName = $em->getRepository('ESERVMAINSecurityBundle:User')->findOneBy(array('id' => $noteCreatedUserId));
        $lineBreaks = substr_count($activity->getLongDescription(), "\n") + 1;
        $lineBreaks = ($lineBreaks > 10) ? 10 : $lineBreaks;
        
        if($noteCreatedUserId && ($noteCreatedUserId == $loggedInUserId)){
            return $this->render('ESERVMAINActivityBundle:Default:edit_activity_note_details.html.twig', array(
                'form' => $editForm->createView(),
                'activity_id' => $id,
            ));
        }else{
            return $this->render('ESERVMAINActivityBundle:Default:show_activity_note_details.html.twig', array(
                        'form' => $editForm->createView(),
                        'createdByUserName' => $createdByUserName ? $createdByUserName->getUsername() : '',
                        'activity_source_name' => $activity->getActivitySource() ? $activity->getActivitySource()->getName() : '',
                        'line_breaks' => $lineBreaks,
                        'show_alert' => $activity->getShowAlert()
            ));
        }
    }
    
    public function updateActivityNoteAction($id, Request $request) 
    {           
        $status = false;
        $result = array();
        $errors_array = array();
        $message = '';
        $em = $this->getDoctrine()->getManager();           
        
        try {
            $em->getConnection()->beginTransaction();                    
            $activity_note = $em->getRepository('ESERVMAINActivityBundle:Activity')->find($id);            
            $activity_note_form = $this->createForm(new \ESERV\MAIN\ActivityBundle\Form\ActivityNoteType(), $activity_note, array(
                                    'attr' => array(
                                         'class' => 'eserv_form form-horizontal eserv_form_editable'),                                    
                                    'params' => array(                                         

                                        ),
                                ));
        

            if ($request->isMethod('POST')) {
                $activity_note_form->bind($request);
                if ($activity_note_form->isValid()) {                    
                    $em->flush();                    
                    $em->getConnection()->commit();
                    $status = true;
                    $message = 'Activity note successfully updated!';
                } else {                    
                    $message = 'Form is invalid';                   
                    $errors_array = $this->container->get('core_function_services')->getEservFormErrors($activity_note_form->getErrors(true));
                }
            }
        } catch (\Exception $e) {
            $message = 'An error occurred: ' . $e->getMessage();
            $em->getConnection()->rollback();
            $em->close();
        }
        
        $activityService = new \ESERV\MAIN\ActivityBundle\Services\ESERVMAINActivityServices($em, $this->container);
        $teacher_notes = $activityService->getTeacherNotes(array('entity_id' => $request->get('target_contact_id')));
        
        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array,
            'teacher_notes_json' => $teacher_notes
        );
        $em->close();

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }
    
        
    // Activity Letter view action
    public function viewActivityLetterAction($id, $target_contact_id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $activity = $em->getRepository('ESERVMAINActivityBundle:Activity')->find($id);        

        if (!$activity) {
            throw $this->createNotFoundException('Unable to find activity letter.');
        }
        
        $description = $activity->getShortDescription();
        $template_name = $activity->getTemplateVersion()->getName();                
        $targets = $em->getRepository('ESERVMAINActivityBundle:ActivityTarget')->getTargetsByActivityId($activity->getId());           
        $view_link = $this->generateUrl('eserv_main_activity_view_document', array(
            'activity_id' => $id,
            'source_contact_id' => $target_contact_id,
            'document_type' => 'letter'
        ));
        $view_link = '<a target="_blank" href="'.$view_link.'"> View Letter </a>';
        
        $current_target_name = $em->getReference('ESERV\MAIN\ContactBundle\Entity\Contact', $target_contact_id)->getDisplayName();
        if((count($targets) - 1 == 0)){
            $tmp_targets_string = $current_target_name;
        }else{
            $tmp_targets_string = $current_target_name. ' & '.( count($targets) - 1) .' others.';
        }        

        $form = $this->createForm(new \ESERV\MAIN\ActivityBundle\Form\ActivityLetterType(), null, array(            
            'attr' => array(
                'class' => 'eserv_form form-horizontal'),
            'params' => array(
                'description' => $description,
                'template_name' => $template_name,
                'targets_name' => $tmp_targets_string,
                'view_link' => $view_link,
                ),
        ));
        
        return $this->render('ESERVMAINActivityBundle:Default:render_activity_letter.html.twig', array(
                    'form' => $form->createView(),
                    'activity_id' => $id
        ));
    }
    
    // Activity Email view action
    public function viewActivityEmailAction($id, $target_contact_id,  Request $request) {
        $em = $this->getDoctrine()->getManager();
        $activity = $em->getRepository('ESERVMAINActivityBundle:Activity')->find($id);        

        if (!$activity) {
            throw $this->createNotFoundException('Unable to find activity email.');
        }
        
        $description = $activity->getShortDescription();
        $template_name = $activity->getTemplateVersion()->getName();                
        $targets = $em->getRepository('ESERVMAINActivityBundle:ActivityTarget')->getTargetsByActivityId($activity->getId());           
        $view_link = $this->generateUrl('eserv_main_activity_view_document', array(
            'activity_id' => $id,
            'source_contact_id' => $target_contact_id,
            'document_type' => 'email'
        ));
        $view_link = '<a target="_blank" href="'.$view_link.'"> View Email </a>';
        
        $current_target_name = $em->getReference('ESERV\MAIN\ContactBundle\Entity\Contact', $target_contact_id)->getDisplayName();
        if((count($targets) - 1 == 0)){
            $tmp_targets_string = $current_target_name;
        }else{
            $tmp_targets_string = $current_target_name. ' & '.( count($targets) - 1) .' others.';
        }

        $form = $this->createForm(new \ESERV\MAIN\ActivityBundle\Form\ActivityEmailType(), null, array(            
            'attr' => array(
                'class' => 'eserv_form form-horizontal'),
            'params' => array(
                'description' => $description,
                'template_name' => $template_name,
                'targets_name' => $tmp_targets_string,
                'view_link' => $view_link,
                ),
        ));
        
        return $this->render('ESERVMAINActivityBundle:Default:render_activity_email.html.twig', array(
                    'form' => $form->createView(),
                    'activity_id' => $id
        ));
    }
    
    public function viewActivityDocumentAction($activity_id, $source_contact_id, $document_type)
    {
        $es = new \ESERV\MAIN\ActivityBundle\Services\ESERVMAINActivityServices($this->getDoctrine()->getManager(), $this->container);
        $result = $es->prepareTemplateContentPerTarget($activity_id, $source_contact_id);
        
        if($result['status'] == true){
            $file_name = $document_type.'_' . rand(0, 9999) . '.pdf';

            return new Response(
                $this->get('knp_snappy.pdf')->getOutputFromHtml($result['msg']),
                200,
                array(
                    'Content-Type'          => 'application/pdf',
                    'Content-Disposition'   => 'attachment; filename="'.$file_name.'"'
                )
            );            
        }else{
           return new Response(
                'Error generating the PDF',
                200,
                array(                    
                )
            );  
        }        
    } 
    
    public function deleteActivityNoteAction(Request $request) {
        $id = $request->get('id');
        $status = false;
        $em = $this->getDoctrine()->getManager();
//        $activityCategory = $em->getRepository('ESERVMAINActivityBundle:ActivityCategory')
//                ->findOneBy(array('code' => 'TN'));
        $activity = $em->getRepository('ESERVMAINActivityBundle:Activity')->findOneBy(array(
//            'activityCategory' => $activityCategory,
            'id' => $id
        ));

        if (!$activity) {
            throw $this->createNotFoundException('Unable to find note with id '. $id);
        }

        try {
            $em->getConnection()->beginTransaction();

            $em->remove($activity);
            $em->flush();

            $em->getConnection()->commit();
            $status = true;
            $message = 'Note has been successfully deleted!';
        } catch (\Exception $e) {
            $em->getConnection()->rollback();
            $message = 'An error occurred: ' . $e->getMessage();
        }
        $teacherNotes = array();
        if ($activity->getEntityName() == 'Contact' && $activity->getActivityCategory() == 'TN') {
            $activityService = new \ESERV\MAIN\ActivityBundle\Services\ESERVMAINActivityServices($em, $this->container);
            $teacherNotes = $activityService->getTeacherNotes(array('entity_id' => $activity->getEntityId()));
        }
        $result = array(
            'success' => $status,
            'msg' => $message,
            'teacher_notes_json' => $teacherNotes
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }
    
    public function addEmailToQueuedDbProcessAction(Request $request) {
        $id = $request->get('id');
        $status = false;
        $em = $this->getDoctrine()->getManager();
        $activityCategory = $em->getRepository('ESERVMAINActivityBundle:ActivityCategory')
                ->findOneBy(array('code' => 'TE'));
        $activity = $em->getRepository('ESERVMAINActivityBundle:Activity')->findOneBy(array(
            'activityCategory' => $activityCategory,
            'id' => $id
        ));

        if (!$activity) {
            throw $this->createNotFoundException('Unable to find Teacher Email.');
        }
        
        try {
            $em->getConnection()->beginTransaction();
            $activityOutstandingStatus = $em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getBySystemCodeTypeAndCode(\ESERV\MAIN\Services\AppConstants::SCT_ACTIVITY_STATUS_CODE, \ESERV\MAIN\Services\AppConstants::SC_ACTIVITY_STATUS_OUTSTANDING_CODE);
            $emailQueuedStatus = $em->getRepository('ESERVMAINSystemConfigBundle:SystemCode')->getBySystemCodeTypeAndCode(\ESERV\MAIN\Services\AppConstants::SCT_ACTIVITY_EMAIL_STATUS_CODE, \ESERV\MAIN\Services\AppConstants::SC_ACTIVITY_EMAIL_STATUS_QUEUED_CODE);
            $activity->setStatus($activityOutstandingStatus);
            $em->persist($activity);
            $activityEmails = $em->createQueryBuilder()
                    ->select('ae.id as activityEmailId', 'a.id as activityId')
                    ->from('ESERVMAINActivityBundle:ActivityTarget', 'at')
                    ->innerJoin('ESERVMAINActivityBundle:ActivityEmail', 'ae' , 'with', 'ae.activityTarget = at.id')
                    ->innerJoin('at.activity', 'a')
                    ->where('a.id = :aId')
                    ->setParameter('aId', $id)
                    ->getQuery()
                    ->getResult()
            ;
            foreach ($activityEmails as $key => $value) {
                $activityEmail = $em->getRepository('ESERVMAINActivityBundle:ActivityEmail')->find($value['activityEmailId']);
                $activityEmail->setEmailStatusSystemCode($emailQueuedStatus);
                $em->persist($activityEmail);
                
                $queDbProcess = $em->createQueryBuilder()
                        ->select('qdp.id')
                        ->from('ESERVMAINExternalBundle:QueuedDbProcessVar', 'qdpv')
                        ->InnerJoin('qdpv.queuedDbProcess', 'qdp')
                        ->where('qdpv.fieldName = \'id\'')
                        ->andWhere('qdpv.fieldValue like :actId')
                        ->setParameter('actId', $value['activityId'])
                        ->getQuery()
                        ->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_ARRAY)
                ;
                $queuedDbProcess = $em->getRepository('ESERVMAINExternalBundle:QueuedDbProcess')->find($queDbProcess['id']);
                $queuedDbProcess->setProcessed('N');
                $em->persist($queuedDbProcess);
            }
            
            $em->flush();
            $em->getConnection()->commit();
            $status = true;
            $message = 'The email has been queued for re-sending!';
        } catch (\Exception $e) {
            $em->getConnection()->rollback();
            $message = 'An error occurred: ' . $e->getMessage();
        }
        $result = array(
            'success' => $status,
            'msg' => $message,
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }

}
