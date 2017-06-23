<?php

namespace ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ESERV\MAIN\Services\DataTables;
use ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Services\ContactDetailsBundleService;
use ESERV\MAIN\Services\ErrorCodeConstants;

class PhoneController extends Controller {

    public $phone_columns;
    public $phone_table_id = 'eserv_phone_table';

    public function __construct() {        
        $this->phone_columns = array(
//            'createdAt' => array(
//                'createdAt',
//                'col_type' => 'date',
//                'date_format' => 'd M Y',
//                'options' => array(
//                    'header' => 'Date',
//                    'width' => '130px',
//                    'css_class' => 'center hide',
//                )
//            ),
//            'createdByUsername' => array(
//                'createdByUsername',
//                'options' => array(
//                    'header' => 'Created By',
//                )
//            ),
            'entityName' => array(
                'entityName',
                'options' => array(
                    'header' => 'Emtity',
                    'css_class' => 'hide dt-ph-entity-name',
                )
            ),
            'phoneNumber' => array(
                'phoneNumber',
                'options' => array(
                    'header' => 'Phone Number',
                    'css_class' => 'deleted-json-phone-number',
                )
            ),
            'phoneType' => array(
                'phoneTypeName',
                'options' => array(
                    'header' => 'Phone Type',
                    'css_class' => 'deleted-json-phone-type',
                )
            ),
//            'newPhoneNumber' => array(
//                'newPhoneNumber',
//                'options' => array(
//                    'header' => 'New Number',
//                )
//            ),
//            'oldPhoneNumber' => array(
//                'oldPhoneNumber',
//                'options' => array(
//                    'header' => 'Old Number',
//                    'css_class' => 'hide_for_mobile show_on_history',
//                )
//            ),
            'primaryRecord' => array(
                'primaryRecord',
                'options' => array(
                    'header' => 'Primary',
                    'width' => '15px',
                    'css_class' => 'hide_for_mobile deleted-json-primary-record dt-ph-primary-record',
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
//            'updatedAt' => array(
//                'updatedAt',
//                'col_type' => 'date',
//                'date_format' => 'd M Y',
//                'options' => array(
//                    'header' => 'Changed Date',
//                    'width' => '130px',
//                    'css_class' => 'center hide_for_mobile show_on_history',
//                )
//            ),
//            'updatedByUsername' => array(
//                'updatedByUsername',
//                'options' => array(
//                    'header' => 'Changed By',
//                    'css_class' => 'hide_for_mobile show_on_history',
//                )
//            ),
//            'deletedAt' => array(
//                'deletedAt',
//                'col_type' => 'date',
//                'date_format' => 'd M Y',
//                'options' => array(
//                    'header' => 'Deleted Date',
//                    'width' => '130px',
//                    'css_class' => 'center hide_for_mobile show_on_history',
//                )
//            ),
//            'deletedByUsername' => array(
//                'deletedByUsername',
//                'options' => array(
//                    'header' => 'Deleted By',
//                    'css_class' => 'hide_for_mobile show_on_history',
//                )
//            ),
//            'deletedRecord' => array(
//                'deletedRecord',
//                'col_type' => 'json_string',
//                'json_distribution' => array(
//                    'oldPhoneNumber'=> 'phone_number',
//                    'phoneType' => array(
//                        'name' => 'ESERV\MAIN\ApplicationCodeBundle\Services\ESERVMAINApplicationCodeServices',
//                        'function_name' => 'getApplicationCodeNameById',
//                        'function_params' => array(
//                            'application_code_id' => 'phone_type_id',
//                        )
//                    ),
//                    'createdAt' => 'created_at',
//                    'createdByUsername' => array(
//                        'name' => 'Security\UserBundle\Services\UserBundleProfileService',
//                        'function_name' => 'getFosUsernameById',
//                        'function_params' => array(
//                            'user_id' => 'created_by',
//                        )
//                    ),
//                ),
//                'options' => array(
//                    'header' => 'Deleted By',
//                    'css_class' => 'hide_for_mobile show_on_history',
//                )
//            ),
            'deletedRecord' => array(
                'deletedRecord',
                'options' => array(
                    'header' => 'Deleted Json String',
                    'css_class' => 'hide_for_mobile deleted-json-data hide',
                )
            ),
            'details_btn' => array(
                'type' => 'details_modal',
                'url' => 'contact_detail/phone/edit/[[entity_name]]/[[entity_id]]',
                'url_params' => array(
                    'entity_name' => 'entity_name',
                    'entity_id' => 'entity_id',
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">Edit</span>',
                'modal_attr' => array(
                    'title' => 'Edit Phone',
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

    public function phoneListAction(Request $request) {
        $contact_id = $request->get('contact_id');
        $phone_columns = DataTables::formatDataTablesColumnsArray($this->phone_columns);
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->phone_table_id, array(
            'columns' => $phone_columns,
            'row_callback' => 'eservPhoneTableRowCallBackFunc(row);',
            'source_url' => $this->container->get('router')->generate('eservcore_contact_bundle_components_contact_details_phone_ajax_list', array('contact_id' => $contact_id)),
            'disable_initial_sorting' => true,
        ));
        
        return $this->render('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'dataTable_id' => $this->phone_table_id,
                    'table_id' => 'contents_wrapper_' . $this->phone_table_id,
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
                    'function_name' => 'ListPhonesByContactId',
                    'function_params' => array(
                        'contact_id' => $contact_id,
                        'history_record' => $history_record,
                    )
                )
            ),
            'index_col' => 'dtindex',
            'columns' => $this->phone_columns,
            'table_id'=>$this->phone_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }
    
    public function newAction(Request $request) {
        $contact_id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Teacher\PhoneType(), null, array(
            'action' => $this->generateUrl('eservcore_contact_bundle_components_contact_details_phone_create', array('id' => $contact_id)),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'
            ),
            'enable_required_fields'=>true,
        ));
        $records = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone')
                      ->findBy(array('contact' => $contact_id));
        
        $em->close();
        
        return $this->render('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone:new.html.twig', array(
            'form' => $form->createView(),
            'has_records'=>(count($records)>0) ? 'Y' : 'N' 
        ));
    }

    public function createAction(Request $request) {
        $contact_id = $request->get('id');
        $status = false; 
        $message='';
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Teacher\PhoneType(), null, array(
            'action' => $this->generateUrl('eservcore_contact_bundle_components_contact_details_phone_create', array('id' => $contact_id)),
        ));        
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                try {
                    $em->getConnection()->beginTransaction();
                    $postData = $request->request->get($form->getName());

                    $contact = $em->getRepository('ESERVMAINContactBundle:Contact')->find($contact_id);

                    $phone_type_id = $postData['phoneType'];
                    $phone_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                            ->find($phone_type_id);

                    $primaryRecord = (isset($postData['primaryRecord']) ? 'Y' : 'N');
                    
                    //if no primary record is present
                    if ($primaryRecord == 'N') {
                        $existPrimaryRecord = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone')
                                                ->existPrimaryRecordForContact($contact);
                        if (!$existPrimaryRecord) { 
                            throw new \Exception(' Atleast one Phone should be primary', 500);
                        }
                    }
                    
                    //changing the existing primary phone to not primary
                    if ($primaryRecord == 'Y') {
                        $primary_phone = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone')
                                ->findBy(array('contact' => $contact, 'primaryRecord' => 'Y'));

                        if ($primary_phone) {
                            foreach ($primary_phone as $a) {
                                $a->setPrimaryRecord('N');
                                $em->persist($a);
                                $em->flush();
                            }
                        }
                    }
                    
                    //make a new phone
                    $phone = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Entity\Phone();
                    $phone->setContact($contact);
                    $phone->setPhoneType($phone_type);
                    $phone->setPrimaryRecord($primaryRecord);
                    //$phone->setPhoneStd($postData['phoneStd']);
                    $phone->setPhoneNumber($postData['phoneNumber']);
                    $em->persist($phone);
                    $em->flush();

                    $em->getConnection()->commit();
                    $status = true;
                    $message = 'Phone Details successfully Added!';
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();
                    $message = 'An error occurred: ' . $e->getMessage(); 
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
        if($entityName == 'phone'){
            $phoneId = $entityId;
            $phone = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone')
                    ->find($phoneId);
            if (!$phone) {
                throw $this->createNotFoundException('No Phone found for id ' . $phoneId);
            }       

            if ($phone->getPrimaryRecord() == 'Y') {
                $phone->setPrimaryRecord(true);
            } else {
                $phone->setPrimaryRecord(false);
            }

            $contact_phones_count = count($em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone')
                    ->findBy(array('contact' => $phone->getContact())));

            $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Teacher\PhoneType(), $phone, array(
                'action' => $this->generateUrl('eservcore_contact_bundle_components_contact_details_phone_update', array('id' => $phoneId)),
                'attr' => array(
                    'class' => 'eserv_form form-horizontal eserv_form_editable'),
                'enable_required_fields'=>true,            
            ));

            return $this->render('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone:edit.html.twig', array(
                'phone_id' => $phoneId,
                'form' => $form->createView(),
                'phone_count'=>$contact_phones_count,
                'phone_type_name' => $phone->getPhoneType()->getName(),
            ));
        } else if($entityName == 'mtl_audit') {
            $mtlAuditId = $entityId;
            $classMetaData = $em->getClassMetadata('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVPhone'); 
            $classMetaData->setPrimaryTable(array( 'name' => 'eserv_v_phone_hist' ));
           
            $eservVPhone = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:EservVPhone')->findOneBy(array(
                'entityName' => $entityName,
                'entityId' => $entityId,
                    ));
            if (!$eservVPhone) {
                throw $this->createNotFoundException('No eservVPhone found for mtlAuditId ' . $mtlAuditId );
            }
            return $this->render('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone:viewHistoryRecord.html.twig', array(
                'record_type' => 'edited_record',
                'eserv_v_phone'=>$eservVPhone,
            ));
        } else if($entityName == 'mtl_deleted_record'){
            $mtlDeletedRecordId = $entityId;
            $contactService = new \ESERV\MAIN\ContactBundle\Components\ContactDetailsBundle\Services\ContactDetailsBundleService($em, $this->container);
            $deletedPhone = $contactService->getDeletedPhoneByMtlDeletedRecordId($mtlDeletedRecordId);
            return $this->render('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone:viewHistoryRecord.html.twig', array(
                'record_type' => 'deleted_record',
                'deleted_phone' => $deletedPhone,
            ));
        }
    } 
       
