<?php

namespace ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ESERV\MAIN\Services\DataTables;
use ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Services\ContactDetailsBundleService;
use ESERV\MAIN\Services\ErrorCodeConstants;

class EmailController extends Controller
{
    public $email_columns;
    public $email_table_id = 'eserv_email_table';

    public function __construct() {
        $this->email_columns = array(
            'entityName' => array(
                'entityName',
                'options' => array(
                    'header' => 'Entity',
                    'css_class' => 'hide dt-email-entity-name',
                )
            ),
            'emailAddress' => array(
                'emailAddress',
                'options' => array(
                    'header' => 'Email Address',
                    'css_class' => 'deleted-json-email-address',
                )
            ),
            'emailType' => array(
                'emailTypeName',
                'options' => array(
                    'header' => 'Email Type',
                    'css_class' => 'deleted-json-email-type',
                )
            ),
            'primaryRecord' => array(
                'primaryRecord',
                'options' => array(
                    'header' => 'Primary',
                    'width' => '15px',
                    'css_class' => 'hide_for_mobile deleted-json-primary-record dt-email-primary-record',
                )
            ),
            'historyRecord' => array(
                'historyRecord',
                'options' => array(
                    'header' => 'History Record',
                    'css_class' => 'hide_for_mobile dt-history',
                    'col_name' => 'history_record'
                )
            ),
            'deletedRecord' => array(
                'deletedRecord',
                'options' => array(
                    'header' => 'Deleted Json String',
                    'css_class' => 'hide_for_mobile deleted-json-data hide',
                )
            ),
            'details_btn' => array(
                'type' => 'details_modal',
                'url' => 'contact_detail/email/edit/[[entity_name]]/[[entity_id]]',
                'url_params' => array(
                    'entity_name' => 'entity_name',
                    'entity_id' => 'entity_id',
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">Edit</span>',
                'modal_attr' => array(
                    'title' => 'Edit Email',
                ),
                'options' => array(
                    'header' => 'Edit',
                    'width' => '100px',
                    'css_class' => 'center dt-history-view',
                    'sortable' => false,
                )
            ),
        );
    }

    public function emailListAction(Request $request) {
        $contact_id = $request->get('contact_id');
        $email_columns = DataTables::formatDataTablesColumnsArray($this->email_columns);
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->email_table_id, array(
            'columns' => $email_columns,
            'row_callback' => 'eservEmailTableRowCallBackFunc(row);',
            'source_url' => $this->container->get('router')->generate('eservcore_contact_bundle_components_contact_details_email_ajax_list', array('contact_id' => $contact_id)),
            'disable_initial_sorting' => true,
        ));

        return $this->render('ESERVMAINContactBundleComponentsContactDetailsBundle:Email:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'dataTable_id' => $this->email_table_id,
                    'table_id' => 'contents_wrapper_' . $this->email_table_id,
        ));
    }

    public function dataAction(Request $request) {
        $contact_id = $request->get('contact_id');
        $history_record = $this->container->get('datatables_services')->getDataTableRequestParameter($request, 'history_record');
        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Services\ContactDetailsBundleService',
                    'function_name' => 'ListEmailsByContactId',
                    'function_params' => array(
                        'contact_id' => $contact_id,
                        'history_record' => $history_record,
                    )
                )
            ),
            'index_col' => 'dtindex',
            'columns' => $this->email_columns,
            'table_id'=>$this->email_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }

    public function newAction(Request $request) {
        $contact_id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Teacher\EmailType(), null, array(
            'action' => $this->generateUrl('eservcore_contact_bundle_components_contact_details_email_create', array('id' => $contact_id)),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'
                ),
            'enable_required_fields'=>true,
                
        ));
        $records = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Email')
                      ->findBy(array('contact' => $contact_id));
               
        $em->close();        

        return $this->render('ESERVMAINContactBundleComponentsContactDetailsBundle:Email:new.html.twig', array(
                'form' => $form->createView(),
                'has_records'=>(count($records)>0) ? 'Y' : 'N' 
        ));
    }

    public function createAction(Request $request) {
        $contact_id = $request->get('id');
        $status = false;
        $result = array();
        $errors_array = array();
        $message = '';
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Teacher\EmailType(), null, array(
            'action' => $this->generateUrl('eservcore_contact_bundle_components_contact_details_email_create', array('id' => $contact_id)),
        ));
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                try {
                    $em->getConnection()->beginTransaction();
                    $postData = $request->request->get($form->getName());
                    
                    $contact = $em->getRepository('ESERVMAINContactBundle:Contact')->find($contact_id);

                    $email_type_id = $postData['emailType'];
                    $email_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                            ->find($email_type_id);
                    
                    $primaryRecord = (isset($postData['primaryRecord']) ? 'Y' : 'N');
                    
                    //if no primary record is present
                    if ($primaryRecord == 'N') {
                        $existPrimaryRecord = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Email')
                                                ->existPrimaryRecordForContact($contact);
                        if (!$existPrimaryRecord) { 
                            throw new \Exception(' Atleast one Email should be primary', 500);
                        }
                    }
                    
                    //changing the existing primary email to not primary
                    if ($primaryRecord == 'Y') {
                        $primary_email = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Email')
                                ->findBy(array('contact' => $contact, 'primaryRecord' => 'Y'));

                        if ($primary_email) {
                            foreach ($primary_email as $a) {
                                $a->setPrimaryRecord('N');
                                $em->persist($a);
                                $em->flush();
                            }
                        }
                    }
                    
                    //make a new email
                    $email = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Email();
                    $email->setContact($contact);
                    $email->setEmailType($email_type);
                    $email->setEmailAddress($postData['emailAddress']);
                    $email->setPrimaryRecord($primaryRecord);
                    $em->persist($email);
                    $em->flush();

                    $em->getConnection()->commit();
                    $status = true;
                    $message = 'Email Details successfully Added!';
                } catch (\Exception $e) {
                    $message = 'An error occurred: ' . $e->getMessage();
                    $em->getConnection()->rollback();
                }
            } else {
                $message = 'Form is invalid';                
            }
        }      
        $em->close();
        return $this->container->get('core_function_services')->showMessage($status, $message, $request, $form);
    }

    public function editAction(Request $request) {
        $entityName = $request->get('entity_name');
        $entityId = $request->get('entity_id');
        $em = $this->getDoctrine()->getManager();
        if($entityName == 'email'){
            $emailId = $entityId;            
            $email = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Email')
                    ->find($emailId);
            if (!$email) {
                throw $this->createNotFoundException('No Email found for id ' . $emailId );
            }
            if ($email->getPrimaryRecord() == 'Y') {
                $email->setPrimaryRecord(true);
            } else {
                $email->setPrimaryRecord(false);
            }

            $contact_email_count = count($em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Email')
                    ->findBy(array('contact' => $email->getContact())));

            $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Teacher\EmailType(), $email, array(
                'action' => $this->generateUrl('eservcore_contact_bundle_components_contact_details_email_update', array('id' => $emailId)),
                'attr' => array(
                    'class' => 'eserv_form form-horizontal eserv_form_editable'),
                'enable_required_fields'=>true,
            ));

            return $this->render('ESERVMAINContactBundleComponentsContactDetailsBundle:Email:edit.html.twig', array(
                'email_id' => $emailId,
                'form' => $form->createView(),
                'email_count'=>$contact_email_count,
                'email_type_name' => $email->getEmailType()->getName(),
            ));
        } else if($entityName == 'mtl_audit') {
            $mtlAuditId = $entityId;
            $classMetaData = $em->getClassMetadata('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVEmail'); 
            $classMetaData->setPrimaryTable(array( 'name' => 'eserv_v_email_hist' ));           
            $eservVEmail = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVEmail')->findOneBy(array(
                'entityName' => $entityName,
                'entityId' => $entityId,
            ));
            if (!$eservVEmail) {
                throw $this->createNotFoundException('No eservVEmail found for mtl_audit_id ' . $mtlAuditId );
            }
            return $this->render('ESERVMAINContactBundleComponentsContactDetailsBundle:Email:viewHistoryRecord.html.twig', array(
                'record_type' => 'edited_record',
                'eserv_v_email'=>$eservVEmail,
            ));
            
        } else if($entityName == 'mtl_deleted_record'){
            $mtlDeletedRecordId = $entityId;
            $contactService = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Services\ContactDetailsBundleService($em, $this->container);
            $deletedEmail = $contactService->getDeletedEmailByMtlDeletedRecordId($mtlDeletedRecordId);
            return $this->render('ESERVMAINContactBundleComponentsContactDetailsBundle:Email:viewHistoryRecord.html.twig', array(
                'record_type' => 'deleted_record',
                'deleted_email' => $deletedEmail,
            ));
        }
    }

    public function updateAction(Request $request) {
        $id = $request->get('id');
        $status = false;
        $message = '';
        $cfs = $this->container->get('core_function_services');
        $em = $this->getDoctrine()->getManager();
        $email = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Email')
                ->find($id);
        if (!$email) {
            return $cfs->showMessage($status, 'No Email found for id ' . $id, $request);
        }
        
        $contact_id=$email->getContact()->getId();
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Teacher\EmailType(), null, array(
            'action' => $this->generateUrl('eservcore_contact_bundle_components_contact_details_email_update', array('id' => $contact_id)),
        ));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                try {
                    $em->getConnection()->beginTransaction();
                    $postData = $request->request->get($form->getName());

                    $contact = $em->getRepository('ESERVMAINContactBundle:Contact')->find($contact_id);

                    $email_type_id = $postData['emailType'];
                    $email_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                            ->find($email_type_id);

                    $primaryRecord = (isset($postData['primaryRecord']) ? 'Y' : 'N');
                    
                    //if no primary record is present
                    if ($primaryRecord == 'N') {
                        $existPrimaryRecord = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Email')
                                                ->existPrimaryRecordForContact($contact, $id);
                        if (!$existPrimaryRecord) { 
                            throw new \Exception(' Atleast one Email should be primary', 500);
                        }
                    }
                    
                    //changing the existing primary email to not primary
                    if ($primaryRecord == 'Y') {
                        $qb1 = $em->createQueryBuilder();
                        $primary_email = $qb1->select('e')
                                ->from('ESERVMAINContactBundleComponentsContactDetailsBundle:Email', 'e')
                                ->Where('e.contact = :cont')
                                ->setParameter('cont', $contact)
                                ->andWhere('e.primaryRecord = :pr')
                                ->setParameter('pr', 'Y')
                                ->andWhere('e.id != :id')
                                ->setParameter('id', $id)
                                ->getQuery()
                                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

                        if ($primary_email) {
                            foreach ($primary_email as $a) {
                                $old_primary_email = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Email')->find($a['id']);
                                $old_primary_email->setPrimaryRecord('N');
                                $em->persist($old_primary_email);
                                $em->flush();
                            }
                        }
                    }
                    //update email                    
                    $email->setContact($contact);
                    $email->setEmailType($email_type);
                    $email->setEmailAddress($postData['emailAddress']);
                    $email->setPrimaryRecord($primaryRecord);

                    $em->persist($email);
                    $em->flush();

                    $em->getConnection()->commit();
                    $status = true;
                    $message = 'Email updated successfully';
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();                    
                    $message = 'An error occurred: ' . $e->getMessage();
                }
            } else {
                $message = 'Form is invalid';
            }            
        }
        $em->close();
        return $cfs->showMessage($status, $message, $request, $form);
    }
    
    public function deleteAction(Request $request) {
        $id = $request->get('id');     
        $status=false;
        $cfs = $this->container->get('core_function_services');
        $em = $this->getDoctrine()->getManager();
        $email = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Email')
                ->find($id);
        if (!$email) {
            return $cfs->showMessage($status, 'No Email found for id ' . $id, $request);
        }
        try {
            $em->getConnection()->beginTransaction();
            $total_emails = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Email')
                    ->findByContact($email->getContact());
            if(count($total_emails)>1){
                if($email->getPrimaryRecord() == 'Y'){
                    throw new \Exception(' Primary email cannot be deleted.', 500);
                }
            }
            $em->remove($email);
            $em->flush();
            
            $em->getConnection()->commit();            
            $status = true;
            $message = 'Email has been successfully deleted!';
        } catch (\Exception $e) {
            $message = 'An error occurred: ' . $e->getMessage();
            $em->getConnection()->rollback();
        }
        $em->close();
        return $cfs->showMessage($status, $message, $request);
    }
    
    public function getEmailTypeAsJavascriptVarAction(Request $request) {
        $emailTypes = $this->getDoctrine()->getManager()->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                ->getAppCodes(\ESERV\MAIN\Services\AppConstants::ACT_EMAIL_ADDRESS_TYPE);
        
        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse(array('email_type' => $emailTypes));
        } else {
            return $emailTypes;
        }
    }

}
