<?php

namespace ESERV\MAIN\QualificationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use ESERV\MAIN\Services\DataTables;

class QualificationController extends Controller {

    public $qualification_columns;
    public $qualification_table_id = 'eserv_qualification_table';

    public function __construct() {
        $this->qualification_columns = array(
//            'qualification_id' => array(
//                'qualification_id',
//                'options' => array(
//                    'header' => 'ID',
//                    'width' => '110px',
//                    'css_class' => 'center hide_for_mobile',
//                )
//            ),
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
            'qualMandMemOrg' => array(
                'qualMandMemOrg',
                'options' => array(
                    'header' => 'Eligibility to Register',
                )
            ),
            'details_btn' => array(
                'type' => 'details_href',
                #'url' => 'no_href',
                'url' => '#/admin/qualifications/edit/[[id]]',
                'url_params' => array(
                    'id' => 'qualification_id'
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">Edit</span>',
                'target' => '_self',
                'additional_attr' => array(
//                    'ui-sref' => 'admin.manage_qualifications.edit_qualification({id: 5})',
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

    public function qualificationsListAction() {
        $qualification_columns = DataTables::formatDataTablesColumnsArray($this->qualification_columns);
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->qualification_table_id, array(
            'columns' => $qualification_columns,
            'source_url' => $this->container->get('router')->generate('eserv_main_qualification_ajax_list'),
            'initial_sorting_column' => array(
                'column' => 0,
                'direction' => 'asc'
            ),
        ));

        return $this->render('ESERVMAINQualificationBundle:Qualification:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'table_id' => 'contents_wrapper_' . $this->qualification_table_id,
        ));
    }

    public function dataAction(Request $request) {

        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\TestBundle\Services\ESERVTestBundleQualificationServices',
                    'function_name' => 'ListQualifications',
                    'function_params' => array(
                    )
                )
            ),
            'index_col' => 'qualification_id',
            'columns' => $this->qualification_columns,
            'table_id' => $this->qualification_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }

//    public function indexAction($name) {
//        return $this->render('ESERVMAINQualificationBundle:Default:index.html.twig', array('name' => $name));
//    }

    public function newQualificationAction() {
        $action_url = $this->generateUrl('eserv_main_qualification_create');
        $atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::QUALIFICATION_ENTITY_NAME);        
        $qual_mand_controls = $this->container->get('db_core_function_services')->getQualificationMandatroyControls();        
        $form_options_array = array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'alt_languages' => $atl_languages,
            'qual_mand_controls' => $qual_mand_controls
        );

        $form = $this->createForm(new \ESERV\MAIN\QualificationBundle\Form\QualificationType($this->getDoctrine()->getManager()), null, $form_options_array);

