<?php

namespace ESERV\MAIN\ActivityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ESERV\MAIN\Services\DataTables;

class ActivitySubCategoryController extends Controller
{
    
    public $activity_sub_category_columns;
    public $activity_sub_category_table_id = 'eserv_activity_sub_category_table';

    public function __construct() {
        $this->activity_sub_category_columns = array(
            'activity_sub_category_id' => array(
                'activity_sub_category_id',
                'options' => array(
                    'header' => 'ID',
                    'width' => '110px',
                    'css_class' => 'center',
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
            'description' => array(
                'description',
                'options' => array(
                    'header' => 'Description',
                )
            ),
            'details_btn' => array(
                'type' => 'details_href',
                'url' => '#/admin/categories/edit/[[id]]',
                'url_params' => array(
                    'id' => 'activity_sub_category_id'
                ),
                'title_text' => '<i class="fa fa-edit"></i> Edit',
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

    public function activitySubCategoryListAction() {
        $activity_sub_category_columns = DataTables::formatDataTablesColumnsArray($this->activity_sub_category_columns);
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->activity_sub_category_table_id, array(
            'columns' => $activity_sub_category_columns,
            'source_url' => $this->container->get('router')->generate('eserv_main_activity_sub_category_ajax_list'),
        ));

        return $this->render('ESERVMAINActivityBundle:ActivitySubCategory:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'table_id' => 'contents_wrapper_' . $this->activity_sub_category_table_id,
        ));
    }

    public function dataAction(Request $request) {

        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\TestBundle\Services\ESERVTestBundleActivitySubCategoryServices',
                    'function_name' => 'ListActivitySubCategories',
                    'function_params' => array(
                    )
                )
            ),
            'index_col' => 'activity_sub_category_id',
            'columns' => $this->activity_sub_category_columns,
            'table_id' => $this->activity_sub_category_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }
    
    public function newActivitySubCategoryAction(Request $request) {
        $action_url = $this->generateUrl('eserv_main_activity_sub_category_create');
        $atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::ACTIVITY_SUB_CATEGORY_ENTITY_NAME);
        $form_options_array = array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'alt_languages' => $atl_languages
        );

        $form = $this->createForm(new \ESERV\MAIN\ActivityBundle\Form\ActivitySubCategoryType($this->getDoctrine()->getManager()), null, $form_options_array);

