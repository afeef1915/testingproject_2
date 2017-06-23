<?php

namespace ESERV\MAIN\QualificationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use ESERV\MAIN\Services\DataTables;

class SubjectController extends Controller {

    public $subject_columns;
    public $subject_table_id = 'eserv_subject_table';

    public function __construct() {
        $this->subject_columns = array(
            'subject_id' => array(
                'subject_id',
                'options' => array(
                    'header' => 'ID',
                    'width' => '110px',
                    'css_class' => 'center hide_for_mobile',
                )
            ),
            'code' => array(
                'code',
                'options' => array(
                    'header' => 'Code',
                    'width' => '110px',
                    'css_class' => 'center',
                )
            ),
            'name' => array(
                'name',
                'options' => array(
                    'header' => 'Name',
                )
            ),
            'qualType' => array(
                'qualType',
                'options' => array(
                    'header' => 'Type',
                )
            ),
            'details_btn' => array(
                'type' => 'details_href',
                #'url' => 'no_href',
                'url' => '#/admin/subjects/edit/[[id]]',
                'url_params' => array(
                    'id' => 'subject_id'
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">Edit</span>',
                'target' => '_self',
                'additional_attr' => array(
//                    'ui-sref' => 'admin.manage_subjects.edit_subject({id: 5})',
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

    public function subjectsListAction() {
        $subject_columns = DataTables::formatDataTablesColumnsArray($this->subject_columns);
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->subject_table_id, array(
            'columns' => $subject_columns,
            'source_url' => $this->container->get('router')->generate('eserv_main_subject_ajax_list'),
        ));

        return $this->render('ESERVMAINQualificationBundle:Subject:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'table_id' => 'contents_wrapper_' . $this->subject_table_id,
        ));
    }

    public function dataAction(Request $request) {

        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\TestBundle\Services\ESERVTestBundleSubjectServices',
                    'function_name' => 'ListSubjects',
                    'function_params' => array(
                    )
                )
            ),
            'index_col' => 'subject_id',
            'columns' => $this->subject_columns,
            'table_id' => $this->subject_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }

    public function newSubjectAction(Request $request) {
        $action_url = $this->generateUrl('eserv_main_subject_create');
        $atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::SUBJECT_ENTITY_NAME);
        $form_options_array = array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'alt_languages' => $atl_languages
        );

        $form = $this->createForm(new \ESERV\MAIN\QualificationBundle\Form\SubjectType($this->getDoctrine()->getManager()), null, $form_options_array);

        return $this->render('ESERVMAINQualificationBundle:Subject:add.html.twig', array(
                    'form' => $form->createView(),
                    'alt_languages' => $atl_languages,
        ));
    }

    public function createSubjectAction(Request $request) {
        $status = false;
        $result = array();
        $errors_array = array();
        $message = '';
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::SUBJECT_ENTITY_NAME);
        $subject = new \ESERV\MAIN\QualificationBundle\Entity\Subject();
        $form = $this->createForm(new \ESERV\MAIN\QualificationBundle\Form\SubjectType($this->getDoctrine()->getManager()), $subject, array('alt_languages' => $this->atl_languages));
        $form->handleRequest($request);

        if ($form->isValid()) { 
            $em1 = $this->getDoctrine()->getManager();
            $em1->getConnection()->beginTransaction();

            $subject_data = $form->getData();

            try {
                $em1->persist($subject_data);
                $em1->flush();

                // Create 'alt_language_equivlant' record(s) for each give value
                $subject_id = $subject_data->getId();
                if ($subject_id) {
                    foreach ($this->atl_languages as $alt_language_id => $alt_language_name) {
                        $altName = $form->get($alt_language_name)->getData();
                        if (!is_null($altName)) {
                            $this->container->get('db_core_function_services')->createAltLanguageEquivlant($alt_language_id, \ESERV\MAIN\Services\AppConstants::SUBJECT_ENTITY_NAME, $subject_id, $altName);
                        }
                    }
                }
                // end of creating 'alt_language_equivlant'

                $em1->getConnection()->commit();
                $status = true;
                $message = 'Subject record added succesfully';
            } catch (\Exception $e) {
                $em1->getConnection()->rollback();
                $em1->close();
                $message = 'Error occurred : ' . $e->getMessage();
            }
            $em1->close();
        } else {
            if ($request->isXmlHttpRequest()) {
                $message = 'Form is invalid';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($form->getErrors(true));
            } else {
                $message = $this->render('ESERVMAINQualificationBundle:Subject:add.html.twig', array('form' => $form->createView(), 'alt_languages' =>  $this->atl_languages ));
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

    public function editSubjectAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $subject = $em->getRepository('ESERVMAINQualificationBundle:Subject')->find($id);
        $action_url = $this->generateUrl('eserv_main_subject_update');
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::SUBJECT_ENTITY_NAME);
        $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->getAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::SUBJECT_ENTITY_NAME, $id);
        if (!$subject) {
            throw $this->createNotFoundException('Unable to find subject.');
        }

        $editForm = $this->createForm(new \ESERV\MAIN\QualificationBundle\Form\SubjectType(), $subject, array(
            'action' => $action_url . '/' . $id,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'alt_languages' => $this->atl_languages));

        return $this->render('ESERVMAINQualificationBundle:Subject:edit.html.twig', array(
                    'form' => $editForm->createView(),
                    'alt_languages' => $this->atl_languages,
                    'existing_alt_languages_equivs' => $this->existing_alt_languages_equivs,
        ));
    }

    public function updateSubjectAction($id, Request $request) {
        $status = false;
        $result = array();

        $message = '';
        $em = $this->getDoctrine()->getManager();
        $subject = $em->getRepository('ESERVMAINQualificationBundle:Subject')->find($id);
        if (!$subject) {
            $message = 'Unable to find subject.';
            throw $this->createNotFoundException($message);
        }

        $action_url = $this->generateUrl('eserv_main_subject_update');
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::SUBJECT_ENTITY_NAME);
        $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->getAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::SUBJECT_ENTITY_NAME, $id);

        $form = $this->createForm(new \ESERV\MAIN\QualificationBundle\Form\SubjectType(), $subject, array('action' => $action_url . '/' . $id,
            'alt_languages' => $this->atl_languages));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->getConnection()->beginTransaction();
                try {
                    $em->flush();
                    //1. Delete alt_languages_equivs
                    $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->removeAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::SUBJECT_ENTITY_NAME, $id);
                    //2. (Re)Create 'alt_language_equivlant' record(s) for each give value                                
                    if ($id) {
                        foreach ($this->atl_languages as $alt_language_id => $alt_language_name) {
                            $altName = $form->get($alt_language_name)->getData();
                            if (!is_null($altName)) {
                                $this->container->get('db_core_function_services')->createAltLanguageEquivlant($alt_language_id, \ESERV\MAIN\Services\AppConstants::SUBJECT_ENTITY_NAME, $id, $altName);
                            }
                        }
                    }
                    // end of creating 'alt_language_equivlant'

                    $em->getConnection()->commit();
                    $status = true;
                    $message = 'Subject record Updated succesfully';
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();
                    $em->close();
                    $message = 'Error occurred : ' . $e->getMessage();
                }
                $em->close();
            }
        }

        $result = array(
            'success' => $status,
            'msg' => $message
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $this->redirect($this->generateUrl('eserv_main_subject_edit', array('id' => $id)));
        }
    }

}