        return $this->render('ESERVMAINQualificationBundle:Qualification:add.html.twig', array(
                    'form' => $form->createView(),
                    'alt_languages' => $atl_languages,
                    'qual_mand_controls' => $qual_mand_controls,
        ));
    }

    public function createQualificationAction(Request $request) {
        $status = false;
        $result = array();
        $errors_array = array();
                
        $message = '';
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::QUALIFICATION_ENTITY_NAME);
        $qualification = new \ESERV\MAIN\QualificationBundle\Entity\Qualification();
        $this->qual_mand_controls = $this->container->get('db_core_function_services')->getQualificationMandatroyControls();
        $form = $this->createForm(new \ESERV\MAIN\QualificationBundle\Form\QualificationType($this->getDoctrine()->getManager()), $qualification, 
                array('alt_languages' => $this->atl_languages, 'qual_mand_controls' =>   $this->qual_mand_controls));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em1 = $this->getDoctrine()->getManager();
            $em1->getConnection()->beginTransaction();

            $qualification_data = $form->getData();            

            try {
                $em1->persist($qualification_data);
                $em1->flush();

                // Create 'alt_language_equivlant' record(s) for each give value
                $qualification_id = $qualification_data->getId();
                if ($qualification_id) {
                    foreach ($this->atl_languages as $alt_language_id => $alt_language_name) {
                        $altName = $form->get($alt_language_name)->getData();
                        if (!is_null($altName)) {
                            $this->container->get('db_core_function_services')->createAltLanguageEquivlant($alt_language_id, \ESERV\MAIN\Services\AppConstants::QUALIFICATION_ENTITY_NAME, $qualification_id, $altName);
                        }
                    }
                    
                    foreach ($this->qual_mand_controls as $qual_mand_control_id => $org_name) {
                        # echo '$qual_mand_control_id = '.$qual_mand_control_id; die;
                        $qualMand = $form->get($qual_mand_control_id)->getData(); # boolean value of check box  true / false                        
                        $qual_mand_value = $qualMand ? 'Y' : 'N'; # Y if check box is ticked              
                        $this->container->get('db_core_function_services')->createQualMand($qualification_data, $qual_mand_control_id, $qual_mand_value);
                    }                    
                }
                // end of creating 'alt_language_equivlant'

                $em1->getConnection()->commit();
                $status = true;
                $message = 'Qualification record added succesfully';
            } catch (\Exception $e) {
                $em1->getConnection()->rollback();
                $em1->close();
                $message = 'Error occurred : ' . $e->getMessage();
            }
            $em1->close();
        } else {            
            $message = 'Form is invalid';
            $errors_array = $this->container->get('core_function_services')->getEservFormErrors($form->getErrors(true));             
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
        
    public function editQualificationAction($id) {
        $em = $this->getDoctrine()->getManager();
        $qualification = $em->getRepository('ESERVMAINQualificationBundle:Qualification')->find($id);
        $action_url = $this->generateUrl('eserv_main_qualification_update');
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::QUALIFICATION_ENTITY_NAME);
        $this->existing_alt_languages_equivs =  $this->container->get('db_core_function_services')->getAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::QUALIFICATION_ENTITY_NAME, $id);
        if (!$qualification) {
            throw $this->createNotFoundException('Unable to find qualification entity.');
        }
        
        $this->qual_mand_controls = $this->container->get('db_core_function_services')->getQualificationMandatroyControls();
        $selected_qual_mands = $this->container->get('db_core_function_services')->getSelectedQualMand($qualification);        

        $editForm = $this->createForm(new \ESERV\MAIN\QualificationBundle\Form\QualificationType(), $qualification, array(
            'action' => $action_url . '/' . $id,
            'attr' => array(
            'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'alt_languages' =>  $this->atl_languages,
            'qual_mand_controls' =>   $this->qual_mand_controls,
             ));

        return $this->render('ESERVMAINQualificationBundle:Qualification:edit.html.twig', array(
                    'form' => $editForm->createView(), 
                    'alt_languages' =>  $this->atl_languages,
                    'existing_alt_languages_equivs' =>  $this->existing_alt_languages_equivs,
                    'qual_mand_controls' =>   $this->qual_mand_controls,
                    'selected_qual_mands' => $selected_qual_mands,
        ));
    }

    public function updateQualificationAction($id, Request $request) {
        $status = false;
        $result = array();

        $message = '';
        $em = $this->getDoctrine()->getManager();
        $qualification = $em->getRepository('ESERVMAINQualificationBundle:Qualification')->find($id);
        if (!$qualification) {
           $message = 'Unable to find Qualification entity.';
           throw $this->createNotFoundException($message);
        }
        
        $action_url = $this->generateUrl('eserv_main_qualification_update');
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::QUALIFICATION_ENTITY_NAME);
        $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->getAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::QUALIFICATION_ENTITY_NAME, $id);
        $this->qual_mand_controls = $this->container->get('db_core_function_services')->getQualificationMandatroyControls();
        
        $form = $this->createForm(new \ESERV\MAIN\QualificationBundle\Form\QualificationType(), $qualification, 
                array( 'action' => $action_url . '/' . $id,
                       'alt_languages' => $this->atl_languages, 'qual_mand_controls' =>   $this->qual_mand_controls,));
        if ($request->getMethod() == 'POST') {            
            $form->handleRequest($request);
            if ($form->isValid()) {                                              
                $em->getConnection()->beginTransaction();                                                
                try {
                    $em->flush();
                    //1. Delete alt_languages_equivs
                    $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->removeAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::QUALIFICATION_ENTITY_NAME, $id);
                    //2. (Re)Create 'alt_language_equivlant' record(s) for each give value                                
                    if($id){                                        
                        foreach ( $this->atl_languages as $alt_language_id => $alt_language_name) {                                              
                            $altName =  $form->get($alt_language_name)->getData();                                                
                            if(!is_null($altName)){
                                $this->container->get('db_core_function_services')->createAltLanguageEquivlant($alt_language_id , \ESERV\MAIN\Services\AppConstants::QUALIFICATION_ENTITY_NAME, $id, $altName);                             
                            }
                        }

                        foreach ($this->qual_mand_controls as $qual_mand_control_id => $org_name) {                           
                            $qualMand = $form->get($qual_mand_control_id)->getData();
                            $qual_mand_value = isset($qualMand) &&  $qualMand == 1 ? 'Y' : 'N'; # Y if check box is ticked                                          
                            $this->container->get('db_core_function_services')->updateQualMand($qualification, $qual_mand_control_id, $qual_mand_value);
                        }
                    }                    
                    // end of creating 'alt_language_equivlant'
                    
                    $em->getConnection()->commit();
                    $status = true;
                    $message = 'Qualification record Updated succesfully';
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
            return $this->redirect($this->generateUrl('eserv_main_qualification_edit', array('id'=>$id)));
        }
    }
    
}