        return $this->render('ESERVMAINActivityBundle:ActivitySubCategory:add.html.twig', array(
                    'form' => $form->createView(),
                    'alt_languages' => $atl_languages,
        ));
    }
    
    public function createActivitySubCategoryAction(Request $request) {
        $status = false;
        $result = array();

        $message = '';
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::ACTIVITY_SUB_CATEGORY_ENTITY_NAME);        
        $activity_sub_category = new \ESERV\MAIN\ActivityBundle\Entity\ActivitySubCategory();
        $form = $this->createForm(new \ESERV\MAIN\ActivityBundle\Form\ActivitySubCategoryType($this->getDoctrine()->getManager()), $activity_sub_category, array('alt_languages' => $this->atl_languages));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em1 = $this->getDoctrine()->getManager();
            $em1->getConnection()->beginTransaction();

            $activity_sub_category_data = $form->getData();

            try {
                $em1->persist($activity_sub_category_data);
                $em1->flush();

                // Create 'alt_language_equivlant' record(s) for each give value
                $activity_sub_category_id = $activity_sub_category_data->getId();
                if ($activity_sub_category_id) {
                    foreach ($this->atl_languages as $alt_language_id => $alt_language_name) {
                        $altName = $form->get($alt_language_name)->getData();
                        if (!is_null($altName)) {
                            $this->container->get('db_core_function_services')->createAltLanguageEquivlant($alt_language_id, \ESERV\MAIN\Services\AppConstants::ACTIVITY_SUB_CATEGORY_ENTITY_NAME, $activity_sub_category_id, $altName);
                        }
                    }
                }
                // end of creating 'alt_language_equivlant'

                $em1->getConnection()->commit();
                $status = true;
                $message = 'Activity Sub Category record added succesfully';
            } catch (\Exception $e) {
                $em1->getConnection()->rollback();
                $em1->close();
                $message = 'Error occurred : ' . $e->getMessage();
            }
            $em1->close();
        } else {
            $message = $this->render('ESERVMAINActivityBundle:ActivitySubCategory:add.html.twig', array('form' => $form->createView(), 'alt_languages' =>  $this->atl_languages ));
        }

        $result = array(
            'success' => $status,
            'msg' => $message
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }
    
            
    public function editActivitySubCategoryAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();                
        $activity_sub_category = $em->getRepository('ESERVMAINActivityBundle:ActivitySubCategory')->find($id);
        $action_url = $this->generateUrl('eserv_main_activity_sub_category_update');
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::ACTIVITY_SUB_CATEGORY_ENTITY_NAME);
        $this->existing_alt_languages_equivs =  $this->container->get('db_core_function_services')->getAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::ACTIVITY_SUB_CATEGORY_ENTITY_NAME, $id);
        if (!$activity_sub_category) {
            throw $this->createNotFoundException('Unable to find activity sub category.');
        }

        $editForm = $this->createForm(new \ESERV\MAIN\ActivityBundle\Form\ActivitySubCategoryType(), $activity_sub_category, array(
            'action' => $action_url . '/' . $id,
            'attr' => array(
            'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'alt_languages' =>  $this->atl_languages ));

        return $this->render('ESERVMAINActivityBundle:ActivitySubCategory:edit.html.twig', array(
                    'form' => $editForm->createView(), 
                    'alt_languages' =>  $this->atl_languages,
                    'existing_alt_languages_equivs' =>  $this->existing_alt_languages_equivs,
            
        ));
    }
    
    public function updateActivitySubCategoryAction($id, Request $request) {
        $status = false;
        $result = array();

        $message = '';
        $em = $this->getDoctrine()->getManager();        
        $activity_sub_category = $em->getRepository('ESERVMAINActivityBundle:ActivitySubCategory')->find($id);
        if (!$activity_sub_category) {
           $message = 'Unable to find activity sub category.';
           throw $this->createNotFoundException($message);
        }
        
        $action_url = $this->generateUrl('eserv_main_activity_sub_category_update');
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::ACTIVITY_SUB_CATEGORY_ENTITY_NAME);
        $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->getAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::ACTIVITY_SUB_CATEGORY_ENTITY_NAME, $id);

        $form = $this->createForm(new \ESERV\MAIN\ActivityBundle\Form\ActivitySubCategoryType(), $activity_sub_category, 
                array( 'action' => $action_url . '/' . $id,
                       'alt_languages' => $this->atl_languages));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {               
                $em->getConnection()->beginTransaction();
                try {
                    $em->flush();
                    //1. Delete alt_languages_equivs
                    $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->removeAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::ACTIVITY_SUB_CATEGORY_ENTITY_NAME, $id);
                    //2. (Re)Create 'alt_language_equivlant' record(s) for each give value                                
                    if($id){                                        
                        foreach ( $this->atl_languages as $alt_language_id => $alt_language_name) {                                              
                            $altName =  $form->get($alt_language_name)->getData();                                                
                            if(!is_null($altName)){
                                $this->container->get('db_core_function_services')->createAltLanguageEquivlant($alt_language_id , \ESERV\MAIN\Services\AppConstants::ACTIVITY_SUB_CATEGORY_ENTITY_NAME, $id, $altName);                             
                            }
                        }                                      
                    }
                    // end of creating 'alt_language_equivlant'
                    
                    $em->getConnection()->commit();
                    $status = true;
                    $message = 'Activity Sub Category record Updated succesfully';
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
            return $this->redirect($this->generateUrl('eserv_main_activity_sub_category_edit', array('id'=>$id)));
        }
    }
    
}
