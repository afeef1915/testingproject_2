<?php

namespace ESERV\MAIN\ApplicationCodeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ESERV\MAIN\Services\DataTables;
use ESERV\TestBundle\Services\ESERVMAINApplicationCodeServices;

class ApplicationCodeController extends Controller {

    public $application_code_type_columns;
    public $application_code_type_table_id = 'eserv_application_code_type_table';
    public $application_code_columns;
    public $application_code_table_id = 'eserv_application_code_table';

    public function __construct() {

        $this->application_code_type_columns = array(
//            'id' => array(
//                'id',
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
                )
            ),
            'name' => array(
                'name',
                'options' => array(
                    'header' => 'Group Name',
                )
            ),
            'details_btn' => array(
                'type' => 'details_href',
                #'url' => 'no_href',
                'url' => '#/admin/application_codes/group/view/[[id]]',
                'url_params' => array(
                    'id' => 'id'
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">View</span>',
                'target' => '_self',
                'additional_attr' => array(
//                    'ui-sref' => 'admin.manage_application_code_groups.view_application_code_group',
                    'class' => 'table_details_btn'
                ),
                'options' => array(
                    'header' => 'View',
                    'width' => '80px',
                    'css_class' => 'center',
                    'sortable' => false,
                )
            ),
        );

        $this->application_code_columns = array(
//            'id' => array(
//                'id',
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
                )
            ),
            'name' => array(
                'name',
                'options' => array(
                    'header' => 'Name',
                )
            ),
            'details_btn' => array(
                'type' => 'details_href',
                #'url' => 'no_href',
                'url' => '#/admin/application_codes/group/view/[[application_code_type_id]]/edit/[[id]]',
                'url_params' => array(
                    'id' => 'id',
                    'application_code_type_id' => 'application_code_type_id'
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">Edit</span>',
                'target' => '_self',
                'additional_attr' => array(
//                    'ui-sref' => 'admin.manage_application_code_groups.view_application_code_group.edit_application_code({id: 5})',
                    'class' => 'ng-binding table_details_btn'
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

    public function applicationCodeListAction(Request $request) {
        $type_id = $request->get('type_id', null);

        $application_code_columns = DataTables::formatDataTablesColumnsArray($this->application_code_columns);
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->application_code_table_id, array(
            'columns' => $application_code_columns,
            'source_url' => $this->container->get('router')->generate('eserv_main_application_code_ajax_list', array('type_id' => $type_id)),
        ));

        $applicationCodeType = $this->getDoctrine()->getManager()
                ->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCodeType')
                ->findOneBy(array('id' => $type_id));

        $type_name = null;
        if ($applicationCodeType) {
            $type_name = $applicationCodeType->getName();
        }

        return $this->render('ESERVMAINApplicationCodeBundle:ApplicationCode:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'table_id' => 'contents_wrapper_' . $this->application_code_table_id,
                    'type_id' => $type_id,
                    'type_name' => $type_name,
        ));
    }

    public function applicationCodeTypeListAction(Request $request) {
        $application_code_columns = DataTables::formatDataTablesColumnsArray($this->application_code_type_columns);
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->application_code_type_table_id, array(
            'columns' => $application_code_columns,
            'source_url' => $this->container->get('router')->generate('eserv_main_application_code_ajax_list'),
        ));

        return $this->render('ESERVMAINApplicationCodeBundle:ApplicationCode:type_list.html.twig', array(
                    'dataTable' => $dataTable,
                    'table_id' => 'contents_wrapper_' . $this->application_code_type_table_id,
        ));
    }

    public function dataAction(Request $request) {

        $type_id = $request->get('type_id', null);

        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\MAIN\ApplicationCodeBundle\Services\ESERVMAINApplicationCodeServices',
                    'function_name' => 'ListApplicationCodes',
                    'function_params' => array(
                        'type_id' => $type_id
                    )
                )
            ),
            'index_col' => is_null($type_id) ? 'id' : 'id',
            'columns' => is_null($type_id) ? $this->application_code_type_columns : $this->application_code_columns,
            'table_id'=> $this->application_code_type_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }

    public function newApplicationCodeAction(Request $request) {
        $type_id = $request->get('type_id', false);

        $applicationCodeType = $this->getDoctrine()->getManager()
                ->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCodeType')
                ->findOneBy(array('id' => $type_id));

        $type_name = false;
        if ($type_id) {
            $type_name = null;
            if ($applicationCodeType) {
                $type_name = $applicationCodeType->getName();
            }
        }

        $action_url = $this->generateUrl('eserv_main_application_code_create');
        $cent_id = $this->container->get('db_core_function_services')->getClientEntityIdByEntityName('ApplicationCode');
        $client_table_array = $this->container->get('db_core_function_services')->getClientTableArray($cent_id);
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::APPLICATION_CODE_ENTITY_NAME);

        $form_options_array = array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'alt_languages' => $this->atl_languages,
            'applicationCodeType' => $applicationCodeType
        );

        $form = $this->createForm(new \ESERV\MAIN\ApplicationCodeBundle\Form\ApplicationCodeType($this->getDoctrine()->getManager(), $client_table_array), null, $form_options_array);

        $arr = $this->container->get('db_core_function_services')->getTableIdsByEntityName('ApplicationCode');
        $table_names_array = $this->container->get('db_core_function_services')->getClientTableNamesById($arr);
        $field_name_and_type_array = $this->container->get('db_core_function_services')->getFieldNamesAndTypes(array_keys($table_names_array));

        $myArray = array();

        foreach ($table_names_array as $key => $value) {
            if (count($field_name_and_type_array[$key]) != 0) {
                $myArray[$key] = array(
                    'view' => $form->get($value['name'])->createView(),
                    'title' => $value['title']
                );
            }
        }


        return $this->render('ESERVMAINApplicationCodeBundle:ApplicationCode:add.html.twig', array(
                    'form' => $form->createView(),
                    'field_name_and_types' => $field_name_and_type_array,
                    'table_names_array' => $table_names_array,
                    'myArray' => $myArray,
                    'alt_languages' => $this->atl_languages,
                    'type_name' => $type_name,
                    'type_id' => $type_id
        ));
    }

    public function createApplicationCodeAction(Request $request) {
        $status = false;
        $result = array();

        $message = '';
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::APPLICATION_CODE_ENTITY_NAME);
        $application_code = new \ESERV\MAIN\ApplicationCodeBundle\Entity\ApplicationCode();
        $form = $this->createForm(new \ESERV\MAIN\ApplicationCodeBundle\Form\ApplicationCodeType($this->getDoctrine()->getManager()), $application_code, array('alt_languages' => $this->atl_languages));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em1 = $this->getDoctrine()->getManager();
            $em1->getConnection()->beginTransaction();

            $application_code_data = $form->getData();

            try {
                $em1->persist($application_code_data);
                $em1->flush();

                // Create 'alt_language_equivlant' record(s) for each give value
                $app_code_id = $application_code_data->getId();
                if ($app_code_id) {
                    foreach ($this->atl_languages as $alt_language_id => $alt_language_name) {
                        $altName = $form->get($alt_language_name)->getData();
                        if (!is_null($altName)) {
                            $this->container->get('db_core_function_services')->createAltLanguageEquivlant($alt_language_id, \ESERV\MAIN\Services\AppConstants::APPLICATION_CODE_ENTITY_NAME, $app_code_id, $altName);
                        }
                    }
                }
                // end of creating 'alt_language_equivlant'

                $em1->getConnection()->commit();
                $status = true;
                $message = 'Application Code record added succesfully';
            } catch (\Exception $e) {
                $em1->getConnection()->rollback();
                $em1->close();
                $message = 'Error occurred : ' . $e->getMessage();
            }
            $em1->close();
        } else {
            $message = $this->render('ESERVMAINApplicationCodeBundle:ApplicationCode:add.html.twig', array('form' => $form->createView(), 'alt_languages' => $this->atl_languages));
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

    public function editApplicationCodeAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $application_code = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')->find($id);
        $action_url = $this->generateUrl('eserv_main_application_code_update');
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::APPLICATION_CODE_ENTITY_NAME);
        $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->getAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::APPLICATION_CODE_ENTITY_NAME, $id);
        if (!$application_code) {
            throw $this->createNotFoundException('Unable to find application code entity.');
        }

        $applicationCodeType = $application_code->getApplicationCodeType();

        $editForm = $this->createForm(new \ESERV\MAIN\ApplicationCodeBundle\Form\ApplicationCodeType(), $application_code, array(
            'action' => $action_url . '/' . $id,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'alt_languages' => $this->atl_languages,
            'applicationCodeType' => $applicationCodeType
        ));

        return $this->render('ESERVMAINApplicationCodeBundle:ApplicationCode:edit.html.twig', array(
                    'form' => $editForm->createView(),
                    'alt_languages' => $this->atl_languages,
                    'type_name' => $applicationCodeType->getName(),
                    'existing_alt_languages_equivs' => $this->existing_alt_languages_equivs,
                    'application_code' => $application_code->getCode()
        ));
    }

    public function updateApplicationCodeAction($id, Request $request) {
        $status = false;
        $result = array();

        $message = '';
        $em = $this->getDoctrine()->getManager();
        $application_code = $em->getRepository('ESERVMAINApplicationCodeBundle:ApplicationCode')->find($id);
        if (!$application_code) {
            $message = 'Unable to find application code entity.';
            throw $this->createNotFoundException($message);
        }

        $action_url = $this->generateUrl('eserv_main_application_code_update');
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::APPLICATION_CODE_ENTITY_NAME);
        $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->getAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::APPLICATION_CODE_ENTITY_NAME, $id);

        $form = $this->createForm(new \ESERV\MAIN\ApplicationCodeBundle\Form\ApplicationCodeType(), $application_code, array('action' => $action_url . '/' . $id,
            'alt_languages' => $this->atl_languages));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                # $em = $this->getDoctrine()->getManager();
                $em->getConnection()->beginTransaction();
                try {
                    $em->flush();
                    //1. Delete alt_languages_equivs
                    $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->removeAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::APPLICATION_CODE_ENTITY_NAME, $id);
                    //2. Re insert alt_languages_equivs
                    // Create 'alt_language_equivlant' record(s) for each give value                                
                    if ($id) {
                        foreach ($this->atl_languages as $alt_language_id => $alt_language_name) {
                            $altName = $form->get($alt_language_name)->getData();
                            if (!is_null($altName)) {
                                $this->container->get('db_core_function_services')->createAltLanguageEquivlant($alt_language_id, \ESERV\MAIN\Services\AppConstants::APPLICATION_CODE_ENTITY_NAME, $id, $altName);
                            }
                        }
                    }
                    // end of creating 'alt_language_equivlant'

                    $em->getConnection()->commit();
                    $status = true;
                    $message = 'Application Code record Updated succesfully';
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
            return $this->redirect($this->generateUrl('eserv_main_application_code_edit', array('id' => $id)));
        }
    }

}
