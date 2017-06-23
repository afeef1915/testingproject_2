<?php

namespace ESERV\MAIN\AdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ESERV\MAIN\Services\DataTables;

class AltLangController extends Controller {

    public $alt_lang_app_text_columns;
    public $alt_lang_app_text_table_id = 'eserv_alt_lang_app_text_table';

    public function __construct() {
        $this->alt_lang_app_text_columns = array(
            'id' => array(
                'id',
                'options' => array(
                    'header' => 'ID',
                    'css_class' => 'center',
                    'visible' => false
                )
            ),
            'code' => array(
                'code',
                'options' => array(
                    'header' => 'Code',
                )
            ),
            'altLanguageId' => array(
                'altLanguageId',
                'options' => array(
                    'header' => 'Alt Lang. ID',
                    'css_class' => 'center',
                    'visible' => false
                )
            ),
            'name' => array(
                'name',
                'options' => array(
                    'header' => 'Text',
                    'css_class' => 'center',
                    'width' => '40%',
                )
            ),
            'altName' => array(
                'altName',
                'options' => array(
                    'header' => 'Alternative Text',
                    'width' => '40%',
                )
            ),
            'altLanguageCode' => array(
                'altLanguageCode',
                'options' => array(
                    'header' => 'Code',
                    'width' => '10%',
                    'visible' => false
                )
            ),
            'details_btn' => array(
                'type' => 'details_href',
                'url' => '#/admin/alternative_language/[[altLanguageId]]/edit/[[id]]',
                'url_params' => array(
                    'id' => 'id',
                    'altLanguageId' => 'altLanguageId'
                ),
                'title_text' => '<i class="fa fa-edit"></i> <span class="desktop_inline_text">Edit</span>',
                'target' => '_self',
                'additional_attr' => array(
                    'class' => 'table_details_btn'
                ),
                'options' => array(
                    'header' => 'Edit',
                    'width' => '10%',
                    'css_class' => 'center',
                    'sortable' => false,
                )
            ),
        );
    }

    public function altLangListAction($alt_lang_id) {

        $user_columns = DataTables::formatDataTablesColumnsArray($this->alt_lang_app_text_columns);
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->alt_lang_app_text_table_id, array(
            'columns' => $user_columns,
            'source_url' => $this->container->get('router')->generate('eserv_main_administration_view_alt_lang_ajax_list', array('alt_lang_id' => $alt_lang_id)),
        ));

        $lang_name = $this->getDoctrine()->getManager()->getReference('\ESERV\MAIN\HelpersBundle\Entity\AltLanguage', $alt_lang_id);