    public function updateAction(Request $request) {        
        $id = $request->get('id');  
        $status=false;
        $message='';
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Teacher\PhoneType());
        $cfs = $this->container->get('core_function_services');
        $em = $this->getDoctrine()->getManager();
        
        $phone = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone')
                ->find($id);
        if (!$phone) { 
            return $cfs->showMessage($status, 'No Phone found for id ' . $id, $request);
        }  
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                try {  
                    $em->getConnection()->beginTransaction();
                    $postData = $request->request->get($form->getName());
                    
                    $contact_id = $phone->getContact()->getId();
                    $contact = $em->getRepository('ESERVMAINContactBundle:Contact')->find($contact_id);

                    $phone_type_id = $postData['phoneType'];
                    $phone_type = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                            ->find($phone_type_id);

                    $primaryRecord = (isset($postData['primaryRecord']) ? 'Y' : 'N');
                    
                    //if no primary record is present
                    if ($primaryRecord == 'N') {
                        $existPrimaryRecord = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone')
                                                ->existPrimaryRecordForContact($contact, $id);
                        if (!$existPrimaryRecord) { 
                            throw new \Exception(' Atleast one Phone should be primary', 500);
                        }
                    } 
                    
                    //changing the existing primary address to not primary
                    if ($primaryRecord == 'Y') {
                        $qb1 = $em->createQueryBuilder();
                        $primary_phone = $qb1->select('p')
                                ->from('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone', 'p')
                                ->Where('p.contact = :cont')
                                ->setParameter('cont', $contact)
                                ->andWhere('p.primaryRecord = :pr')
                                ->setParameter('pr', 'Y')
                                ->andWhere('p.id != :id')
                                ->setParameter('id', $id)
                                ->getQuery()
                                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

                        if ($primary_phone) {
                            foreach ($primary_phone as $a) {
                                $old_primary_ph = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone')->find($a['id']);
                                $old_primary_ph->setPrimaryRecord('N');
                                $em->persist($old_primary_ph);
                                $em->flush();
                            }
                        }
                    }
                    //update phone
                    $phone->setContact($contact);
                    $phone->setPhoneType($phone_type);
                    //$phone->setPhoneStd($postData['phoneStd']);
                    $phone->setPhoneNumber($postData['phoneNumber']);
                    $phone->setPrimaryRecord($primaryRecord);

                    $em->persist($phone);
                    $em->flush();

                    $em->getConnection()->commit();
                    $status=true;
                    $message = 'Phone updated successfully';
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();
                    $message = 'An error occurred: ' . $e->getMessage();
                }
            } else {
                $message = ' Form is invalid';
            }  
        }
        $em->close();
        return $cfs->showMessage($status, $message, $request, $form);
    }    
    
    public function deleteAction(Request $request) {
        $id = $request->get('id');
        $status = false;
        $cfs = $this->container->get('core_function_services');
        $em = $this->getDoctrine()->getManager();
        $phone = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone')
                ->find($id);
        
        if (!$phone) { 
            return $cfs->showMessage($status, 'No Phone found for id ' . $id, $request);
        }
        
        try {  
            $em->getConnection()->beginTransaction();
            $total_phones = $em->getRepository('ESERVMAINContactBundleComponentsContactDetailsBundle:Phone')
                    ->findByContact($phone->getContact());

            if(count($total_phones)>1){
                if($phone->getPrimaryRecord() == 'Y'){                    
                    throw new \Exception(' Primary phone cannot be deleted.', 500);
                }
            }  
            
            $em->remove($phone);
            $em->flush();
            
            $em->getConnection()->commit();
            $status=true;
            $message = 'Phone has been successfully deleted!';  
        } catch (\Exception $e) {            
            $em->getConnection()->rollback();
            $message = 'An error occurred: ' . $e->getMessage();
        } 
        $em->close();
        return $cfs->showMessage($status, $message, $request);        
    }
    
    public function getPhoneTypeAsJavascriptVarAction(Request $request) {
        $phoneTypes = $this->getDoctrine()->getManager()->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')
                ->getAppCodes(\ESERV\MAIN\Services\AppConstants::ACT_PHONE_TYPE);
//         print_r($phoneTypes);die;
        
        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse(array('phone_type' => $phoneTypes));
        } else {
            return $phoneTypes;
        }
    }
}
