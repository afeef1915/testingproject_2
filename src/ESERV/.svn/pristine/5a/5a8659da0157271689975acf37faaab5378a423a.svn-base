<?php

namespace ESERV\MAIN\SystemConfigBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MtlColourController extends Controller {

    public $mtlColour_columns;
    public $mtlColour_table_id = 'eserv_mtl_colour_table';

    public function __construct() {
        $this->mtlColour_columns = array(
            'code' => array(
                'code',
                'options' => array(
                    'header' => 'Code',
                    'css_class' => 'center',
                )
            ),
            'name' => array(
                'name',
                'options' => array(
                    'header' => 'Name',
                )
            ),
            'htmlCode' => array(
                'htmlCode',
                'options' => array(
                    'header' => 'HTML Code',
                )
            ),
            'rgbRed' => array(
                'rgbRed',
                'options' => array(
                    'header' => 'RGB Red',
                )
            ),
            'rgbGreen' => array(
                'rgbGreen',
                'options' => array(
                    'header' => 'RGB Green',
                )
            ),
            'rgbBlue' => array(
                'rgbRed',
                'options' => array(
                    'header' => 'RGB Blue',
                )
            ),
            'details_btn' => array(
                'type' => 'details_href',
                'url' => '#/admin/mtl-colour/edit/[[id]]',
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

    public function mtlColourListAction(Request $request) {
        $dataTable = $this->container->get('datatables_services')->DrawTable($this->mtlColour_table_id, array(
            'columns' => $this->mtlColour_columns,
            'source_url' => $this->container->get('router')->generate('eserv_main_system_config_view_mtl_colour_ajax_list'),
        ));

        return $this->render('ESERVMAINSystemConfigBundle:MtlColour:list.html.twig', array(
                    'dataTable' => $dataTable,
                    'table_id' => $this->mtlColour_table_id,
        ));
    }

    public function dataAction(Request $request) {
        $data = array(
            'table' => array(
                'type' => 'service',
                'details' => array(
                    'name' => 'ESERV\MAIN\SystemConfigBundle\Services\MtlColourServices',
                    'function_name' => 'ListMtlColour',
                    'function_params' => array(
                    )
                )
            ),
            'index_col' => 'id',
            'columns' => $this->mtlColour_columns,
            'table_id' => $this->mtlColour_table_id,
        );

        $contents = $this->container->get('datatables_services')->getDataTablesList($request, $data);

        return $this->container->get('core_function_services')->ESERVGetResponse($contents);
    }

    public function newMtlColourAction(Request $request) {
        $form = $this->createForm(new \ESERV\MAIN\SystemConfigBundle\Form\MtlColourType(), new \ESERV\MAIN\SystemConfigBundle\Entity\MtlColour(), array(
            'action' => $this->generateUrl('eserv_main_system_config_mtl_colour_create'),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
        ));

        return $this->render('ESERVMAINSystemConfigBundle:MtlColour:new.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function createMtlColourAction(Request $request) {
        $status = false;
        $message = '';
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new \ESERV\MAIN\SystemConfigBundle\Form\MtlColourType());

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $postData = $form->getData();
                try {
                    $em->getConnection()->beginTransaction();
                    $postData->setHtmlCode('#test');
                    $postData->setCssClass('mtl_' . strtolower($postData->getCode()) . '_status');
                    $em->persist($postData);
                    $em->flush();

                    $em->getConnection()->commit();
                    $status = true;
                    $message = 'MTL colour successfully added!';
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();
                    $message = 'An error occurred:' . ' ' . $e->getMessage();
                }
            } else {
                $message = 'Form is invalid.';
            }
        }
        return $this->container->get('core_function_services')->showMessage($status, $message, $request, $form);
    }

    public function editMtlColourAction(Request $request) {
        $mtlColourId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $mtlColour = $em->getRepository('ESERVMAINSystemConfigBundle:MtlColour')->find($mtlColourId);
        if (!$mtlColour) {
            throw $this->createNotFoundException('No mtl colour found for id ' . $mtlColourId);
        }
        $form = $this->createForm(new \ESERV\MAIN\SystemConfigBundle\Form\MtlColourType(), $mtlColour, array(
            'action' => $this->generateUrl('eserv_main_system_config_mtl_colour_update', array('id' => $mtlColourId)),
            'attr' => array(
                'class' => 'eserv_form form-horizontal eserv_form_editable'),
        ));

        return $this->render('ESERVMAINSystemConfigBundle:MtlColour:edit.html.twig', array(
                    'form' => $form->createView(),
                    'mtl_colour_id' => $mtlColourId,
        ));
    }

    public function updateMtlColourAction(Request $request) {
        $mtlColourId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $mtlColour = $em->getRepository('ESERVMAINSystemConfigBundle:MtlColour')->find($mtlColourId);
        if (!$mtlColour) {
            throw $this->createNotFoundException('No mtl colour found for id ' . $mtlColourId);
        }
        $status = false;
        $message = '';
        $form = $this->createForm(new \ESERV\MAIN\SystemConfigBundle\Form\MtlColourType(), $mtlColour);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $postData = $form->getData();
                try {
                    $em->getConnection()->beginTransaction();
                    $em->persist($postData);
                    $em->flush();
                    $em->getConnection()->commit();
                    $status = true;
                    $message = 'MTL colour successfully updated!';
                } catch (\Exception $e) {
                    $em->getConnection()->rollback();
                    $message = 'An error occurred:' . ' ' . $e->getMessage();
                }
            } else {
                $message = 'Form is invalid.';
            }
        }
        return $this->container->get('core_function_services')->showMessage($status, $message, $request, $form);
    }

    public function deleteMtlColourAction(Request $request) {
        $mtlColourId = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $mtlColour = $em->getRepository('ESERVMAINSystemConfigBundle:MtlColour')->find($mtlColourId);
        if (!$mtlColour) {
            throw $this->createNotFoundException('No mtl colour found for id ' . $mtlColourId);
        }
        $status = false;
        try {
            $em->getConnection()->beginTransaction();
            $em->remove($mtlColour);
            $em->flush();
            $em->getConnection()->commit();
            $message = 'MTL colour successfully deleted!';
            $status = true;
        } catch (\Exception $e) {
            $em->getConnection()->rollback();
            $message = 'An error occurred:' . ' ' . $e->getMessage();
        }
        return $this->container->get('core_function_services')->showMessage($status, $message, $request);
    }

}