        return $this->render('ESERVMAINAdministrationBundle:AltLanguage:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'table_id' => 'contents_wrapper_' . $this->alt_lang_app_text_table_id,
                    'alt_lang_id' => ($alt_lang_id ? $alt_lang_id : null),
                    'lang_name' => ($lang_name ? $lang_name->getLanguage()->getName() : null),
                    'lang_code' => ($lang_name ? $lang_name->getLanguage()->getCode() : ''),
                    'process_translations_url' => $this->container->getParameter('e_services_app')['update_translations_url']
        ));
    }

    public function dataAction($alt_lang_id, Request $request) {
        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\MAIN\AdministrationBundle\Services\AdministrationBundleAltLangService',
                    'function_name' => 'ListAltLangAppTexts',
                    'function_params' => array(
                        'alt_lang_id' => $alt_lang_id
                    )
                )
            ),
            'columns' => $this->alt_lang_app_text_columns,
            'index_col' => 'id',
            'table_id' => $this->alt_lang_app_text_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }

    public function selectLanguageAction() {
        $lang_list = $this->getDoctrine()->getManager()->getRepository('ESERVMAINHelpersBundle:AltLanguage')->findAll();


        return $this->render('ESERVMAINAdministrationBundle:AltLanguage:language_list.html.twig', array(
                    'lang_list' => $lang_list
        ));
    }

    public function newAltLangAction($alt_lang_id = null, Request $request) {
        if ($this->container->get('security.context')->isGranted('ROLE_ADMIN')) {
            $action_url = $this->generateUrl('eserv_main_administration_alt_lang_create', array('alt_lang_id' => $alt_lang_id));
            $form_options_array = array(
                'action' => $action_url,
                'attr' => array(
                    'class' => 'eserv_form form-horizontal eserv_form_editable'
                ),
            );
            $initial_data = null;
            $lang_name = null;
            if (!is_null($alt_lang_id)) {
                $lang_name = $this->getDoctrine()->getManager()->getReference('\ESERV\MAIN\HelpersBundle\Entity\AltLanguage', $alt_lang_id);
                $initial_data = array(
                    'altLanguage' => $lang_name
                );
            }
            $form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Form\AltLanguage\AddAltLangType(), $initial_data, $form_options_array);
            return $this->render('ESERVMAINAdministrationBundle:AltLanguage:add.html.twig', array(
                        'form' => $form->createView(),
                        'alt_lang_id' => ($alt_lang_id ? $alt_lang_id : null),
                        'lang_name' => ($lang_name ? 'Add ' . $lang_name->getLanguage()->getName() . ' alternative text' : 'Add alternative text')
            ));
        } else {
            $result = array(
                'success' => false,
                'msg' => 'You are not allowed to view this page!'
            );

            if ($request->isXmlHttpRequest()) {
                return new \Symfony\Component\HttpFoundation\JsonResponse($result);
            } else {
                return $message;
            }
        }
    }

    public function createAltLangAction($alt_lang_id, Request $request) {
        if ($this->container->get('security.context')->isGranted('ROLE_ADMIN')) {
            $status = false;
            $result = array();
            $errors_array = array();

            $message = '';

            $initial_data = null;
            $lang_name = null;
            if (!is_null($alt_lang_id)) {
                $lang_name = $this->getDoctrine()->getManager()->getReference('\ESERV\MAIN\HelpersBundle\Entity\AltLanguage', $alt_lang_id);
                $initial_data = array(
                    'altLanguage' => $lang_name
                );
            }

            $form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Form\AltLanguage\AddAltLangType(), $initial_data);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em1 = $this->getDoctrine()->getManager();
                $em1->getConnection()->beginTransaction();
                $form_data = $request->request->get('new_admin_alt_lang');

                try {
                    //Creating a new record for language pre-set pages               
                    if ($lang_name) {
                        $form_data['altLanguage'] = $lang_name->getId();
                    }

                    $alt_lang_services = new \ESERV\MAIN\HelpersBundle\Services\HelpersBundleAltLangService($em1);
                    $res = $alt_lang_services->createAltLang($form_data);
                    if ($res['status']) {
                        $em1->flush();
                        $em1->getConnection()->commit();
                        $status = true;
                        $message = $res['msg'];
                    } else {
                        $message = $res['msg'];
                    }
                } catch (\Exception $e) {
                    $em1->getConnection()->rollback();
                    $message = 'Error occurred : ' . $e->getMessage();
                }
            } else {
                $message = 'Please correct the errors below';
                $errors_array = $this->container->get('core_function_services')->getEservFormErrors($form->getErrors(true));
            }
        } else {
            $message = 'You are not allowed to access this page!';
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }

    public function editAltLangAction($id) {
        if (isset($id) && $id != '') {
            $em = $this->getDoctrine()->getManager();

            $action_url = $this->generateUrl('eserv_main_administration_alt_lang_update', array('id' => $id));

            $form_options_array = array(
                'action' => $action_url,
                'attr' => array(
                    'class' => 'eserv_form form-horizontal eserv_form_editable'
                )
            );

            $alt_lang = $em->getReference('ESERV\MAIN\HelpersBundle\Entity\AltLanguageAppText', $id);

            $data = array(
                'name' => $alt_lang->getAppText()->getName(),
                'altName' => $alt_lang->getAltName(),
                'altLanguage' => $alt_lang->getAltLanguage()->getLanguage()->getName(),
            );

            $form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Form\AltLanguage\EditAltLangType(), $data, $form_options_array);


            return $this->render('ESERVMAINAdministrationBundle:AltLanguage:edit.html.twig', array(
                        'form' => $form->createView(),
                        'lang_id' => ($alt_lang->getAltLanguage() ? $alt_lang->getAltLanguage()->getId() : null),
                        'lang_name' => ($alt_lang->getAltLanguage() ? 'Edit ' . $alt_lang->getAltLanguage()->getLanguage()->getName() . ' alternative text' : 'Edit alternative text')
            ));
        } else {
            throw new \Exception('ID cannot be blank', 500);
        }
    }

    public function updateAltLangAction($id, Request $request) {
        $status = false;
        $result = array();
        $errors_array = array();

        $message = '';

        $form = $this->createForm(new \ESERV\MAIN\AdministrationBundle\Form\AltLanguage\EditAltLangType(), null);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em1 = $this->getDoctrine()->getManager();
            $em1->getConnection()->beginTransaction();
            $form_data = $request->request->get('new_admin_edit_alt_lang');
            try {

                $alt_lang_services = new \ESERV\MAIN\HelpersBundle\Services\HelpersBundleAltLangService($em1);
                $form_data['alt_lang_app_text_id'] = $id;
                $res = $alt_lang_services->updateAltLang($form_data);
                if ($res['status']) {
                    $em1->flush();
                    $em1->getConnection()->commit();
                    $status = true;
                    $message = $res['msg'];
                } else {
                    $message = $res['msg'];
                }
            } catch (\Exception $e) {
                $em1->getConnection()->rollback();
                $message = 'Error occurred : ' . $e->getMessage();
            }
        } else {
            $message = 'Please correct the errors below';
            $errors_array = $this->container->get('core_function_services')->getEservFormErrors($form->getErrors(true));
        }

        $result = array(
            'success' => $status,
            'msg' => $message,
            'errors' => $errors_array
        );

        if ($request->isXmlHttpRequest()) {
            return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        } else {
            return $message;
        }
    }

}
