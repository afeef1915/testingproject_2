<?php

namespace ESERV\MAIN\ProfileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ESERV\MAIN\Services\DataTables;

class MmHelpMessagesController extends Controller {

    public $mm_help_message_columns;
    public $mm_help_message_table_id = 'eserv_v_mm_help_messages';

    public function __construct() 
    {
        $this->mm_help_message_columns = array(
            'messageTypeName' => array(
                'messageTypeName',
                'options' => array(
                    'header' => 'Type',
                )
            ),
            'code' => array(
                'code',
                'options' => array(
                    'header' => 'Code',
                )
            ),
            'title' => array(
                'title',
                'options' => array(
                    'header' => 'Title',
                )
            ),
            'name' => array(
                'name',
                'options' => array(
                    'header' => 'Description',
                )
            ),            
            'isActive' => array(
                'isActive',
                'options' => array(
                    'header' => 'Is Active',
                    'width' => '110px',
                    'css_class' => 'center',
                )
            ),
            'createdAt' => array(
                'createdAt',
                'col_type' => 'date',
                'options' => array(
                    'header' => 'Created At',
                )
            ),
            'details_btn' => array(
                'type' => 'details_href',
                #'url' => 'no_href',
                'url' => '#/admin/help_messages/edit/[[id]]',
                'url_params' => array(
                    'id' => 'id'
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">View</span>',
                'target' => '_self',
                'additional_attr' => array(
//                    'ui-sref' => 'admin.manage_help_messages.edit_help_message({id: 5})',
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
    }

    public function helpMessagesListAction() 
    {
        $mm_help_message_columns = DataTables::formatDataTablesColumnsArray($this->mm_help_message_columns);
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->mm_help_message_table_id, array(
            'columns' => $mm_help_message_columns,
            'source_url' => $this->container->get('router')->generate('eserv_main_help_message_ajax_list'),
        ));

        return $this->render('ESERVMAINProfileBundle:MmHelpMessages:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'table_id' => 'contents_wrapper_' . $this->mm_help_message_table_id,
        ));
    }

    public function dataAction(Request $request) 
    {
        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\MAIN\ProfileBundle\Services\ProfileBundleMmHelpMessagesService',
                    'function_name' => 'ListMmHelpMessages',
                    'function_params' => array(
                    )
                )
            ),
            'index_col' => 'id',
            'columns' => $this->mm_help_message_columns,
            'table_id' => $this->mm_help_message_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }

