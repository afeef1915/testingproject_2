<?php

namespace ESERV\MAIN\TemplateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ESERV\MAIN\Services\DataTables;
use ESERV\MAIN\TemplateBundle\Services\ESERVMAINTemplateBundleTemplateServices;

class TemplateController extends Controller {

    public $template_columns;
    public $template_table_id = 'eserv_template_table';

    public function __construct() {
        $this->template_columns = array(
            'name' => array(
                'name',
                'options' => array(
                    'header' => 'Name',
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
            'version' => array(
                'version',
                'options' => array(
                    'header' => 'Version',
                    'css_class' => 'hide_for_mobile'
                )
            ),
            'templateType' => array(
                'templateType',
                'options' => array(
                    'header' => 'Template Type',
                    'css_class' => 'center',
                )
            ),
            'mailMergeType' => array(
                'mailMergeType',
                'options' => array(
                    'header' => 'Mail Merge Type',
                    'css_class' => 'center hide_for_mobile',
                )
            ),
            'templateDocumentType' => array(
                'templateDocumentType',
                'options' => array(
                    'header' => 'Template Document Type',
                    'css_class' => 'center hide_for_mobile',
                )
            ),
            'language' => array(
                'language',
                'options' => array(
                    'header' => 'Language',
                    'css_class' => 'center hide_for_mobile',
                )
            ),
            'createdBy' => array(
                'createdBy',
                'options' => array(
                    'header' => 'Created By',
                    'css_class' => 'center hide_for_mobile',
                )
            ),
            'createdAt' => array(
                'createdAt',
                'col_type' => 'date',
                'options' => array(
                    'header' => 'Created At',
                    'width' => '130px',
                    'css_class' => 'center hide_for_mobile',
                )
            ),
            
            'details_btn' => array(
                'type' => 'details_href',
                #'url' => 'no_href',
                'url' => '#/admin/templates/[[url]]/edit/[[id]]',
                'url_params' => array(
                    'id' => 'dtindex',
                    'url' => 'gotoUrl'
                ),
                'title_text' => '<i class="fa fa-edit"></i> Edit',
                'target' => '_self',
                'additional_attr' => array(
//                    'ui-sref' => 'admin.manage_templates.edit_template({id: 1})',
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

    public function templatesListAction() {
        $template_columns = DataTables::formatDataTablesColumnsArray($this->template_columns);
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->template_table_id, array(
            'columns' => $template_columns,
            'source_url' => $this->container->get('router')->generate('eserv_main_template_ajax_list'),
        ));

        return $this->render('ESERVTestBundle:Template:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'table_id' => 'contents_wrapper_' . $this->template_table_id,
        ));
    }

    public function dataAction(Request $request) {

        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\MAIN\TemplateBundle\Services\ESERVMAINTemplateBundleTemplateServices',
                    'function_name' => 'ListTemplates',
                    'function_params' => array(
                    )
                )
            ),
            'index_col' => 'dtindex',
            'columns' => $this->template_columns,
            'table_id' => $this->template_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }

    public function newTemplateAction(Request $request) {
        $action_url = $this->generateUrl('eserv_main_template_create');
        $atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::TEMPLATE_ENTITY_NAME);
        $form_options_array = array(
            'action' => $action_url,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'alt_languages' => $atl_languages
        );

        $form = $this->createForm(new \ESERV\MAIN\TemplateBundle\Form\TemplateType($this->getDoctrine()->getManager()), null, $form_options_array);

        return $this->render('ESERVTestBundle:Template:add.html.twig', array(
                    'form' => $form->createView(),
                    'alt_languages' => $atl_languages,
        ));
    }

    public function createTemplateAction(Request $request) {
        $status = false;
        $result = array();

        $message = '';
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::TEMPLATE_ENTITY_NAME);
        $template = new \ESERV\MAIN\TemplateBundle\Entity\Template();
        $form = $this->createForm(new \ESERV\MAIN\TemplateBundle\Form\TemplateType($this->getDoctrine()->getManager()), $template, array('alt_languages' => $this->atl_languages));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em1 = $this->getDoctrine()->getManager();
            $em1->getConnection()->beginTransaction();
            $template_data = $form->getData();

            try {
                $em1->persist($template_data);
                $em1->flush();

                // Create 'alt_language_equivlant' record(s) for each give value                
                $template_id = $template_data->getId();
                if ($template_id) {
                    foreach ($this->atl_languages as $alt_language_id => $alt_language_name) {
                        $altName = $form->get($alt_language_name)->getData();
                        if (!is_null($altName)) {
                            $this->container->get('db_core_function_services')->createAltLanguageEquivlant($alt_language_id, \ESERV\MAIN\Services\AppConstants::TEMPLATE_ENTITY_NAME, $template_id, $altName);
                        }
                    }
                }
                // end of creating 'alt_language_equivlant'

                $em1->getConnection()->commit();
                $status = true;
                $message = 'Template record added succesfully';
            } catch (\Exception $e) {
                $em1->getConnection()->rollback();
                $em1->close();
                $message = 'Error occurred : ' . $e->getMessage();
            }
            $em1->close();
        } else {
            $message = $this->render('ESERVTestBundle:Template:add.html.twig', array('form' => $form->createView(), 'alt_languages' => $this->atl_languages));
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

    public function editTemplateAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $template = $em->getRepository('ESERVMAINTemplateBundle:Template')->find($id);        
        if (!$template) {
            throw $this->createNotFoundException('Unable to find template.');
        }
        $action_url = $this->generateUrl('eserv_main_template_update');
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::TEMPLATE_ENTITY_NAME);
        $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->getAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::TEMPLATE_ENTITY_NAME, $id);
        
        $editForm = $this->createForm(new \ESERV\MAIN\TemplateBundle\Form\TemplateType(), $template, array(
            'action' => $action_url . '/' . $id,
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
            'alt_languages' => $this->atl_languages));

        return $this->render('ESERVTestBundle:Template:edit.html.twig', array(
                    'form' => $editForm->createView(),
                    'alt_languages' => $this->atl_languages,
                    'existing_alt_languages_equivs' => $this->existing_alt_languages_equivs,
        ));
    }

    public function updateTemplateAction($id, Request $request) {
        $status = false;
        $result = array();

        $message = '';
        $em = $this->getDoctrine()->getManager();
        $template = $em->getRepository('ESERVMAINTemplateBundle:Template')->find($id);
        if (!$template) {
            $message = 'Unable to find Template.';
            throw $this->createNotFoundException($message);
        }

        $action_url = $this->generateUrl('eserv_main_template_update');
        $this->atl_languages = $this->container->get('db_core_function_services')->getAltLanguagesByEntityName(\ESERV\MAIN\Services\AppConstants::TEMPLATE_ENTITY_NAME);
        $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->getAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::TEMPLATE_ENTITY_NAME, $id);

        $form = $this->createForm(new \ESERV\MAIN\TemplateBundle\Form\TemplateType(), $template, array('action' => $action_url . '/' . $id,
            'alt_languages' => $this->atl_languages));
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->getConnection()->beginTransaction();
                try {
                    $em->flush();
                    //1. Delete alt_languages_equivs
                    $this->existing_alt_languages_equivs = $this->container->get('db_core_function_services')->removeAltLanguagesEquivsByEntityNameAndEntityId(\ESERV\MAIN\Services\AppConstants::TEMPLATE_ENTITY_NAME, $id);
                    //2. (Re)Create 'alt_language_equivlant' record(s) for each give value                                
                    if ($id) {
                        foreach ($this->atl_languages as $alt_language_id => $alt_language_name) {
                            $altName = $form->get($alt_language_name)->getData();
                            if (!is_null($altName)) {
                                $this->container->get('db_core_function_services')->createAltLanguageEquivlant($alt_language_id, \ESERV\MAIN\Services\AppConstants::TEMPLATE_ENTITY_NAME, $id, $altName);
                            }
                        }
                    }                    

                    $em->getConnection()->commit();
                    $status = true;
                    $message = 'Template record Updated succesfully';
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
            return $this->redirect($this->generateUrl('eserv_main_template_edit', array('id' => $id)));
        }
    }

    public function getTemplateAction(Request $request) {
        $template_id = $request->get('template_id', null);

        $template = $this->getDoctrine()->getManager()
                ->getRepository('ESERVMAINTemplateBundle:TemplateVersion')
                ->findOneBy(array('id' => $template_id));

        $content = array(
            'id' => $template_id,
            'content' => ''
        );
        if ($template) {
            $content = array(
                'id' => $template_id,
                'content' => $template->getContent()
            );
        }
        
        return new \Symfony\Component\HttpFoundation\JsonResponse($content);
    }
    
}
