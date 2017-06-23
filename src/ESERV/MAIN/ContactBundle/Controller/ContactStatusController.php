<?php

namespace ESERV\MAIN\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactStatusController extends Controller {

    public $contactStatus_columns;
    public $contactStatus_table_id = 'eserv_contact_status_table';

    public function __construct() {
        $this->contactStatus_columns = array(
            'code' => array(
                'code',
                'options' => array(
                    'header' => 'Code',
                )
            ),
            'name' => array(
                'name',
                'options' => array(
                    'header' => 'Name',
                    'width' => '300px',
                )
            ),
            'contactType' => array(
                'contactType',
                'options' => array(
                    'header' => 'Contact Type',
                )
            ),
            'mtlColour' => array(
                'mtlColour',
                'options' => array(
                    'header' => 'MTL Colour',
                )
            ),
            'statusType' => array(
                'statusType',
                'options' => array(
                    'header' => 'Status Type',
                )
            ),
            'details_btn' => array(
                'type' => 'details_href',
                'url' => '#/admin/contact-status/edit/[[id]]',
                'url_params' => array(
                    'id' => 'id'
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">Edit</span>',
                'target' => '_self',
                'additional_attr' => array(
                    'class' => 'table_details_btn'
                ),
                'options' => array(
                    'header' => 'Edit',
                    'width' => '80px',
                    'css_class' => 'center',
                    'sortable' => false,
                )
            ),
        );
    }

    public function dataContactStatusAction(Request $request) {
        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\MAIN\ContactBundle\Services\ContactBundleContactStatusService',
                    'function_name' => 'listContactStatus',
                    'function_params' => array(
                    )
                )
            ),
            'index_col' => 'id',
            'columns' => $this->contactStatus_columns,
            'table_id' => $this->contactStatus_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }

    public function listContactStatusAction(Request $request) {
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->contactStatus_table_id, array(
            'columns' => $this->contactStatus_columns,
            'source_url' => $this->container->get('router')->generate('eserv_main_contact_contact_status_ajax_list'),
        ));

        return $this->render('ESERVMAINContactBundle:ContactStatus:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'table_id' => 'contents_wrapper_' . $this->contactStatus_table_id,
        ));
    }

    public function newContactStatusAction(Request $request) {
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\ContactStatusType(), null, array(
            'action' => $this->generateUrl('eserv_main_contact_contact_status_create'),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'
            )
        ));
        return $this->render('ESERVMAINContactBundle:ContactStatus:new.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function createContactStatusAction(Request $request) {
        $status = false;
        $errors_array = array();
        $message = '';

        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\ContactStatusType());
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                try {
                    $em = $this->getDoctrine()->getManager();
                    $em->getConnection()->beginTransaction();
                    $postData = $form->getData();
                    $newCode = $postData->getCode();

                    $contactStatusService = new \ESERV\MAIN\ContactBundle\Services\ContactBundleContactStatusService($em, $this->container);
                    if ($contactStatusService->existsContactStatus($newCode)) {
                        throw new \Exception('The code (' . $newCode . ') already exists.', 500);
                    }
                    $em->persist($postData);
                    $em->flush();

                    $em->getConnection()->commit();
                    $status = true;
                    $message = 'Contact status successfully created!';
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();
                    $message = 'An error occurred: ' . $e->getMessage();
                }
            } else {
                $message = 'Form is invalid.';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($form->getErrors(true));
            }
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

    public function editContactStatusAction(Request $request) {
        $contactStatusId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $contactStatus = $em->getRepository('ESERVMAINContactBundle:ContactStatus')->find($contactStatusId);
        if (!$contactStatus) {
            throw $this->createNotFoundException('No contact status found for id ' . $contactStatusId);
        }

        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\ContactStatusType(), $contactStatus, array(
            'action' => $this->generateUrl('eserv_main_contact_contact_status_update', array('id' => $contactStatusId)),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
        ));

        return $this->render('ESERVMAINContactBundle:ContactStatus:edit.html.twig', array(
                    'form' => $form->createView(),
                    'contactStatusId' => $contactStatusId
        ));
    }

    public function updateContactStatusAction(Request $request) {
        $contactStatusId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $contactStatus = $em->getRepository('ESERVMAINContactBundle:ContactStatus')->find($contactStatusId);
        if (!$contactStatus) {
            throw $this->createNotFoundException('No contact status found for id ' . $contactStatusId);
        }
        $status = false;
        $errors_array = array();
        $message = '';

        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\ContactStatusType(), $contactStatus);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                try {
                    $em->getConnection()->beginTransaction();
                    $postData = $form->getData();
                    $newCode = $postData->getCode();
                    
                    $contactStatusService = new \ESERV\MAIN\ContactBundle\Services\ContactBundleContactStatusService($em, $this->container);
                    if ($contactStatusService->existsContactStatus($newCode, $contactStatusId)) {
                        throw new \Exception('The code (' . $newCode . ') already exists.', 500);
                    }                    
                    $em->persist($postData);
                    $em->flush();
                    $em->getConnection()->commit();
                    $status = true;
                    $message = 'Contact status successfully updated!';
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();
                    $message = 'An error occurred: ' . $e->getMessage();
                }
            } else {
                $message = 'Form is invalid.';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($form->getErrors(true));
            }
        }
        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array,
        );
        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }

//    public function deleteContactStatusAction(Request $request) {
//        $contactStatusId = $request->get('id');
//        $em = $this->getDoctrine()->getManager();
//        $contactStatus = $em->getRepository('ESERVMAINContactBundle:ContactStatus')->find($contactStatusId);
//        if (!$contactStatus) {
//            throw $this->createNotFoundException('No contact status found for id '.$contactStatusId);
//        }
//        $status = false;                   
//        try {
//            $em->getConnection()->beginTransaction();
//            $em->remove($contactStatus);
//            $em->flush();
//
//            $em->getConnection()->commit();
//            $status = true;
//            $message = 'Contact status successfully deleted!';
//        } catch (\Exception $e) {
//            $em->getConnection()->rollback();
//            $message = 'An error occurred: '. $e->getMessage();
//        }
//      
//        $result = array(
//            'success' => $status,
//            'msg' => $message,
//        );
//        if ($request->isXmlHttpRequest()) {
//            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
//        } else {
//            return $message;
//        }
//    }
}
