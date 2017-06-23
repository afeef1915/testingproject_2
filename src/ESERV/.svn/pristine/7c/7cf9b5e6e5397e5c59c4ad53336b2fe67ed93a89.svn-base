<?php

namespace ESERV\MAIN\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RelationshipController extends Controller {

    public $relationship_columns;
    public $relationship_table_id = 'eserv_relationship_table';

    public function __construct() {
        $this->relationship_columns = array(
            'id' => array(
                'id',
                'options' => array(
                    'header' => 'id',
                )
            ),
//            'name' => array(
//                'name',
//                'options' => array(
//                    'header' => 'Name',
//                    'width' => '300px',
//                )
//            ),
            'nameBA' => array(
                'nameBA',
                'options' => array(
                    'header' => 'Relationship',
                    'width' => '300px',
                )
            ),
//            'contactAName' => array(
//                'contactAName',
//                'options' => array(
//                    'header' => 'contact_a_name',
//                )
//            ),
            'contactBName' => array(
                'contactBName',
                'options' => array(
                    'header' => 'Contact',
                )
            ),
//            'details_btn' => array(
//                'type' => 'details_href',
//                'url' => '#/admin/relationship/edit/[[id]]',
//                'url_params' => array(
//                    'id' => 'id'
//                ),
//                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">Edit</span>',
//                'target' => '_self',
//                'additional_attr' => array(
//                    'class' => 'table_details_btn'
//                ),
//                'options' => array(
//                    'header' => 'Edit',
//                    'width' => '80px',
//                    'css_class' => 'center',
//                    'sortable' => false,
//                )
//            ),
        );
    }

    public function listRelationshipAction($contact_a, $contact_b, Request $request) {
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->relationship_table_id, array(
            'columns' => $this->relationship_columns,
            'source_url' => $this->container->get('router')->generate('eserv_main_contact_relationship_ajax_list', array(
                'contact_a' => $contact_a,
                'contact_b' => $contact_b,
            )),
        ));

        return $this->render('ESERVMAINContactBundle:Relationship:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'table_id' => 'contents_wrapper_' . $this->relationship_table_id,
                    'contact_a' => $contact_a,
        ));
    }

    public function dataRelationshipAction(Request $request) {
        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\MAIN\ContactBundle\Services\ContactBundleRelationshipService',
                    'function_name' => 'listRelationships',
                    'function_params' => array(
                        'contact_a' => $request->get('contact_a', null),
                        'contact_b' => $request->get('contact_b', null),
                    )
                )
            ),
            'index_col' => 'id',
            'columns' => $this->relationship_columns,
            'table_id' => $this->relationship_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }

    public function newRelationshipAction(Request $request) {
        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Relationship\RelationshipType(), null, array(
            'action' => $this->generateUrl('eserv_main_contact_relationship_create'),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'
            )
        ));
        return $this->render('ESERVMAINContactBundle:Relationship:new.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function createRelationshipAction(Request $request) {
        $status = false;
        $errors_array = array();
        $message = '';

        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Relationship\RelationshipType());
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                try {
                    $em = $this->getDoctrine()->getManager();
                    $em->getConnection()->beginTransaction();
                    $postData = $form->getData();
                    $newCode = $postData->getCode();

                    $relationshipService = new \ESERV\MAIN\ContactBundle\Services\ContactBundleRelationshipService($em, $this->container);
                    if ($relationshipService->existsRelationship($newCode)) {
                        throw new \Exception('The code (' . $newCode . ') already exists.', 500);
                    }
                    $em->persist($postData);
                    $em->flush();

                    $em->getConnection()->commit();
                    $status = true;
                    $message = 'Relationship successfully created!';
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

    public function editRelationshipAction(Request $request) {
        $relationshipId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $relationship = $em->getRepository('ESERVMAINContactBundle:Relationship')->find($relationshipId);
        if (!$relationship) {
            throw $this->createNotFoundException('No relationship found for id ' . $relationshipId);
        }

        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Relationship\RelationshipType(), $relationship, array(
            'action' => $this->generateUrl('eserv_main_contact_relationship_update', array('id' => $relationshipId)),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
        ));

        return $this->render('ESERVMAINContactBundle:Relationship:edit.html.twig', array(
                    'form' => $form->createView(),
                    'relationshipId' => $relationshipId
        ));
    }

    public function updateRelationshipAction(Request $request) {
        $relationshipId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $relationship = $em->getRepository('ESERVMAINContactBundle:Relationship')->find($relationshipId);
        if (!$relationship) {
            throw $this->createNotFoundException('No relationship found for id ' . $relationshipId);
        }
        $status = false;
        $errors_array = array();
        $message = '';

        $form = $this->createForm(new \ESERV\MAIN\ContactBundle\Form\Relationship\RelationshipType(), $relationship);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                try {
                    $em->getConnection()->beginTransaction();
                    $postData = $form->getData();
                    $em->persist($postData);
                    $em->flush();
                    $em->getConnection()->commit();
                    $status = true;
                    $message = 'Relationship successfully updated!';
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

//    public function deleteRelationshipAction(Request $request) {
//        $relationshipId = $request->get('id');
//        $em = $this->getDoctrine()->getManager();
//        $relationship = $em->getRepository('ESERVMAINContactBundle:Relationship')->find($relationshipId);
//        if (!$relationship) {
//            throw $this->createNotFoundException('No relationship found for id '.$relationshipId);
//        }
//        $status = false;                   
//        try {
//            $em->getConnection()->beginTransaction();
//            $em->remove($relationship);
//            $em->flush();
//
//            $em->getConnection()->commit();
//            $status = true;
//            $message = 'Relationship successfully deleted!';
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