    public function newHelpMessageAction(Request $request) 
    {
        $action_url = $this->generateUrl('eserv_main_help_message_create');
        $atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::MM_HELP_MESSAGE);
        $form_options_array = array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'alt_languages' => $atl_languages
        );

        $form = $this->createForm(new \ESERV\MAIN\ProfileBundle\Form\MmHelpMessageType($this->getDoctrine()->getManager()), null, $form_options_array);

        return $this->render('ESERVMAINProfileBundle:MmHelpMessages:add.html.twig', array(
                    'form' => $form->createView(),
                    'alt_languages' => $atl_languages,
        ));
    }

    public function createHelpMessageAction(Request $request) 
    {
        $status = false;
        $result = array();

        $message = '';
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::MM_HELP_MESSAGE);
        $help_message = new \ESERV\MAIN\ProfileBundle\Entity\MmHelpMessage();
        $form = $this->createForm(new \ESERV\MAIN\ProfileBundle\Form\MmHelpMessageType($this->getDoctrine()->getManager()), $help_message, array('alt_languages' => $this->atl_languages));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em1 = $this->getDoctrine()->getManager();
            $em1->getConnection()->beginTransaction();

            $help_message_data = $form->getData();

            try {
                $em1->persist($help_message_data);
                $em1->flush();

                // Create 'alt_language_equivlant' record(s) for each give value               
                $help_message_id = $help_message_data->getId();
                if ($help_message_id) {
                    foreach ($this->atl_languages as $alt_language_id => $alt_language_name) {
                        $altName = $form->get($alt_language_name)->getData();
                        if (!is_null($altName)) {
                            $this->container->get('db_core_function_services')->createAltLanguageEquivlant($alt_language_id, \ESERV\MAIN\Services\AppConstants::MM_HELP_MESSAGE, $help_message_id, $altName);
                        }
                    }
                }
                // end of creating 'alt_language_equivlant'

                $em1->getConnection()->commit();
                $status = true;
                $message = 'Help message record added succesfully';
            } catch (\Exception $e) {
                $em1->getConnection()->rollback();
                $em1->close();
                $message = 'Error occurred : ' . $e->getMessage();
            }
            $em1->close();
        } else {
            if ($request->isXmlHttpRequest()) {
                $message = (string) $form->getErrors(true);
            } else {
                $message = $this->render('ESERVMAINProfileBundle:MmHelpMessages:add.html.twig', array('form' => $form->createView(), 'alt_languages' => $this->atl_languages));
            }
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
    
    public function editHelpMessageAction($id, Request $request) 
    {        
        $em = $this->getDoctrine()->getManager();        
        $help_message = $em->getRepository('ESERVMAINProfileBundle:MmHelpMessage')->find($id);
        $action_url = $this->generateUrl('eserv_main_help_message_update');
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::MM_HELP_MESSAGE);
        $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->getAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::MM_HELP_MESSAGE, $id);
        if (!$help_message) {
            throw $this->createNotFoundException('Unable to find Help Message.');
        }

        $editForm = $this->createForm(new \ESERV\MAIN\ProfileBundle\Form\MmHelpMessageType(), $help_message, array(
            'action' => $action_url . '/' . $id,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'alt_languages' => $this->atl_languages));

        return $this->render('ESERVMAINProfileBundle:MmHelpMessages:edit.html.twig', array(
                    'form' => $editForm->createView(),
                    'alt_languages' => $this->atl_languages,
                    'existing_alt_languages_equivs' => $this->existing_alt_languages_equivs,
        ));
    }
    
    
    public function updateHelpMessageAction($id, Request $request) 
    {
        $status = false;
        $result = array();

        $message = '';
        $em = $this->getDoctrine()->getManager();        
        $help_message = $em->getRepository('ESERVMAINProfileBundle:MmHelpMessage')->find($id);
        if (!$help_message) {
            $message = 'Unable to find Help Message.';
            throw $this->createNotFoundException($message);
        }

        $action_url = $this->generateUrl('eserv_main_help_message_update');
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::MM_HELP_MESSAGE);
        $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->getAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::MM_HELP_MESSAGE, $id);

        $form = $this->createForm(new \ESERV\MAIN\ProfileBundle\Form\MmHelpMessageType(), $help_message, array('action' => $action_url . '/' . $id,
            'alt_languages' => $this->atl_languages));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->getConnection()->beginTransaction();
                try {
                    $em->flush();
                    //1. Delete alt_languages_equivs
                    $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->removeAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::MM_HELP_MESSAGE, $id);
                    //2. (Re)Create 'alt_language_equivlant' record(s) for each give value                                
                    if ($id) {
                        foreach ($this->atl_languages as $alt_language_id => $alt_language_name) {
                            $altName = $form->get($alt_language_name)->getData();
                            if (!is_null($altName)) {
                                $this->container->get('db_core_function_services')->createAltLanguageEquivlant($alt_language_id, \ESERV\MAIN\Services\AppConstants::MM_HELP_MESSAGE, $id, $altName);
                            }
                        }
                    }
                    // end of creating 'alt_language_equivlant'

                    $em->getConnection()->commit();
                    $status = true;
                    $message = 'Help Message record Updated succesfully';
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
            return $this->redirect($this->generateUrl('eserv_main_help_message_edit', array('id' => $id)));
        }
    }


}
